<?php

namespace Gestion\GestionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Config\Definition\Exception\Exception;
use Gestion\GestionBundle\Entity\Fichiers;
use Gestion\GestionBundle\Form\FichiersType;
use Gestion\GestionBundle\Entity\Demandes;
use Gestion\GestionBundle\Form\DemandesType;
use Gestion\GestionBundle\Entity\Commentaires;
use Gestion\GestionBundle\Entity\Notifications;
use Gestion\GestionBundle\Entity\Sites;
use Gestion\GestionBundle\Form\SitesType;
use Gestion\GestionBundle\Entity\Clients;
use Gestion\GestionBundle\Form\ClientsType;
use Gestion\GestionBundle\Entity\Jaime;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use PHPExcel;
use PHPExcel_IOFactory;

class DefaultController extends Controller {

    public function indexAction($name) {
        return $this->render('GestionBundle:Default:index.html.twig', array('name' => $name));
    }
    
        public function AccueilAction(Request $request) {

        $demande = new Demandes();
        $em = $this->getDoctrine()->getManager();
        $comments = $em->getRepository('GestionBundle:Commentaires')->findAll();
        //$fichier1 = $em->getRepository('GestionBundle:Fichiers')->find('1');
        //$fichier = new Fichiers();
        //$demande->getFichiers()->add($fichier);
        $utilisateur = $em->merge($this->container->get('security.context')->getToken()->getUser());
        $demande->setUtilisateur($utilisateur);
        $demande->setJaime('0');
        $demande->setJeNaimePas('0');
        $demande->setDatePosteDemande(new \DateTime());
        $demande->setDateDernierMiseAJour(new \DateTime());
        $demande->setAccueil('1');
        $form = $this->createForm(new DemandesType(), $demande);
        $form->add('auNomDe', 'entity', array('class' => 'Utilisateurs\UtilisateursBundle\Entity\Utilisateurs',
            'empty_value' => $this->container->get('security.context')->getToken()->getUser()->__toString(),
            'empty_data' => NULL));
        $form->handleRequest($request);
        
        
        
        if ($form->isValid()) {
            // foreach ($demande->getFichiers() as $fichier) {
            //   $fichier->setPublication($demande);
            // }
            $em->persist($demande);
            $em->flush();

            // *************   Notification ********************
            $utilisateurs = $em->getRepository('UtilisateursBundle:Utilisateurs')->findAll();

            foreach ($utilisateurs as $utilisateurNotifie) {
                $notification = new Notifications();
                $notification->setActeur($utilisateur);
                $notification->setPublication($demande);
                $notification->setEnable('1');
                $notification->setDateNotification(new \DateTime());
                $contenu = $utilisateur->getUsername() . ' a envoyé une nouvelle demande .';
                $notification->setContenu($contenu);
                $notification->setUtilisateur($utilisateurNotifie->getId());

                $em->persist($notification);
                $em->flush();
            }
            // *************   Email ********************
            $emails = $em->getRepository('UtilisateursBundle:Utilisateurs')->findAll();
            foreach ($emails as $email) {
                $message = \Swift_Message::newInstance()
                        ->setSubject('Ajout Demande')
                        ->setFrom(array('anasbena07@gmail.com' => 'Ellouze And Partners'))
                        ->setTo($email->getEmailCanonical())
                        ->setCharset('utf-8')
                        ->setContentType('text/html')
                        ->setBody($this->render('GestionBundle:Default:layout/mail.html.twig', array('utilisateur' => $utilisateur, 'demande' => $demande, 'destinataire' => $email->getUsername())))
                ;
                $this->get('mailer')->send($message);
            }
        }
        $sites = $em->getRepository('GestionBundle:Sites')->findAll();
        $site = new Sites();
        $formSite = $this->createCreateForm($site);
        $formSite->handleRequest($request);
        if ($formSite->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($site);
            $em->flush();

        }
        $demandes = $em->getRepository('GestionBundle:Demandes')->findAll();
        if ($demandes == NULL) {
            $nombrecomment[0] = 0;
        } else {
            foreach ($demandes as $demande) {
                $nombrecomment[$demande->getId()] = 0;
            }


            foreach ($demandes as $demande) {
                foreach ($comments as $comment) {
                    if ($comment->getDemande()->getId() == $demande->getId()) {
                        $nombrecomment[$demande->getId()] ++;
                    }
                }
            }
        }
        return $this->render('GestionBundle:Default:index.html.twig', array('demandes' => $demandes, 'nombrecomment' => $nombrecomment, 'comments' => $comments,'formsite' => $formSite->createView(), 'form' => $form->createView()));
    }

