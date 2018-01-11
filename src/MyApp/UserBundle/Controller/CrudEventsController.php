<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 17/11/2017
 * Time: 02:38
 */

namespace MyApp\UserBundle\Controller;


use MyApp\UserBundle\Entity\Evenement;
use MyApp\UserBundle\Form\EvenementForm;
use MyApp\UserBundle\Form\RechercheForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CrudEventsController extends Controller

{
    public function AffichageAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $Evenement=$em->getRepository("MyAppUserBundle:Evenement")->findAll();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        dump(get_class($paginator));
        $result = $paginator->paginate(
          $Evenement,
          $request->query->getInt('page',1),
          $request->query->getInt('limit',2)

        );
        return $this->render('MyAppUserBundle:events:ListeCond.html.twig',array("Evenement"=>$result));

    }

    public function AjoutAction(Request $request)
{
    $Evenement = new Evenement();


    if ($request->isMethod('post')) {
        $Evenement->setType($request->get('type'));
        $Evenement->setContenu($request->get('contenu'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($Evenement);
        $em->flush();

    }
    return $this->render('MyAppUserBundle:events:ajout.html.twig', array());


}
    function RechercheAction(Request $request)
    {
        $Evenement = new Evenement();

        $em=$this->getDoctrine()->getManager();


        $Form=$this->createForm(RechercheForm::class,$Evenement);
        $Form->handleRequest($request);
        if(isset($_POST['search']))

        {
            $type =$_POST['type'];
            $Evenement=$em->getRepository("MyAppUserBundle:Evenement")->findBy(array('type'=>$type));

        return $this->render("@MyAppUser/events/recherche.html.twig", array("Evenement"=>$Evenement));
        }
        $Evenement=$em->getRepository("MyAppUserBundle:Evenement")->findAll();

        return $this->render("MyAppUserBundle:events:recherche.html.twig",array("Evenement"=>$Evenement,"form"=>$Form->createView()));
    }
    public function DeleteAction(Request $request)
    {
        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $Evenement =$em->getRepository("MyAppUserBundle:Evenement")->find($id);
        $em->remove($Evenement);
        $em->flush();
        return $this->redirectToRoute('conducteur_event_affichage_home');

    }
    public function UpdateAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $Evenement=$em->getRepository("MyAppUserBundle:Evenement")->find($id);
        $form=$this->createForm(EvenementForm::class,$Evenement);
        $form->handleRequest($request);
        if ($form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($Evenement);
            $em->flush();
            return $this->redirectToRoute('conducteur_event_affichage_home');

        }
        return $this->render("MyAppUserBundle:events:modifier.html.twig",array('form'=>$form->createView()));


    }
    public function ListeAdminEventAction()
    {
        $em = $this->getDoctrine()->getManager();


        $evenements = $em->getRepository('MyAppUserBundle:Evenement')->findAll();
        return $this->render('MyAppUserBundle:events:ListEventAdmin.html.twig', array(
            'evenements' => $evenements
        ));

    }
    public function SupprimerEventAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository("MyAppUserBundle:Evenement")->find($id);
        $em->remove($evenement);
        $em->flush();

        return $this->redirectToRoute("ListeAdminEvent");



    }

    public function GetAllEventsAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $data=$em->getRepository("MyAppUserBundle:Evenement")->findAll();
        return $this->json($data,200);
    }

    public function GetMyEventsAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $data=$request->query->get('id');
        $data1=$em->getRepository("MyAppUserBundle:Evenement")->findBy(array('user_id'=>$data));
        return $this->json($data1,200);
    }









}

