<?php

namespace Fc\FantaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fc\FantaBundle\Entity\Championship;
use Fc\FantaBundle\Form\ChampionshipType;

/**
 * Championship controller.
 *
 * @Route("/championship")
 */
class ChampionshipController extends Controller
{
    /**
     * Lists all Championship entities.
     *
     * @Route("/", name="championship")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FcFantaBundle:Championship')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Championship entity.
     *
     * @Route("/{id}/show", name="championship_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FcFantaBundle:Championship')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Championship entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Championship entity.
     *
     * @Route("/new", name="championship_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Championship();
        $form   = $this->createForm(new ChampionshipType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Championship entity.
     *
     * @Route("/create", name="championship_create")
     * @Method("post")
     * @Template("FcFantaBundle:Championship:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Championship();
        $request = $this->getRequest();
        $form    = $this->createForm(new ChampionshipType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('championship_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Championship entity.
     *
     * @Route("/{id}/edit", name="championship_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FcFantaBundle:Championship')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Championship entity.');
        }

        $editForm = $this->createForm(new ChampionshipType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Championship entity.
     *
     * @Route("/{id}/update", name="championship_update")
     * @Method("post")
     * @Template("FcFantaBundle:Championship:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FcFantaBundle:Championship')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Championship entity.');
        }

        $editForm   = $this->createForm(new ChampionshipType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('championship_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Championship entity.
     *
     * @Route("/{id}/delete", name="championship_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FcFantaBundle:Championship')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Championship entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('championship'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
