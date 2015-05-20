<?php

namespace Accueil\AccueilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Config\Definition\Exception\Exception;
use Gestion\GestionBundle\Entity\Fichiers;
use Gestion\GestionBundle\Form\FichiersType;
use Gestion\GestionBundle\Entity\Demandes;
use Gestion\GestionBundle\Form\DemandesType;
use Gestion\GestionBundle\Entity\Notifications;
use Utilisateurs\UtilisateursBundle\Entity\Utilisateurs;

class DefaultController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $demandes = $em->getRepository('GestionBundle:Demandes')->findAll();

        return $this->render('AccueilBundle:Default:index.html.twig', array('demandes' => $demandes));
    }

    public function DemandeAction(Request $request) {

        $demande = new Demandes();
        $em = $this->getDoctrine()->getManager();
        $comments = $em->getRepository('GestionBundle:Commentaires')->findAll();
        //$fichier1 = $em->getRepository('GestionBundle:Fichiers')->find('1');
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
            //$em = $this->getDoctrine()->getManager();
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
        $demandes = $em->getRepository('GestionBundle:Demandes')->findAll();
        $nbrcom =0;
        
        return $this->render('AccueilBundle:Default:index.html.twig', array('demandes' => $demandes,'comments' => $comments, 'form' => $form->createView()));
    }

    public function aimerAction(Request $request, $id) {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $demande = new Demandes();
            $demande = $em->getRepository('GestionBundle:Demandes')->find($id);

            $jaime = $demande->getJaime();
            $jaime++;

            $demande->setJaime($jaime);


            $em->persist($demande);
            $em->flush();

            $response = new JsonResponse();

            return $response->setData(array('demandeJaime' => $demande->getJaime()));
        } else {
            throw new Exception("Erreur");
        }
    }

    public function nepasaimerAction(Request $request,$id) {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $demande = new Demandes();
            $demande = $em->getRepository('GestionBundle:Demandes')->find($id);
            $jaimepas = $demande->getJeNaimePas();
            $jaimepas++;
            $demande->setJeNaimePas($jaimepas);
            $em->persist($demande);
            $em->flush();
            $response = new JsonResponse();

            return $response->setData(array('demande' => $demande->getId(), 'demandeJaimepas' => $demande->getJeNaimePas()));
        } else {
            throw new Exception("Erreur");
        }
    }

}
