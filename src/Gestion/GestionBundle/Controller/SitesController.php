<?php

namespace Gestion\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Gestion\GestionBundle\Entity\Sites;
use Gestion\GestionBundle\Form\SitesType;

/**
 * Sites controller.
 *
 */
class SitesController extends Controller {

    /**
     * Lists all Sites entities.
     *
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GestionBundle:Sites')->findAll();
        $entity = new Sites();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sites_show', array('id' => $entity->getId())));
        }
        return $this->render('GestionBundle:Sites:index.html.twig', array(
                    'entities' => $entities,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new Sites entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Sites();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sites_show', array('id' => $entity->getId())));
        }

        return $this->render('GestionBundle:Sites:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Sites entity.
     *
     * @param Sites $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Sites $entity) {
        $form = $this->createForm(new SitesType(), $entity, array(
            'action' => $this->generateUrl('sites_create'),
            'method' => 'POST',
        ));


        return $form;
    }

    /**
     * Displays a form to create a new Sites entity.
     *
     */
    public function newAction() {
        $entity = new Sites();
        $form = $this->createCreateForm($entity);

        return $this->render('GestionBundle:Sites:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Sites entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionBundle:Sites')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sites entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionBundle:Sites:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Sites entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionBundle:Sites')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sites entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionBundle:Sites:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Sites entity.
     *
     * @param Sites $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Sites $entity) {
        $form = $this->createForm(new SitesType(), $entity, array(
            'action' => $this->generateUrl('sites_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));


        return $form;
    }

    /**
     * Edits an existing Sites entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionBundle:Sites')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sites entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('sites_edit', array('id' => $id)));
        }

        return $this->render('GestionBundle:Sites:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Sites entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GestionBundle:Sites')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Sites entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('sites'));
    }

    /**
     * Creates a form to delete a Sites entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('sites_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
