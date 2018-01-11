<?php

namespace MyApp\UserBundle\Controller;

use MyApp\UserBundle\Entity\Feedback;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Feedback controller.
 *
 */
class FeedbackController extends Controller
{
    /**
     * Lists all feedback entities.
     *
     */


    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $feedbacks = $em->getRepository('MyAppUserBundle:Feedback')->findAll();

        return $this->render('MyAppUserBundle:feedback:index.html.twig', array(
            'feedbacks' => $feedbacks,
        ));
    }

    /**
     * Creates a new feedback entity.
     *
     */
    public function newAction(Request $request)
    {
        $feedback = new Feedback();
        $feedback->setDate(new \DateTime('now'));
        $form = $this->createForm('MyApp\UserBundle\Form\FeedbackType', $feedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($feedback);
            $em->flush();

            return $this->redirectToRoute('feedback_show', array('id' => $feedback->getId()));
        }

        return $this->render('MyAppUserBundle:feedback:new.html.twig', array(
            'feedback' => $feedback,
            'form' => $form->createView(),
        ));
    }

    public function newfeedAction(Request $request)
    {
        $feedback = new Feedback();

        if ($request->isMethod('POST')) {
            $feedback->setContenu($request->get('reclamation'));
            $reg1 = $request->get('range1');
            $reg2 = $request->get('range2');
            $reg3 = $request->get('range3');

            $tt = ($reg1 + $reg2 + $reg3) / 3;

            if ($tt > 50) {
                $feedback->setTitre('excellent');
            } else if ($tt < 50) {
                $feedback->setTitre('Moyen');

            } else {
                $feedback->setTitre('bien');

            }

            $feedback->setDate(new \DateTime('now'));
            $feedback->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($feedback);
            $em->flush();

            return $this->redirectToRoute('feedback_success');
        }

        return $this->render('MyAppUserBundle:feedback:feedbackAdd.html.twig', array());
    }

    function feedsuccesAction()
    {
        return $this->render('MyAppUserBundle:feedback:notification_succes.html.twig', array());
    }

    /**
     * Finds and displays a feedback entity.
     *
     */
    public function showAction(Feedback $feedback)
    {
        $deleteForm = $this->createDeleteForm($feedback);

        return $this->render('MyAppUserBundle:feedback:show.html.twig', array(
            'feedback' => $feedback,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing feedback entity.
     *
     */
    public function editAction(Request $request, Feedback $feedback)
    {
        $deleteForm = $this->createDeleteForm($feedback);
        $feedback->setDate(new \DateTime('now'));
        $editForm = $this->createForm('MyApp\UserBundle\Form\FeedbackType', $feedback);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('feedback_edit', array('id' => $feedback->getId()));
        }

        return $this->render('MyAppUserBundle:feedback:edit.html.twig', array(
            'feedback' => $feedback,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a feedback entity.
     *
     */
    public function deleteAction(Request $request, Feedback $feedback)
    {
        $form = $this->createDeleteForm($feedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($feedback);
            $em->flush();
        }

        return $this->redirectToRoute('feedback_index');
    }

    /**
     * Creates a form to delete a feedback entity.
     *
     * @param Feedback $feedback The feedback entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Feedback $feedback)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('feedback_delete', array('id' => $feedback->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    function showfeedbackAction()
    {
        $em = $this->getDoctrine()->getManager();

        $feedbacks = $em->getRepository('MyAppUserBundle:Feedback')->findAll();

        return $this->render('MyAppUserBundle:AdminDashboard:feedbacksAdmin.html.twig', array(
            'feedbacks' => $feedbacks,
        ));


    }

    function deletefeedbackAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $feedback = $em->getRepository('MyAppUserBundle:Feedback')->find($id);
        $em->remove($feedback);
        $em->flush();

        return $this->redirectToRoute('show_feed');



    }

}
