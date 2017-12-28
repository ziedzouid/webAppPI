<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 19/11/2017
 * Time: 20:40
 */

namespace MyApp\UserBundle\Controller;


use DateTime;
use MyApp\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DashboardClientController extends Controller
{

    public function editProfileAction(Request $request)
    {
        $user =$this->getUser();
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('MyAppUserBundle:User')->find($user->getId());

        if ($request->getMethod() == "POST") {

            $user->setEmail($request->get('email'));
            $user->setPrenom($request->get('firstname'));
            $user->setNom($request->get('lastname'));
            $user->setSexe($request->get('sexe'));
            $user->setTelephone($request->get('tel'));
            $user->setUsername($request->get('userrname'));
            $date = new DateTime($request->get('datenais'));
            $user->setDateNaissance($date);




            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('dashboard_client');
        }
        return $this->render('@MyAppUser/dashboradClient.html.twig');
    }

}