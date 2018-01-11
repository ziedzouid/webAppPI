<?php

namespace MyApp\UserBundle\Controller;


use MyApp\UserBundle\Entity\Poste;
use MyApp\UserBundle\Form\AddPostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Mgilet\NotificationBundle\Manager;
use MyApp\UserBundle\Entity\User;

class PostController extends Controller
{
    public function AjoutAction(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        if($request->isMethod('POST')){
            $user = $this->getUser();
            $post = new Poste();
            $post->setUser($user);
            $time = new \DateTime("now");
            $post->setDatePost($time);
            $post->setDate(new \Datetime($request->get('event')));
            $post->setArrive($request->get('destination'));
            $post->setDepart(($request->get('depart')));
            $post->setContenu($request->get('content'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();


            //return $this->redirectToRoute('listModel');
        }
        return $this->render('MyAppUserBundle:front:Post.html.twig');

    }

    public function AfficheAction()
    {


        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('MyAppUserBundle:Poste')->findAll();

        return $this->render('MyAppUserBundle:front:affichePost.html.twig', array(
            'posts' => $posts));

    }
 public function updatepostAction(Request $request){

     $id=$request->get('idPost');
     $em=$this->getDoctrine()->getManager();

     $post=$em->getRepository("MyAppUserBundle:Poste")->find($id);
     //$post=$comment.getPoste();

     if($request->isMethod('POST')) {
         $user = $this->getUser();

         $post->setUser($user);
         $time = new \DateTime("now");
         $post->setDatePost($time);
         $post->setDate(new \Datetime($request->get('event')));

         $post->setArrive($request->get('destination'));
         $post->setDepart(($request->get('depart')));
         $post->setContenu($request->get('content'));

         $em->flush();
     }
     return $this->render('MyAppUserBundle:front:EditPost.html.twig',array('post'=>$post));


 }

    public function clientPostAction(){

        $user=$this->getUser();


        return $this->render('MyAppUserBundle::Client.html.twig',array("person"=>$user,'user'=>$user));



    }
    public function deletepostAction(Request $request){

            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();


            $idPost = $request->get('idPost');
            $Post = $em->getRepository("MyAppUserBundle:Poste")->find($idPost);
            $comments = $em->getRepository('MyAppUserBundle:Comment')->findByPoste($Post);
            // $post=$comment->getPoste();


            $em->remove($Post);
            $em->flush($Post);

            $manager = $this->get('mgilet.notification');
            $notif = $manager->getAll();

            $posts = $em->getRepository("MyAppUserBundle:Poste")->findByUser($user);

            //$user = new User();
            //$em = $this->getDoctrine()->getManager();
            //$person = $em->getRepository('MyAppUserBundle:User')->findBy(array('id'=>$user->getId()));
            return $this->render('MyAppUserBundle::dashboradClient.html.twig',array("person"=>$user,'posts'=>$posts,'user'=>$user,'notif'=>$notif));




    }





}

