<?php

namespace Gestion\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Gestion\GestionBundle\Entity\Demandes;
use Gestion\GestionBundle\Form\DemandesType;
use Gestion\GestionBundle\Entity\Commentaires;
use Gestion\GestionBundle\Form\CommentairesType;
use Gestion\GestionBundle\Entity\Fichiers;
use Gestion\GestionBundle\Form\FichiersType;
use Gestion\GestionBundle\Entity\Sites;
use Gestion\GestionBundle\Form\SitesType;
use Gestion\GestionBundle\Entity\Notifications;
use Gestion\GestionBundle\Implementation\Fonctions;


/**
 * Demandes controller.
 *
 */
class DemandesController extends Controller {

    /**
     * Lists all Demandes entities.
     *
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GestionBundle:Demandes')->findAll();
        $entity = new Demandes();
        $utilisateur = $em->merge($this->container->get('security.context')->getToken()->getUser());
        $entity->setUtilisateur($utilisateur);
        $entity->setJaime('0');
        $entity->setJeNaimePas('0');
        $entity->setDatePosteDemande(new \DateTime());
        $entity->setDateDernierMiseAJour(new \DateTime());
        $entity->setAccueil('1');
        $entity->setEtat('Emise');
        $form = $this->createCreateForm($entity);
        $nomUtilisateur = $this->container->get('security.context')->getToken()->getUser()->__toString();
        $form->add('auNomDe', 'entity', array('class' => 'Utilisateurs\UtilisateursBundle\Entity\Utilisateurs',
            'empty_value' => $nomUtilisateur,
            'empty_data' => NUll,
            'required' => false));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
           
            /*foreach($entity->getFichiers() as $fichier){
                $fichier->setPublication($entity);
            }*/
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('demandes_show', array('id' => $entity->getId())));
        }
        
        $sites = $em->getRepository('GestionBundle:Sites')->findAll();
        $site = new Sites();
        $formSite = $this->createCreateFormSite($site);
        $formSite->handleRequest($request);
        if ($formSite->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($site);
            $em->flush();

        }
        $notifications = $em->getRepository('GestionBundle:Notifications')->findBy(array('utilisateur' => $this->container->get('security.context')->getToken()->getUser()->getId(), 'enable' => '1'));
        if ($entities == NULL) {
            $nombrecomment[0] = 0;
        } else {
            foreach ($entities as $demande) {
                $nombrecomment[$demande->getId()] = 0;
            }
         foreach ($entities as $demande) {
                foreach ($notifications as $notif) {
                    if ($notif->getPublication()->getId() == $demande->getId()) {
                        $nombrecomment[$demande->getId()] ++;
                    }
                }
            }
        }

        return $this->render('GestionBundle:Demandes:index.html.twig', array(
                    'entities' => $entities,
                    'form' => $form->createView(),
                    'formsite' => $formSite->createView(),
                    'nombrecomment' => $nombrecomment,
        ));
    }

    /**
     * Creates a new Demandes entity.
     *
     */
    public function createAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $entity = new Demandes();
        $entities = $em->getRepository('GestionBundle:Demandes')->findAll();
        $entity = new Demandes();
        $utilisateur = $em->merge($this->container->get('security.context')->getToken()->getUser());
        $entity->setUtilisateur($utilisateur);
        $entity->setJaime('0');
        $entity->setJeNaimePas('0');
        $entity->setDatePosteDemande(new \DateTime());
        $entity->setDateDernierMiseAJour(new \DateTime());
        $entity->setAccueil('1');
        $entity->setEtat('Emise');
        $form = $this->createCreateForm($entity);
        $form->add('auNomDe', 'entity', array('class' => 'Utilisateurs\UtilisateursBundle\Entity\Utilisateurs',
            'empty_value' => $this->container->get('security.context')->getToken()->getUser()->__toString(),
            'empty_data' => '1'));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            /*foreach($entity->getFichiers() as $fichier){
                $fichier->setPublication($entity);
            }*/
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('demandes_show', array('id' => $entity->getId())));
        }

        return $this->render('GestionBundle:Demandes:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Demandes entity.
     *
     * @param Demandes $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Demandes $entity) {
        $form = $this->createForm(new DemandesType(), $entity, array(
            'action' => $this->generateUrl('demandes_create'),
            'method' => 'POST',
        ));


        return $form;
    }

    private function createCreateFormSite(Sites $entity) {
        $form = $this->createForm(new SitesType(), $entity);


        return $form;
    }
    
    /**
     * Displays a form to create a new Demandes entity.
     *
     */
    public function newAction() {
        $entity = new Demandes();
        $form = $this->createCreateForm($entity);

        return $this->render('GestionBundle:Demandes:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Demandes entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionBundle:Demandes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Demandes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionBundle:Demandes:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Finds and displays a Demandes entity with comments .
     *
     */
    public function showAvecCommentsAction(Request $request,$id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('GestionBundle:Demandes')->find($id);
        $comments = $em->getRepository('GestionBundle:Commentaires')->findBy(array('demande' => $entity));
        $fichier = new Fichiers();
        $commentaire = new Commentaires();
        //$commentaire->getFichier()->add($fichier);
        $utilisateur = $em->merge($this->container->get('security.context')->getToken()->getUser());
        $commentaire->setUtilisateur($utilisateur);
        $commentaire->setDemande($entity);
        
        $form = $this->createForm(new CommentairesType(), $commentaire);
        $form->handleRequest($request);

        if ($form->isValid()) {
            foreach ($commentaire->getFichier() as $fichier){
                $fichier->setCommentaire($commentaire);
            }

            $commentaire->setDateCommentaire(new \DateTime());
            $em->persist($commentaire);
            $em->flush();
            
            if($entity->getEtat() == 'Emise')
                {
                        $entity->setEtat('En cour');
                        $em->persist($entity);
                        $em->flush();
                }
                
            //$fonction = new Fonctions();
            //$fonction->write_log($utilisateur->getUsername() . ' a commenté la demande numero ' . $entity->getId() . ' de ' . $entity->getSites()->getClients());


            // *************   Notification ********************
            $utilisateurs = $em->getRepository('UtilisateursBundle:Utilisateurs')->findAll();
            foreach ($utilisateurs as $utilisateurNotifie) {
                 if($utilisateurNotifie->getUsername() != $utilisateur->getUsername()){
                $notification = new Notifications();
                $notification->setActeur($utilisateur);
                $notification->setPublication($entity);
                $notification->setEnable('1');
                $notification->setDateNotification(new \DateTime());
                $contenu = $utilisateur->getUsername() . ' a commenté la demande numero ' . $entity->getId() . ' de ' . $entity->getSites()->getClients();
                $notification->setContenu($contenu);
                $notification->setUtilisateur($utilisateurNotifie->getId());

                $em->persist($notification);
                $em->flush();
                 }
            }
        }
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Demandes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        
        $entities = $em->getRepository('GestionBundle:Demandes')->findAll();
        $notifications = $em->getRepository('GestionBundle:Notifications')->findBy(array('utilisateur' => $this->container->get('security.context')->getToken()->getUser()->getId(), 'enable' => '1'));
        if ($entities == NULL) {
            $nombrecomment[0] = 0;
        } else {
            foreach ($entities as $demande) {
                $nombrecomment[$demande->getId()] = 0;
            }
         foreach ($entities as $demande) {
                foreach ($comments as $comment) {
                    if ($comment->getDemande()->getId() == $demande->getId()) {
                        $nombrecomment[$demande->getId()] ++;
                    }
                }
            }
        }
        return $this->render('GestionBundle:Demandes:showAvecComments.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
                    'comments' => $comments,
                    'form' => $form->createView(),
                    'nombrecomment' => $nombrecomment,
        ));
    }

    public function showAvecCommentsNotifAction(Request $request,$id,$idnotif) {
        $em = $this->getDoctrine()->getManager();
        
        $notificationdesactives = $em->getRepository('GestionBundle:Notifications')->findBy(array('publication' => $id));
        foreach ($notificationdesactives as $notificationdesactive){
        $notificationdesactive->setEnable('0');
        $em->persist($notificationdesactive);
        $em->flush();
        }
        $entity = $em->getRepository('GestionBundle:Demandes')->find($id);
        $comments = $em->getRepository('GestionBundle:Commentaires')->findBy(array('demande' => $entity));
        $fichier = new Fichiers();
        $commentaire = new Commentaires();
        //$commentaire->getFichier()->add($fichier);
        $utilisateur = $em->merge($this->container->get('security.context')->getToken()->getUser());
        $commentaire->setUtilisateur($utilisateur);
        $commentaire->setDemande($entity);
        
        $form = $this->createForm(new CommentairesType(), $commentaire);
        $form->handleRequest($request);

        if ($form->isValid()) {
            foreach ($commentaire->getFichier() as $fichier){
                $fichier->setCommentaire($commentaire);
            }

            $commentaire->setDateCommentaire(new \DateTime());
            $em->persist($commentaire);
            $em->flush();
            
            if($entity->getEtat() == 'Emise')
                {
                        $entity->setEtat('En cour');
                        $em->persist($entity);
                        $em->flush();
                }
                
            //$fonction = new Fonctions();
            //$fonction->write_log($utilisateur->getUsername() . ' a commenté la demande numero ' . $entity->getId() . ' de ' . $entity->getSites()->getClients());


            // *************   Notification ********************
            $utilisateurs = $em->getRepository('UtilisateursBundle:Utilisateurs')->findAll();
            foreach ($utilisateurs as $utilisateurNotifie) {
                 if($utilisateurNotifie->getUsername() != $utilisateur->getUsername()){
                $notification = new Notifications();
                $notification->setActeur($utilisateur);
                $notification->setPublication($entity);
                $notification->setEnable('1');
                $notification->setDateNotification(new \DateTime());
                $contenu = $utilisateur->getUsername() . ' a commenté la demande numero ' . $entity->getId() . ' de ' . $entity->getSites()->getClients();
                $notification->setContenu($contenu);
                $notification->setUtilisateur($utilisateurNotifie->getId());

                $em->persist($notification);
                $em->flush();
                 }
            }
        }
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Demandes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionBundle:Demandes:showAvecComments.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
                    'comments' => $comments,
                    'form' => $form->createView(),
        ));
    }
    
    /**
     * Displays a form to edit an existing Demandes entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionBundle:Demandes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Demandes entity.');
        }

        $editForm = $this->createEditForm($entity);
        $nomUtilisateur = $this->container->get('security.context')->getToken()->getUser()->__toString();
        $editForm->add('auNomDe', 'entity', array('class' => 'Utilisateurs\UtilisateursBundle\Entity\Utilisateurs',
            'empty_value' => $nomUtilisateur,
            'empty_data' => NUll,
            'required' => false));
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionBundle:Demandes:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Demandes entity.
     *
     * @param Demandes $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Demandes $entity) {
        $form = $this->createForm(new DemandesType(), $entity, array(
            'action' => $this->generateUrl('demandes_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        //$form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Demandes entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionBundle:Demandes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Demandes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('demandes_edit', array('id' => $id)));
        }

        return $this->render('GestionBundle:Demandes:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Demandes entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GestionBundle:Demandes')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Demandes entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('demandes'));
    }

    /**
     * Creates a form to delete a Demandes entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('demandes_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        //->add('submit', 'submit', array('label' => 'Effacer','attr' =>array('class' => 'btn btn-danger')))
                        ->getForm()
        ;
    }

}
