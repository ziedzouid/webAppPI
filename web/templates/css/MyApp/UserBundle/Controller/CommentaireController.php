<?php

namespace MyApp\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use MyApp\UserBundle\Entity\Comment;
use MyApp\UserBundle\Entity\User;

class CommentaireController extends Controller
{

    public function ajoutComAction(Request $request){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $Post=$request->get('idPost');

        if($request->isMethod('POST')){
            $em=$this->getDoctrine()->getManager();
            $user = $this->getUser();
            $comment = new Comment();
            $Poste=$em->getRepository("MyAppUserBundle:Poste")->find($Post);
            $var=$Poste->getUser();

           //$i= $Poste.ocirowcount();
            $comment->setUser($user);
            $time = new \DateTime("now");
            $comment->setDatePost($time);
            $comment->setPoste($Poste);
            var_dump($Poste);
            $comment->setMail($request->get('email'));
            $comment->setContent(($request->get('message')));
            $message= \Swift_Message::newInstance();
            $message->setSubject('un commentaire ajouté a votre post')
                ->setFrom('insafchihi@gmail.com')
                ->setTo('chawkibenyohmes@gmail.com')
                ->setCharset('utf-8')
                ->setContentType('text/html')
                ->setBody($this->renderView('MyAppUserBundle:front:addcomment.html.twig'));
            $this->get('mailer')->send($message);
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();


            $manager = $this->get('mgilet.notification');
            $notif = $manager->createNotification('a comment on a Post is added its about a carpool');
            $notifs=$manager->getAll();
            $notif->setMessage(($request->get('message')));
            $notif->setLink('http://symfony.com/');
            $notif->setDate($time);
            // or the one-line method :
            //$manager->createNotification('Notification subject','Some random text','http://google.fr');

            // you can add a notification to a list of entities
            // the third parameter ``$flush`` allows you to directly flush the entities
            $manager->addNotification(array($this->getUser()), $notif, true);

            //return $this->redirectToRoute('listModel');
        }

        return $this->render('MyAppUserBundle:front:addcomment.html.twig');

    }
    public function AfficheCommentAction(Request $request){
        $user = $this->getUser();

        $em=$this->getDoctrine()->getManager();

        $Post=$request->get('idPost');
        $Poste=$em->getRepository("MyAppUserBundle:Poste")->find($Post);

        $comments = $em->getRepository('MyAppUserBundle:Comment')->findByPoste($Poste);

        return $this->render('MyAppUserBundle:front:comments.html.twig', array('comments'=>$comments,
            'post' => $Poste,'user'=>$user));


    }
    public function modifierAction(Request $request)
    {        $em=$this->getDoctrine()->getManager();

        $idcomment=$request->get('idcomment');
        $comment=$em->getRepository("MyAppUserBundle:Comment")->find($idcomment);
        return $this->render('MyAppUserBundle:front:editcomment.html.twig', array('comment'=>$comment));
    }
    public function updateAction(Request $request)
    {  $id=$request->get('idcomment');
        $em=$this->getDoctrine()->getManager();

        $comment=$em->getRepository("MyAppUserBundle:Comment")->find($id);
        //$post=$comment.getPoste();

        if($request->isMethod('POST')) {
            $comment->setContent($request->get('contenu'));
            $user = $this->getUser();
            $comment->setUser($user);
            $time = new \DateTime("now");
            $comment->setDatePost($time);
            //$comment->setPoste($post);

            $em->flush();
        }
        return $this->render('MyAppUserBundle:front:editcomment.html.twig',array('comment'=>$comment));

    }
    public function supprimerAction(Request $request){
        {        $em=$this->getDoctrine()->getManager();
            $user = $this->getUser();


            $idcomment=$request->get('idcomment');
            $comment=$em->getRepository("MyAppUserBundle:Comment")->find($idcomment);
            $post=$comment->getPoste();



            $em->remove($comment);
            $em->flush($comment);
            $comments = $em->getRepository('MyAppUserBundle:Comment')->findByPoste($post);

        }

        return $this->render('MyAppUserBundle:front:comments.html.twig', array('comments'=>$comments,
            'post' => $post,'user'=>$user));




    }
}
