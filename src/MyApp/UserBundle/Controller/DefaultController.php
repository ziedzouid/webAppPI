<?php

namespace MyApp\UserBundle\Controller;

use MyApp\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyAppUserBundle:Default:index.html.twig');
    }

    public function AdminDashboardAction(){


        return $this->render('MyAppUserBundle::layoutAdmin.html.twig');
    }

    public function PassagerAcessAction(){

        return $this->render('MyAppUserBundle:Passager:passager_home.html.twig');
    }

    public function ConducteurAcessAction(){



        return $this->render('MyAppUserBundle:Conducteur:conduc_home.html.twig');
    }

    public function DashboardClAction(){
        $em = $this->getDoctrine()->getManager();
       // $user = new User();
        $user = $this->getUser();

        $path ='templates/img/events/'.$user->getAvatar();


        $manager = $this->get('mgilet.notification');
        $notif = $manager->getAll();

        $posts=$em->getRepository("MyAppUserBundle:Poste")->findByUser($user);

        //$user = new User();
        //$em = $this->getDoctrine()->getManager();
        //$person = $em->getRepository('MyAppUserBundle:User')->findBy(array('id'=>$user->getId()));
        return $this->render('MyAppUserBundle::dashboradClient.html.twig',array("person"=>$user,'posts'=>$posts,'user'=>$user,'notif'=>$notif,'prof'=>$path));
    }



}
