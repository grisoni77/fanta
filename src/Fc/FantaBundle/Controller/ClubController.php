<?php

namespace Fc\FantaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fc\FantaBundle\Entity\Club;
use Fc\FantaBundle\Form\ClubType;

/**
 * Club controller.
 *
 * @Route("/club")
 */
class ClubController extends Controller
{
    /**
     * Lists all Club entities.
     *
     * @Route("/", name="club")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FcFantaBundle:Club')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Club entity.
     *
     * @Route("/{id}/show", name="club_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FcFantaBundle:Club')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Club entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Club entity.
     *
     * @Route("/new", name="club_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Club();
        $form   = $this->createForm(new ClubType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Club entity.
     *
     * @Route("/create", name="club_create")
     * @Method("post")
     * @Template("FcFantaBundle:Club:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Club();
        $request = $this->getRequest();
        $form    = $this->createForm(new ClubType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('club_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Club entity.
     *
     * @Route("/{id}/edit", name="club_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FcFantaBundle:Club')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Club entity.');
        }

        $editForm = $this->createForm(new ClubType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Club entity.
     *
     * @Route("/{id}/update", name="club_update")
     * @Method("post")
     * @Template("FcFantaBundle:Club:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FcFantaBundle:Club')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Club entity.');
        }

        $editForm   = $this->createForm(new ClubType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('club_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Club entity.
     *
     * @Route("/{id}/delete", name="club_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FcFantaBundle:Club')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Club entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('club'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
