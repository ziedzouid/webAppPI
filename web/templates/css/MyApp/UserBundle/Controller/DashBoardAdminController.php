<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 20/11/2017
 * Time: 21:25
 */

namespace MyApp\UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * DashBoardAdminController controller.
 *
 */
class DashBoardAdminController extends Controller
{

    function listUsersAction()
    {

        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('MyAppUserBundle:User')->findAll();
        foreach ($users as $user) {
            if ($user != $this->getUser()) {

                $client[] = $user;
            }
        }
        return $this->render('@MyAppUser/AdminDashboard/DashboardAdmin.html.twig', array("user" => $client,));

    }

    function deleteUserAction($id)
{

    $em = $this->getDoctrine()->getManager();
    $user = $em->getRepository('MyAppUserBundle:User')->find($id);

    $user->setEnabled(false);
    $em->persist($user);
    $em->flush();

    return $this->redirectToRoute('list_users');
}


}