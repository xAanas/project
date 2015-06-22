<?php

namespace Accueil\AccueilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Config\Definition\Exception\Exception;
use Gestion\GestionBundle\Entity\Fichiers;
use Gestion\GestionBundle\Form\FichiersType;
use Gestion\GestionBundle\Entity\Sites;
use Gestion\GestionBundle\Form\SitesType;
use Gestion\GestionBundle\Entity\Clients;
use Gestion\GestionBundle\Form\ClientsType;
use Gestion\GestionBundle\Entity\Demandes;
use Gestion\GestionBundle\Form\DemandesType;
use Gestion\GestionBundle\Entity\Notifications;
use Gestion\GestionBundle\Entity\Jaime;
use Utilisateurs\UtilisateursBundle\Entity\Utilisateurs;

class DefaultController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $demandes = $em->getRepository('GestionBundle:Demandes')->findAll();

        return $this->render('AccueilBundle:Default:index.html.twig', array('demandes' => $demandes));
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
                        ->setBody($this->render('AccueilBundle:Default:layout/mail.html.twig', array('utilisateur' => $utilisateur, 'demande' => $demande, 'destinataire' => $email->getUsername())))
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
        return $this->render('AccueilBundle:Default:index.html.twig', array('demandes' => $demandes, 'nombrecomment' => $nombrecomment, 'comments' => $comments,'formsite' => $formSite->createView(), 'form' => $form->createView()));
    }
    
    private function createCreateForm(Sites $entity) {
        $form = $this->createForm(new SitesType(), $entity);


        return $form;
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

}