     private function createCreateForm(Sites $entity) {
        $form = $this->createForm(new SitesType(), $entity);


        return $form;
    }
    
    public function fichierAction(Request $request) {

        $fichier = new Fichiers();
        $form = $this->createForm(new FichiersType, $fichier);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fichier);
            $em->flush();

            // return $this->redirect($this->generateUrl('ajout_demande'));
        }

        return $this->render('GestionBundle:Default:modules/fichierCreate.html.twig', array('form' => $form->createView()));
    }

    public function DemandeAction(Request $request) {

        $demande = new Demandes();

        $em = $this->getDoctrine()->getManager();
        $fichier = new Fichiers();
        $demande->getFichiers()->add($fichier);
        $utilisateur = $em->merge($this->container->get('security.context')->getToken()->getUser());
        $demande->setUtilisateur($utilisateur);
        $demande->setJaime('0');
        $demande->setJeNaimePas('0');
        $demande->setDatePosteDemande(new \DateTime());
        $demande->setDateDerniereMiseAJour(new \DateTime());
        $demande->setAccueil('1');
        $form = $this->createForm(new DemandesType(), $demande);
        $form->handleRequest($request);

        if ($form->isValid()) {



            $em->persist($demande);



            $em->flush();



            // *************   Notification ********************
            $utilisateurs = $em->getRepository('UtilisateursBundle:Utilisateurs')->findAll();
            foreach ($utilisateurs as $utilisateurNotifie) {
                $notification = new Notifications();
                $notification->setActeur($utilisateur);
                $notification->setPublication($demande);
                $notification->setEnable('1');
                $notification->setDateNotification(new \DateTime());
                $contenu = $utilisateur->getUsername() . ' a envoyé une nouvelle demande .';
                $notification->setContenu($contenu);
                $notification->setUtilisateur($utilisateurNotifie->getId());

                $em->persist($notification);
                $em->flush();
            }
        }

        return $this->render('GestionBundle:Default:modules/demandeCreate.html.twig', array('form' => $form->createView()));
    }

    public function notifierAction(Request $request) {
        //$adresseip = $this->container->get('request')->getClientIp();
        //$this->container->get('request')->getSession()->get('utilisateurConnecte');
        //$this->container->get('request')->getSession()->set('utilisateurConnecte', $utilisateurLogin);
       // if ($request->isXmlHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            $notification = new Notifications();
            $notifications = $em->getRepository('GestionBundle:Notifications')->findBy(array('utilisateur' => $this->container->get('security.context')->getToken()->getUser()->getId(), 'enable' => '1'));
            if($this->container->get('request')->getSession()->get('notificationsBag') == NULL){
                $this->container->get('request')->getSession()->set('notificationsBag', $notifications);
            }
            $nombreNotif = 0;
           
            //$this->container->get('request')->getSession()->set('notificationsBag', $notifications);
            
            $serializer = $this->container->get('jms_serializer');
            if ($notifications !== NULL) {
                foreach ($notifications as $key => $notification) {
                    //$notif[$notification->getPublication()->getId()] = $notification->getContenu();
                    $serializer->serialize($notification->getPublication(), 'json');
                    $notifications[$key] = $serializer->serialize($notification, 'json');
                    $notification->setEnable('0');
                    $em->persist($notification);
                    $em->flush();
                    $nombreNotif++;
                }
            }

            $serializer->serialize($notifications, 'json');

            $response = new JsonResponse();

            return $response->setData(array('notifications' => $notifications, 'nombreNotif' => $nombreNotif));
        /*} else {

            //return $this->redirect($this->generateUrl('accueil_homepage'));
            throw new Exception("Erreur");
        }*/
    }

    //****************************** modifier l'etat d'une demande **************************************

    public function modifetatAction($id, $etat) {
        $em = $this->getDoctrine()->getManager();
        $demande = $em->getRepository('GestionBundle:Demandes')->find($id);
        if($demande->getEtat() == "Livrée" && $etat != "Livrée"){
            $demande->setDateLivraison(NULL);
        }
        $demande->setEtat($etat);
        $demande->setDateDernierMiseAJour(new \DateTime());
        if($etat == "Livrée"){
            $demande->setDateLivraison(new \DateTime());
        }
        $em->persist($demande);
        $em->flush();
        $response = new JsonResponse();
        return $response->setData(array('etat' => $demande->getEtat()));
    }

    public function commentersansfichierAction($id, $contenu) {
        $demande = new Demandes();
        $commentaire = new Commentaires();
        $em = $this->getDoctrine()->getManager();
        $demande = $em->getRepository('GestionBundle:Demandes')->find($id);

        $lecommentaire = $contenu;

        // while (strpos(' antislach ', $lecommentaire) === true) {
        $lecommentaire = str_replace('antislach', '\\', $lecommentaire);
        //}
        //while (strpos(' slach ', $lecommentaire) === true) {
        $lecommentaire = str_replace('slach', '/', $lecommentaire);
        //}
        //while (strpos(' istefhem ', $lecommentaire) === true) {
        $lecommentaire = str_replace('istefhem', '?', $lecommentaire);
        //}

        $commentaire->setContenu($lecommentaire . ' ok');
        $commentaire->setDemande($demande);
        $user = $em->merge($this->container->get('security.context')->getToken()->getUser());
        $commentaire->setUtilisateur($user);
        $commentaire->setDateCommentaire(new \DateTime());
        $utilisateur = $em->merge($this->container->get('security.context')->getToken()->getUser());
        $utilisateurs = $em->getRepository('UtilisateursBundle:Utilisateurs')->findAll();
        foreach ($utilisateurs as $utilisateurNotifie) {
            $notification = new Notifications();
            $notification->setActeur($utilisateur);
            $notification->setPublication($demande);
            $notification->setEnable('1');
            $notification->setDateNotification(new \DateTime());
            $contenu = $utilisateur->getUsername() . ' a commenté la demande numero ' . $demande->getId() . ' de ' . $demande->getSites()->getClients();
            $notification->setContenu($contenu);
            $notification->setUtilisateur($utilisateurNotifie->getId());

            $em->persist($notification);
            $em->flush();
            
            
        }
        
        
        
        $em->persist($commentaire);
        $em->flush();
        
        if($demande->getEtat() == 'Emise'){
            $demande->setEtat('En cour');
            $em->persist($demande);
            $em->flush();
            
            
        }
        $response = new JsonResponse();
        return $response->setData(array('contenu' => $commentaire->getContenu()));
    }

    
    
    public function demandeschiffresAction() {
        $em = $this->getDoctrine()->getManager();
        $demandes = $em->getRepository('GestionBundle:Demandes')->findAll();

        $reportOne = array(
            'annulée' => 0,
            'livrée' => 0,
            'encour' => 0,
            'émise' => 0,
        );

        $reportTwo = array(
            'annulée' => 0,
            'livrée' => 0,
            'encour' => 0,
            'émise' => 0,
        );
        $reportThree = array(
            'annulée' => 0,
            'livrée' => 0,
            'encour' => 0,
            'émise' => 0,
        );



        $date = new \DateTime();
        $moicourant = $date->format('m');
        $anneecourante = $date->format('y');
        foreach ($demandes as $demande) {
            if ($demande->getDatePosteDemande()->format('m') == $moicourant && $demande->getDatePosteDemande()->format('y') == $anneecourante) {
                if ($demande->getEtat() == 'Annulée') {
                    $reportOne['annulée'] ++;
                } else if ($demande->getEtat() == 'En cour') {
                    $reportOne['encour'] ++;
                } else if ($demande->getEtat() == 'Livrée') {
                    $reportOne['livrée'] ++;
                } else /* if($demande->getAvancement() == 'Emise') */ {
                    $reportOne['émise'] ++;
                }
            } else if ($demande->getDatePosteDemande()->format('m') == $moicourant - 1 && $demande->getDatePosteDemande()->format('y') == $anneecourante) {
                if ($demande->getEtat() == 'Annulée') {
                    $reportTwo['annulée'] ++;
                } else if ($demande->getEtat() == 'En cour') {
                    $reportTwo['encour'] ++;
                } else if ($demande->getEtat() == 'Livrée') {
                    $reportTwo['livrée'] ++;
                } else /* if($demande->getAvancement() == 'Emise') */ {
                    $reportTwo['émise'] ++;
                }
            } else if ($demande->getDatePosteDemande()->format('m') == $moicourant - 2 && $demande->getDatePosteDemande()->format('y') == $anneecourante) {
                if ($demande->getEtat() == 'Annulée') {
                    $reportThree['annulée'] ++;
                } else if ($demande->getEtat() == 'En cour') {
                    $reportThree['encour'] ++;
                } else if ($demande->getEtat() == 'Livrée') {
                    $reportThree['livrée'] ++;
                } else /* if($demande->getAvancement() == 'Emise') */ {
                    $reportThree['émise'] ++;
                }
            }
        }

        $reportdemande = array(
            '0' => $reportOne,
            '1' => $reportTwo,
            '2' => $reportThree,
        );
        $response = new JsonResponse();
        return $response->setData(array('reportdemande' => $reportdemande));
    }

    public function effacerdemandeaccueilAction(Request $request, $id) {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $demande = new Demandes();
            $demande = $em->getRepository('GestionBundle:Demandes')->find($id);



            $demande->setAccueil(0);


            $em->persist($demande);
            $em->flush();

            $response = new JsonResponse();

            return $response->setData(array('etat' => 'demande effacé'));
        } else {
            throw new Exception("Erreur");
        }
    }

    public function aimerAction(Request $request, $id) {
        // if ($request->isXmlHttpRequest()) {
        $em = $this->getDoctrine()->getManager();
        $demande = new Demandes();
        $demande = $em->getRepository('GestionBundle:Demandes')->find($id);
        $utilisateur = $em->merge($this->container->get('security.context')->getToken()->getUser());
        $jaimeEntity = $em->getRepository('GestionBundle:Jaime')->findOneBy(array('demande' => $demande->getId(), 'utilisateur' => $utilisateur->getId()));
        if ($jaimeEntity == NULL) {
            $jaimeEntity = new Jaime();
            $jaimeEntity->setDemande($id);
            $jaimeEntity->setUtilisateur($utilisateur->getId());
            $jaimeEntity->setJaime('1');
            $jaimeEntity->setJaimepas('0');

            $em->persist($jaimeEntity);
            $em->flush();

            $jaime = $demande->getJaime();
            $jaime++;
            $demande->setJaime($jaime);


            $em->persist($demande);
            $em->flush();

            $response = new JsonResponse();
            return $response->setData(array('demandeJaime' => $demande->getJaime(), 'demandeJaimepas' => $demande->getJeNaimePas()));
        } else if ($jaimeEntity !== NULL) {
            if ($jaimeEntity->getJaime() == 1) {
                $response = new JsonResponse();
                return $response->setData(array('demandeJaime' => $demande->getJaime(), 'demandeJaimepas' => $demande->getJeNaimePas()));
            } elseif ($jaimeEntity->getJaimepas() == 1) {
                $jaimeEntity->setJaimepas('0');
                $jaimeEntity->setJaime('1');
                $em->persist($jaimeEntity);
                $em->flush();

                $jaime = $demande->getJaime();
                $jaime++;
                $demande->setJaime($jaime);

                $jaimepas = $demande->getJeNaimePas();
                $jaimepas--;
                $demande->setJeNaimePas($jaimepas);

                $em->persist($demande);
                $em->flush();

                $response = new JsonResponse();
                return $response->setData(array('demandeJaime' => $demande->getJaime(), 'demandeJaimepas' => $demande->getJeNaimePas()));
            }
        } else {
            $response = new JsonResponse();
            return $response->setData(array('demandeJaime' => $demande->getJaime(), 'demandeJaimepas' => $demande->getJeNaimePas()));
        }




        $response = new JsonResponse();
        return $response->setData(array('demandeJaime' => $demande->getJaime(), 'demandeJaimepas' => $demande->getJeNaimePas()));
        /* } else {
          throw new Exception("Erreur");
          } */
    }

    public function nepasaimerAction(Request $request, $id) {
        // if ($request->isXmlHttpRequest()) {

        $em = $this->getDoctrine()->getManager();
        $demande = $em->getRepository('GestionBundle:Demandes')->find($id);
        $utilisateur = $em->merge($this->container->get('security.context')->getToken()->getUser());
        $jaimeEntity = $em->getRepository('GestionBundle:Jaime')->findOneBy(array('demande' => $demande->getId(), 'utilisateur' => $utilisateur->getId()));

        if ($jaimeEntity == NULL) {
            $jaimeEntity = new Jaime();
            $jaimeEntity->setDemande($id);
            $jaimeEntity->setUtilisateur($utilisateur->getId());
            $jaimeEntity->setJaime('0');
            $jaimeEntity->setJaimepas('1');

            $em->persist($jaimeEntity);
            $em->flush();

            $jaimepas = $demande->getJeNaimePas();
            $jaimepas++;
            $demande->setJeNaimePas($jaimepas);


            $em->persist($demande);
            $em->flush();

            $response = new JsonResponse();
            return $response->setData(array('demandeJaime' => $demande->getJaime(), 'demandeJaimepas' => $demande->getJeNaimePas()));
        } else if ($jaimeEntity !== NULL) {
            if ($jaimeEntity->getJaimepas() == 1) {
                $response = new JsonResponse();
                return $response->setData(array('demandeJaime' => $demande->getJaime(), 'demandeJaimepas' => $demande->getJeNaimePas()));
            } elseif ($jaimeEntity->getJaime() == 1) {
                $jaimeEntity->setJaimepas('1');
                $jaimeEntity->setJaime('0');
                $em->persist($jaimeEntity);
                $em->flush();

                $jaimepas = $demande->getJeNaimePas();
                $jaimepas++;
                $demande->setJeNaimePas($jaimepas);

                $jaime = $demande->getJaime();
                $jaime--;
                $demande->setJaime($jaime);

                $em->persist($demande);
                $em->flush();

                $response = new JsonResponse();
                return $response->setData(array('demandeJaime' => $demande->getJaime(), 'demandeJaimepas' => $demande->getJeNaimePas()));
            }
        } else {
            $response = new JsonResponse();
            return $response->setData(array('demandeJaime' => $demande->getJaime(), 'demandeJaimepas' => $demande->getJeNaimePas()));
        }

        $response = new JsonResponse();
        return $response->setData(array('demandeJaime' => $demande->getJaime(), 'demandeJaimepas' => $demande->getJeNaimePas()));
        /*  } else {
          throw new Exception("Erreur");
          } */
    }
    
    public function exporterdemandeAction(Request $request,$id) {
        
        $em = $this->getDoctrine()->getManager();
        $demande = $em->getRepository('GestionBundle:Demandes')->find($id);
        
         $inputFileName = 'E://excel_demande/layoutdemande.xlsx';
        
        $objPHPExcel = new PHPExcel();
        /** Load $inputFileName to a PHPExcel Object **/
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        
        $response = new Response();
        
        
        
        
        $objPHPExcel->getProperties()->setCreator("Cantara")
                   ->setLastModifiedBy("Someone")
                   ->setTitle("Demande numero "+$id)
                   ->setSubject("Demande");
        
      
        $objPHPExcel->getActiveSheet()->setCellValue('D8', $demande->getSites()->getClients());
        $objPHPExcel->getActiveSheet()->setCellValue('D9', $demande->getSites()->getNom());
        $objPHPExcel->getActiveSheet()->setCellValue('D10', $demande->getAuNomDe());
        $objPHPExcel->getActiveSheet()->setCellValue('D11', $demande->getUtilisateur());
        $objPHPExcel->getActiveSheet()->setCellValue('F15', $demande->getMissionOne());
        $objPHPExcel->getActiveSheet()->setCellValue('F16', $demande->getMissionTwo());
        $objPHPExcel->getActiveSheet()->setCellValue('F17', $demande->getMissionThree());
        $objPHPExcel->getActiveSheet()->setCellValue('G21', $demande->getAutres());
        $objPHPExcel->getActiveSheet()->setCellValue('F24', $demande->getDetailsMissionOne());
        $objPHPExcel->getActiveSheet()->setCellValue('F25', $demande->getDetailsMissionTwo());
        $objPHPExcel->getActiveSheet()->setCellValue('F26', $demande->getDetailsMissionThree());
        $objPHPExcel->getActiveSheet()->setCellValue('D30', $demande->getDateLimite());
        $objPHPExcel->getActiveSheet()->setCellValue('D33', $demande->getLien());
        $objPHPExcel->getActiveSheet()->setCellValue('D35', $demande->getDocGdl());
        $objPHPExcel->getActiveSheet()->setCellValue('D37', $demande->getEnvoiePrevuLe());
        
        
       // Redirect output to a client’s web browser (Excel5)
       $response->headers->set('Content-Type', 'application/vnd.ms-excel');
       
           
       $Date = new \DateTime();
       
       $response->headers->set('Content-Disposition', 'attachment;filename="Demande'.$demande->getSites()->getClients().$demande->getId().'.xlsx"');
       
       $response->headers->set('Cache-Control', 'max-age=0');
       $response->prepare($request);
       $response->sendHeaders();
       $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
       $objWriter->save('php://output');
       exit();  
       $deleteForm = $this->createDeleteForm($id);
       return $this->render('GestionBundle:demandes:show.html.twig',array(
                    'entity' => $demande,
                    'delete_form' => $deleteForm->createView(),
        ));
    }
     private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('demandes_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        //->add('submit', 'submit', array('label' => 'Effacer','attr' =>array('class' => 'btn btn-danger')))
                        ->getForm()
        ;
    }
    
    
}
