<?php

namespace PentalogUserBundle\Controller;

use PentalogUserBundle\Entity\PentalogUser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Pentaloguser controller.
 *
 */
class PentalogUserController extends Controller
{
    /**
     * Lists all pentalogUser entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pentalogUsers = $em->getRepository('PentalogUserBundle:PentalogUser')->findAll();

        return $this->render('pentaloguser/index.html.twig', array(
            'pentalogUsers' => $pentalogUsers,
        ));
    }

    /**
     * Creates a new pentalogUser entity.
     *
     */
    public function newAction(Request $request)
    {
        $pentalogUser = new Pentaloguser();
        $form = $this->createForm('PentalogUserBundle\Form\PentalogUserType', $pentalogUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pentalogUser);
            $em->flush();

            return $this->redirectToRoute('pentaloguser_show', array('id' => $pentalogUser->getId()));
        }

        return $this->render('pentaloguser/new.html.twig', array(
            'pentalogUser' => $pentalogUser,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a pentalogUser entity.
     *
     */
    public function showAction(PentalogUser $pentalogUser)
    {
        $deleteForm = $this->createDeleteForm($pentalogUser);

        return $this->render('pentaloguser/show.html.twig', array(
            'pentalogUser' => $pentalogUser,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pentalogUser entity.
     *
     */
    public function editAction(Request $request, PentalogUser $pentalogUser)
    {
        $deleteForm = $this->createDeleteForm($pentalogUser);
        $editForm = $this->createForm('PentalogUserBundle\Form\PentalogUserType', $pentalogUser);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pentaloguser_edit', array('id' => $pentalogUser->getId()));
        }

        return $this->render('pentaloguser/edit.html.twig', array(
            'pentalogUser' => $pentalogUser,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pentalogUser entity.
     *
     */
    public function deleteAction(Request $request, PentalogUser $pentalogUser)
    {
        $form = $this->createDeleteForm($pentalogUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pentalogUser);
            $em->flush();
        }

        return $this->redirectToRoute('pentaloguser_index');
    }

    /**
     * Creates a form to delete a pentalogUser entity.
     *
     * @param PentalogUser $pentalogUser The pentalogUser entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PentalogUser $pentalogUser)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pentaloguser_delete', array('id' => $pentalogUser->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
