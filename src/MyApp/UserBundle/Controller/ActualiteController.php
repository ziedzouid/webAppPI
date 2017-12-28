<?php

namespace MyApp\UserBundle\Controller;

use MyApp\UserBundle\Entity\Actualite;
use MyApp\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Actualite controller.
 *
 */
class ActualiteController extends Controller
{
    /**
     * Lists all actualite entities.
     *
     */
    public function indexactualiteAction()
    {
        $em = $this->getDoctrine()->getManager();

        $actualites = $em->getRepository('MyAppUserBundle:Actualite')->findAll();

        $user_id= $this->getUser()->getId();



        return $this->render('MyAppUserBundle:actualite:fil_actualities.html.twig', array(
            'actualites' => $actualites, 'us'=>$user_id,
        ));
    }


    public function showmyactualiteAction()
    {
        $em = $this->getDoctrine()->getManager();

        $actualites = $em->getRepository('MyAppUserBundle:Actualite')->findBy(array('user'=>$this->getUser()));
        return $this->render('MyAppUserBundle:actualite:myactuality.html.twig', array(
            'actualites' => $actualites,
        ));
    }

    function deleteActualityAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $actuality = $em->getRepository('MyAppUserBundle:Actualite')->find($id);

        $em->remove($actuality);
        $em->flush();

        return $this->redirectToRoute('my_actuality');
    }

    function modifyActualityAction(Request $request,$id)
    {

        $em = $this->getDoctrine()->getManager();
        $actuality = $em->getRepository('MyAppUserBundle:Actualite')->find($id);

        if ($request->getMethod() == "POST") {
            $actuality->setContenu($request->get('actmodify'));
            $actuality->setDateActualite(new \DateTime('now'));
            $em->persist($actuality);
            $em->flush();
            return $this->redirectToRoute('my_actuality');
        }
        return $this->redirectToRoute('my_actuality');
    }
    /**
     * Creates a new actualite entity.
     *
     */
    public function newAction(Request $request)
    {
        $actualite = new Actualite();
        $actualite->setDateActualite(new \DateTime('now'));
        $form = $this->createForm('MyApp\UserBundle\Form\ActualiteType', $actualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($actualite);
            $em->flush();

            return $this->redirectToRoute('actualite_show', array('id' => $actualite->getId()));
        }

        return $this->render('MyAppUserBundle:actualite:new.html.twig', array(
            'actualite' => $actualite,
            'form' => $form->createView(),
        ));
    }

    public function newActAction(Request $request)
    {
        $actualite = new Actualite();

        if ($request->isMethod('POST')) {
            $actualite->setRubrique($request->get('rubrique'));
            $actualite->setContenu($request->get('contenu'));
            $imgpath = 'templates/img/events/'.$request->get('img');
            $actualite->setType($imgpath);
            $actualite->setDateActualite(new \DateTime('now'));
            $actualite->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($actualite);
            $em->flush();

            return $this->redirectToRoute('actualite_index');
        }

        return $this->render('MyAppUserBundle:actualite:ajout_actualite.html.twig', array());
    }


    public function bannUserAction($id){

        $em = $this->getDoctrine()->getManager();

        $actuality = $em->getRepository('MyAppUserBundle:Actualite')->find($id);

        $user = $em->getRepository('MyAppUserBundle:User')->find($actuality->getUser()->getId());


            $user->setBann($user->getBann()+1);

        if ($user->getBann()==2){
            $user->setEnabled(false);
           // $user->setBann(0);
            $em->remove($actuality);
            $em->flush();
        }

        $em->persist($user);
        $em->flush();


       return $this->redirectToRoute('actualite_index');

    }

    /**
     * Finds and displays a actualite entity.
     *
     */
    public function showAction(Actualite $actualite)
    {
        $deleteForm = $this->createDeleteForm($actualite);

        return $this->render('MyAppUserBundle:actualite:show.html.twig', array(
            'actualite' => $actualite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing actualite entity.
     *
     */
    public function editAction(Request $request, Actualite $actualite)
    {
        $deleteForm = $this->createDeleteForm($actualite);
        $actualite->setDateActualite(new \DateTime('now'));
        $editForm = $this->createForm('MyApp\UserBundle\Form\ActualiteType', $actualite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('actualite_edit', array('id' => $actualite->getId()));
        }

        return $this->render('MyAppUserBundle:actualite:edit.html.twig', array(
            'actualite' => $actualite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a actualite entity.
     *
     */
    public function deleteAction(Request $request, Actualite $actualite)
    {
        $form = $this->createDeleteForm($actualite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($actualite);
            $em->flush();
        }

        return $this->redirectToRoute('actualite_index');
    }

    /**
     * Creates a form to delete a actualite entity.
     *
     * @param Actualite $actualite The actualite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Actualite $actualite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('actualite_delete', array('id' => $actualite->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
