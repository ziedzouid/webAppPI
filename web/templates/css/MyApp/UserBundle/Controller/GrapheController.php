<?php
namespace MyApp\UserBundle\Controller;
use MyApp\UserBundle\Entity\Comment;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zend\Json\Expr;
class GrapheController extends Controller
{

    public function chartPieAction()
    {
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('User Percent per Comment');
        $ob->plotOptions->pie(array(
            'allowPointSelect' => true,
            'cursor' => 'pointer',
            'dataLabels' => array('enabled' => false),
            'showInLegend' => true
        ));

        $data = array();

        $em = $this->container->get('doctrine')->getEntityManager();
        $users = $em->getRepository('MyAppUserBundle:User')->findAll();
        $tab = array();
        $categories = array();

       $n= $em->getRepository('MyAppUserBundle:Comment')->findBynbrCommentDQL();
        var_dump($n);
        foreach ($users as $user) {$stat=array();
            $totalcomment =$em->getRepository('MyAppUserBundle:Comment')->findBynbrcomUserDQL($user);
            var_dump($totalcomment);

            array_push($stat,$user->getNom(),($totalcomment*100)/$n);
            //var_dump($stat);
            array_push($data,$stat);}
        // var_dump($data);
        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));
        return $this->render('MyAppUserBundle:front:pie.html.twig', array( 'chart' => $ob ));

        }


    public function chartHistogrammeAction()
    {
        $em= $this->container->get('doctrine')->getEntityManager();
        $users = $em->getRepository('MyAppUserBundle:User')->findAll();

        $categories= array();
        $nbEtudiants=array();
        foreach($users as $user) {
            array_push($categories,$user->getUsername());
            //var_dump($user->getNom());
           $o= $em->getRepository('MyAppUserBundle:Comment')->findBynbrcomUserDQL($user);
           var_dump($o);
            array_push($nbEtudiants,$o);


        }
        $series = array(
            array(
                'name'  =>'Etudiant',
                'type'  =>'column',
                'color' =>'#4572A7',
                'yAxis' =>0,
                'data'  =>$nbEtudiants,
            )
        );
        $yData= array(

            array(
                'labels' =>array(
                    'formatter' =>new Expr('function () { return this.value + "" }'),
                    'style'     =>array('color' =>'#4572A7')
                ),
                'gridLineWidth' =>0,
                'title' =>array(
                    'text'  =>'Nombre des étudiants',
                    'style' =>array('color' =>'#4572A7')
                ),
            ),
        );


        $ob= new Highchart();
        $ob->chart->renderTo('container'); // The #id of the div where to render the chart
        $ob->chart->type('column');
        $ob->title->text('Nombre des étudiants par niveau');

        $ob->xAxis->categories($categories);

        $ob->yAxis($yData);

        $ob->legend->enabled(false);
        $formatter = new Expr('function () {
var unit = {
                     "Etudiant": "étudiant(s)",

                 }[this.series.name];
                 return this.x + "" + this.y + "" + unit;
             }');
        $ob->tooltip->formatter($formatter);
        $ob->series($series);
        return $this->render('MyAppUserBundle:front:pie.html.twig', array(
            'chart' =>$ob
        ));
    }



}
