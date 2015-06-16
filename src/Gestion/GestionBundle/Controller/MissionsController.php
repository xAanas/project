<?php

namespace Gestion\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Gestion\GestionBundle\Entity\Missions;
use Gestion\GestionBundle\Form\MissionsType;

/**
 * Missions controller.
 *
 */
class MissionsController extends Controller
{

    /**
     * Lists all Missions entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GestionBundle:Missions')->findAll();
        $entity = new Missions();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('missions_show', array('id' => $entity->getId())));
        }

        return $this->render('GestionBundle:Missions:index.html.twig', array(
            'entities' => $entities,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Creates a new Missions entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Missions();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('missions_show', array('id' => $entity->getId())));
        }

        return $this->render('GestionBundle:Missions:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Missions entity.
     *
     * @param Missions $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Missions $entity)
    {
        $form = $this->createForm(new MissionsType(), $entity, array(
            'action' => $this->generateUrl('missions_create'),
            'method' => 'POST',
        ));


        return $form;
    }

    /**
     * Displays a form to create a new Missions entity.
     *
     */
    public function newAction()
    {
        $entity = new Missions();
        $form   = $this->createCreateForm($entity);

        return $this->render('GestionBundle:Missions:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Missions entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionBundle:Missions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Missions entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionBundle:Missions:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Missions entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionBundle:Missions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Missions entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionBundle:Missions:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Missions entity.
    *
    * @param Missions $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Missions $entity)
    {
        $form = $this->createForm(new MissionsType(), $entity, array(
            'action' => $this->generateUrl('missions_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));


        return $form;
    }
    /**
     * Edits an existing Missions entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionBundle:Missions')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Missions entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('missions_edit', array('id' => $id)));
        }

        return $this->render('GestionBundle:Missions:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Missions entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GestionBundle:Missions')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Missions entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('missions'));
    }

    /**
     * Creates a form to delete a Missions entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('missions_delete', array('id' => $id)))
            ->setMethod('DELETE')
            //->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
