<?php
namespace MyApp\UserBundle\Repository;
use Doctrine\ORM\EntityRepository;


class CommentRepository extends EntityRepository{


public function findBynbrcomUserDQL($user){
    $em=$this->getEntityManager();
    $query = $em->createQuery('SELECT COUNT (m.id) FROM MyAppUserBundle:Comment m WHERE m.user= :id');
    $query->setParameter('id', $user);
    $result = $query->getSingleScalarResult();
    return $result;




}
public function findBynbrCommentDQL(){

    $em=$this->getEntityManager();
    $query = $em->createQuery('SELECT COUNT (m.id) FROM MyAppUserBundle:Comment m ');
    //$query->setParameter('id', $user);
    $result = $query->getSingleScalarResult();
    return $result;


}












}
