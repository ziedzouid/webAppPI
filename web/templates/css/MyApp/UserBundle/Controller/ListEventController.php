<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 16/11/2017
 * Time: 23:51
 */

namespace MyApp\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListEventController extends Controller
{
   public function AffichageAction()
   {
       $em=$this->getDoctrine()->getManager();
       $Evenement=$em->getRepository("MyAppUserBundle:Evenement")->findAll();

       return $this->render('MyAppUserBundle:events:events.html.twig',array("Evenement"=>$Evenement));

   }

}