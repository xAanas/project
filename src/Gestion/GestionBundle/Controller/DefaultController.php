<?php

namespace Gestion\GestionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Config\Definition\Exception\Exception;
use Gestion\GestionBundle\Entity\Fichiers;
use Gestion\GestionBundle\Form\FichiersType;
use Gestion\GestionBundle\Entity\Demandes;
use Gestion\GestionBundle\Form\DemandesType;
use Gestion\GestionBundle\Entity\Commentaires;
use Gestion\GestionBundle\Entity\Notifications;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

class DefaultController extends Controller {

    public function indexAction($name) {
        return $this->render('GestionBundle:Default:index.html.twig', array('name' => $name));
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

        if ($request->isXmlHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            $notification = new Notifications();
            $notifications = $em->getRepository('GestionBundle:Notifications')->findBy(array('utilisateur' => $this->container->get('security.context')->getToken()->getUser()->getId(), 'enable' => '1'));
            $nombreNotif = 0;
            //$serializer = new Serializer(array(new XmlEncoder(), new GetSetMethodNormalizer()), array(new JsonEncoder()));
            //$encodeur = new JsonEncoder();
            //$notif [] = NULL;

            if ($notifications !== NULL) {
                foreach ($notifications as $key => $notification) {
                    $notif[$notification->getPublication()->getId()] = $notification->getContenu();
                    $notification->setEnable('0');
                    $em->persist($notification);
                    $em->flush();
                    $nombreNotif++;
                }
            }

            //$encodeur->encode($notifications[1], 'json');
            $response = new JsonResponse();

            return $response->setData(array('notifications' => $notif, 'nombreNotif' => $nombreNotif));
        } else {

            //return $this->redirect($this->generateUrl('accueil_homepage'));
            throw new Exception("Erreur");
        }
    }

    //****************************** modifier l'etat d'une demande **************************************

    public function modifetatAction($id, $etat) {
        $em = $this->getDoctrine()->getManager();
        $demande = $em->getRepository('GestionBundle:Demandes')->find($id);
        $demande->setAvancement($etat);
        $em->persist($demande);
        $em->flush();
        $response = new JsonResponse();
        return $response->setData(array('etat' => $demande->getAvancement()));
    }

    public function commentersansfichierAction($id, $contenu) {
        $demande = new Demandes();
        $commentaire = new Commentaires();
        $em = $this->getDoctrine()->getManager();
        $demande = $em->getRepository('GestionBundle:Demandes')->find($id);
        $commentaire->setContenu($contenu);
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
            $contenu = $utilisateur->getUsername() . ' a commenté la demande numero ' . $demande->getId() . ' de ' . $demande->getClient();
            $notification->setContenu($contenu);
            $notification->setUtilisateur($utilisateurNotifie->getId());

            $em->persist($notification);
            $em->flush();
        }
        $em->persist($commentaire);
        $em->flush();
        $response = new JsonResponse();
        return $response->setData(array('contenu' => $commentaire->getContenu()));
    }

}
