<?php

namespace Fc\FantaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fc\FantaBundle\Entity\Season;
use Fc\FantaBundle\Form\SeasonType;

/**
 * Season controller.
 *
 * @Route("/season")
 */
class SeasonController extends Controller
{
    /**
     * Lists all Season entities.
     *
     * @Route("/", name="season")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FcFantaBundle:Season')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Season entity.
     *
     * @Route("/{id}/show", name="season_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FcFantaBundle:Season')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Season entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Season entity.
     *
     * @Route("/new", name="season_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Season();
        $form   = $this->createForm(new SeasonType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Season entity.
     *
     * @Route("/create", name="season_create")
     * @Method("post")
     * @Template("FcFantaBundle:Season:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Season();
        $request = $this->getRequest();
        $form    = $this->createForm(new SeasonType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('season_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Season entity.
     *
     * @Route("/{id}/edit", name="season_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FcFantaBundle:Season')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Season entity.');
        }

        $editForm = $this->createForm(new SeasonType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Season entity.
     *
     * @Route("/{id}/update", name="season_update")
     * @Method("post")
     * @Template("FcFantaBundle:Season:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FcFantaBundle:Season')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Season entity.');
        }

        $editForm   = $this->createForm(new SeasonType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('season_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Season entity.
     *
     * @Route("/{id}/delete", name="season_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FcFantaBundle:Season')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Season entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('season'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
