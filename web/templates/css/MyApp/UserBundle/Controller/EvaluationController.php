<?php

namespace MyApp\UserBundle\Controller;

use MyApp\UserBundle\Entity\Evaluation;
use MyApp\UserBundle\Entity\User;
use MyApp\UserBundle\Form\EvaluationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;

class EvaluationController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();


        $evaluations = $em->getRepository('MyAppUserBundle:Evaluation')->findAll();
        return $this->render('MyAppUserBundle:Evaluation:Liste_Evaluation.html.twig', array(
            'evaluations' => $evaluations
        ));

    }

    public function AjoutAction(Request $request)
    {
        $evaluation = new Evaluation();
        //$request->isMethod('POST')
        $evaluation->setDateEvaluation(new \DateTime('now'));
        $Form = $this->createForm(EvaluationType::class, $evaluation);
        $Form->handleRequest($request);

        if ($Form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($evaluation);
            $em->flush();
            return $this->redirectToRoute('AffichageEvaluation');
        }
        return $this->render('MyAppUserBundle:Evaluation:AjoutEvaluation.html.twig', array('form' => $Form->createView()));

    }

    public function Ajout2Action(Request $request)
    {
        $evaluation = new Evaluation();
        if ($request->isMethod('POST')) {
            $evaluation->setCommentaire($request->get('commentaire'));
            $evaluation->setNote($request->get('note'));
            $evaluation->setConducteur($request->get('conducteur'));
            $evaluation->setConfort($request->get('confort'));
            $evaluation->setProprete($request->get('proprete'));
            $evaluation->setRapport($request->get('rapport'));


            // $evaluation->setTrajet($request->get('trajet_id'));
            $evaluation->setDateEvaluation(new \DateTime('now'));
            var_dump($request->get('utilisateur_id_courant'));
            $em = $this->getDoctrine()->getManager();
            $ut = $this->getDoctrine()->getRepository("MyAppUserBundle:User")->findOneBy(array('id' => $request->get('utilisateur_id_courant')));
            $evaluation->setUser($ut);
            $tr = $this->getDoctrine()->getRepository("MyAppUserBundle:Trajet")->find($request->get('trajet_id'));
            $evaluation->setTrajet($tr);
            $em->persist($evaluation);
            $em->flush();


        }

        //  return $this->redirect('Affichage2Evaluation_DQL'.'/'.$request->get('trajet_id').'/'.$request->get('utilisateur_id_courant'));
        return $this->redirect("DQL/AffichageEvaluation" . '/' . $request->get('trajet_id') . '/' . $request->get('utilisateur_id_courant'));


    }

    public function UpdateEvaluationAction(Request $request)
    {

        $evaluation = new Evaluation();
        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();

            $evaluation = $em->getRepository("MyAppUserBundle:Evaluation")->find($request->get('evaluation_id'));
            $evaluation->setCommentaire($request->get('commentaire'));
            $evaluation->setNote($request->get('note'));
            $evaluation->setConducteur($request->get('conducteur'));
            $evaluation->setConfort($request->get('confort'));
            $evaluation->setProprete($request->get('proprete'));
            $evaluation->setRapport($request->get('rapport'));


            // $evaluation->setTrajet($request->get('trajet_id'));
            $evaluation->setDateEvaluation(new \DateTime('now'));
            var_dump($request->get('utilisateur_id_courant'));


            $em->persist($evaluation);
            $em->flush();
        }
        return $this->redirect("DQL/AffichageEvaluation" . '/' . $request->get('trajet_id') . '/' . $request->get('utilisateur_id_courant'));



    }
    public function SupprimerEvaluationAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $evaluation = $em->getRepository("MyAppUserBundle:Evaluation")->find($request->get('evaluation_id'));
        $em->remove($evaluation);
        $em->flush();

        return $this->redirect("DQL/AffichageEvaluation" . '/' . $request->get('trajet_id') . '/' . $request->get('utilisateur_id_courant'));



    }

    public function findIDAction($trajet_id, $user_id)
    {
        $em = $this->getDoctrine()->getManager();
        $note = $em->getRepository("MyAppUserBundle:Evaluation")
            ->AverageRatingDQL($trajet_id);
        $note = number_format($note, 1, '.', '');
        $evaluations = $em->getRepository("MyAppUserBundle:Evaluation")
            ->ListeEvaluationParTrajetDQL($trajet_id);
        $S = round($note);
        $tab = array('icon-star', 'icon-star', 'icon-star', 'icon-star', 'icon-star');
        for ($i = 0; $i < $S; $i++) {
            $tab[$i] = "active icon-star";
        }
        $nbvote = $em->getRepository("MyAppUserBundle:Evaluation")
            ->NbrEvaluationParTrajetDQL($trajet_id);

        $conduc = $em->getRepository("MyAppUserBundle:Evaluation")
            ->NbrConducteurParTrajetDQL($trajet_id);
        $conduc = $conduc * 100 / 5;

        $confort = $em->getRepository("MyAppUserBundle:Evaluation")
            ->NbrConfortParTrajetDQL($trajet_id);
        $confort = $confort * 100 / 5;

        $proprete = $em->getRepository("MyAppUserBundle:Evaluation")
            ->NbrPropreteParTrajetDQL($trajet_id);
        $proprete = $proprete * 100 / 5;

        $rapport = $em->getRepository("MyAppUserBundle:Evaluation")
            ->NbrRapportParTrajetDQL($trajet_id);
        $rapport = $rapport * 100 / 5;
        $IfEvaluated = $em->getRepository("MyAppUserBundle:Evaluation")
            ->BooleanIfEvaluatedDQL($trajet_id, $user_id);
        $ev = 1;
        if (empty($IfEvaluated)) {
            $ev = 0;
        }

        return ($this->render("MyAppUserBundle:Evaluation:Liste_Evaluation.html.twig", array("evaluations" => $evaluations,
            "notea" => $note, "tab" => $tab, "nbvote" => $nbvote,
            "conduc" => $conduc,
            "confort" => $confort,
            "proprete" => $proprete,
            "rapport" => $rapport,
            "IfEvaluated" => $IfEvaluated,
            "ev" => $ev,
            "utilisateur_id_courant" => $user_id,
            "trajet_id" => $trajet_id)));
    }
    public function ListeAdminEvaluationAction()
    {
        $em = $this->getDoctrine()->getManager();


        $evaluations = $em->getRepository('MyAppUserBundle:Evaluation')->findAll();
        return $this->render('MyAppUserBundle:Evaluation:ListeEvaluationAdminDash.html.twig', array(
            'evaluations' => $evaluations
        ));

    }
    public function SupprimerEvaluation2Action($id)
    {

        $em = $this->getDoctrine()->getManager();
        $evaluation = $em->getRepository("MyAppUserBundle:Evaluation")->find($id);
    var_dump($id);
        $em->remove($evaluation);
       $em->flush();

        return $this->redirectToRoute("ListeAdminEvaluation");



    }


}