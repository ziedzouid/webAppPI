<?php

namespace MyApp\UserBundle\Controller;

use MyApp\UserBundle\Entity\Evenement;
use MyApp\UserBundle\Entity\Trajet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TrajetController extends Controller
{

  /*  public function listAction()
    {
$en =$this->getDoctrine()->getManager();
$trajet = $en->getRepository('MyAppUserBundle:Trajet')->findAll();
return $this->render('MyAppUserBundle:Trajet:list.html.twig',array('Trajet'=>$trajet));

    }*/
    public function listAction(Request $request)
    {
        $en =$this->getDoctrine()->getManager();

        $listTrajet = $en->getRepository('MyAppUserBundle:Trajet')->findAll();
        $trajet  = $this->get('knp_paginator')->paginate(
            $listTrajet,
            $request->query->get('page', 1)/*page number*/,
            5/*limit per page*/
        );
        return $this->render('MyAppUserBundle:Trajet:list.html.twig',array('Trajet'=>$trajet));

    }

    public function listTrajetPassagerAction(Request $request)
    {
        $en =$this->getDoctrine()->getManager();

        $listTrajet = $en->getRepository('MyAppUserBundle:Trajet')->findAll();
        $trajet  = $this->get('knp_paginator')->paginate(
            $listTrajet,
            $request->query->get('page', 1)/*page number*/,
            5/*limit per page*/
        );
        return $this->render('MyAppUserBundle:Trajet:listTrajetPassager.html.twig',array('Trajet'=>$trajet));
    }
    public function listTrajetConducteurAction(Request $request)
    {
        $en =$this->getDoctrine()->getManager();

        $listTrajet = $en->getRepository('MyAppUserBundle:Trajet')->findAll();
        $trajet  = $this->get('knp_paginator')->paginate(
            $listTrajet,
            $request->query->get('page', 1)/*page number*/,
            5/*limit per page*/
        );
        return $this->render('MyAppUserBundle:Trajet:listTrajetConducteur.html.twig',array('Trajet'=>$trajet));
    }
/*
    public function rechercherAction()
    {
        $en =$this->getDoctrine()->getManager();
        $trajet = $en->getRepository('MyAppUserBundle:Trajet')->findAll();
        return $this->render('MyAppUserBundle:Trajet:rechercherTrajet.html.twig',array('Trajet'=>$trajet));

    }*/

    public function rechercherAction(Request $request)
    {
        $trajet = new Trajet();
        $en =$this->getDoctrine()->getManager();
        $search=$request->get('search');
        $repository = $en->getRepository('MyAppUserBundle:Trajet');
        $query = $repository->createQueryBuilder('t')
        ->where('t.villeDepart = :villeDepart')
        ->setParameter('villeDepart',$search.'%')
        ->orderBy('t.villeDepart','ASC')
        ->getQuery();
        $listTrajet = $query->getResult();
        $trajet  = $this->get('knp_paginator')->paginate(
            $listTrajet,
            $request->query->get('page', 1)/*page number*/,
            5/*limit per page*/
        );
       //var_dump($trajet);
        return $this->render('MyAppUserBundle:Trajet:list.html.twig',array('Trajet'=>$trajet));

    }





    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ajoutAction(Request $request)
    {
        $trajet = new Trajet();
        $evenement =new Evenement();

        if ($request->isMethod('POST')) {

           // $trajet->setId($request->get('id'));
            $trajet->setVilleDepart($request->get('villeDepart'));
            $trajet->setVilleArrive($request->get('villeArrive'));
            $trajet->setNombrePlace($request->get('nombrePlace'));
            $evenement->setType($request->get('evenement'));
            $trajet->setDateAnnonce(new \DateTime('now'));
            //$trajet->setDateAnnonce($request->get('dateAnnonce'));
            $trajet->setDateTrajet(new \DateTime($request->get('DateTrajet')));
            $trajet->setPrix($request->get('prix'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($trajet);
            $em->flush();
        }
            return $this->render('MyAppUserBundle:Trajet:ajoutTrajet.html.twig',array());


    }



  public function supprimerAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $trajet= $em->getRepository('MyAppUserBundle:Trajet')->find($id);

    $em->remove($trajet);
    $em->flush();
        return($this->redirectToRoute("my_app_user_trajet"));
    }


        public function modifierAction($id,Request $request)
        {
            $em = $this->getDoctrine()->getManager();
            $trajet = $em->getRepository('MyAppUserBundle:Trajet')->find($id);
        if ($request->isMethod('POST')) {

           // $trajet->setId($request->get('id'));
            $trajet->setVilleDepart($request->get('villeDepart'));
            $trajet->setVilleArrive($request->get('villeArrive'));
            $trajet->setNombrePlace($request->get('nombrePlace'));
            $trajet->setDateAnnonce(new \DateTime('now'));
            //$trajet->setDateAnnonce($request->get('dateAnnonce'));
            $trajet->setDateTrajet(new \DateTime($request->get('DateTrajet')));
            $trajet->setPrix($request->get('prix'));


            $em->flush();
        }

            return $this->render('MyAppUserBundle:Trajet:modifierTrajet.html.twig',array());
    
    
        }



    public function mapAction(){
        $Latitudes ='-24';
        $Langitudes ='142';
        return $this->render('MyAppUserBundle:Trajet:map.html.twig',array('Latitudes'=>$Latitudes,'Langitudes'=>$Langitudes));

    }
    public function inscrireTrajetAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $trajet= $em->getRepository('MyAppUserBundle:Trajet')->find($id);

        $trajet->setVilleDepart(('villeDepart'));
        $trajet->setVilleArrive(('villeArrive'));
        //$trajet->setNombrePlace(('nombrePlace'));
        //$trajet->setDateAnnonce(new \DateTime('now'));
        //$trajet->setDateTrajet(new \DateTime(('DateTrajet')));
        //$trajet->setPrix(('prix'));
        $em->flush();
        return($this->redirectToRoute("my_app_user_inscrireTrajet"));



    }
}
