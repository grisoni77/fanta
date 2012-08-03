<?php

namespace Fc\FantaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fc\FantaBundle\Entity\League;
use Fc\FantaBundle\Form\LeagueType;

/**
 * League controller.
 *
 * @Route("/league_crud")
 */
class LeagueController extends Controller
{
    /**
     * Lists all League entities.
     *
     * @Route("/", name="league")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FcFantaBundle:League')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a League entity.
     *
     * @Route("/{id}/show", name="league_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FcFantaBundle:League')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find League entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new League entity.
     *
     * @Route("/new", name="league_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new League();
        $form   = $this->createForm(new LeagueType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new League entity.
     *
     * @Route("/create", name="league_create")
     * @Method("post")
     * @Template("FcFantaBundle:League:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new League();
        $request = $this->getRequest();
        $form    = $this->createForm(new LeagueType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('league_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing League entity.
     *
     * @Route("/{id}/edit", name="league_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FcFantaBundle:League')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find League entity.');
        }

        $editForm = $this->createForm(new LeagueType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing League entity.
     *
     * @Route("/{id}/update", name="league_update")
     * @Method("post")
     * @Template("FcFantaBundle:League:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FcFantaBundle:League')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find League entity.');
        }

        $editForm   = $this->createForm(new LeagueType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);
        print_r($entity);die();

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('league_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a League entity.
     *
     * @Route("/{id}/delete", name="league_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FcFantaBundle:League')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find League entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('league'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
