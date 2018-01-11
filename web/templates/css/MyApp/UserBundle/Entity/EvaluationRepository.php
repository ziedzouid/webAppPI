<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;

class EvaluationRepository extends EntityRepository
{
    public function ListeEvaluationParTrajetDQL($trajet_id)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT m FROM MyAppUserBundle:Evaluation m where m.trajet=:trajet")
            ->setParameter('trajet', $trajet_id);
        return $query->getResult();

    }

    public function AverageRatingDQL($trajet_id)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT avg(m.note) FROM MyAppUserBundle:Evaluation m ");
        return $result = $query->getSingleScalarResult();


    }

    public function NbrEvaluationParTrajetDQL($trajet_id)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT count(m.id) FROM MyAppUserBundle:Evaluation m where m.trajet=:trajet ")
            ->setParameter('trajet', $trajet_id);
        return $result = $query->getSingleScalarResult();


    }

    public function NbrConducteurParTrajetDQL($trajet_id)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT avg(m.conducteur) FROM MyAppUserBundle:Evaluation m where m.trajet=:trajet ")
            ->setParameter('trajet', $trajet_id);
        return $result = $query->getSingleScalarResult();
    }
    public function NbrConfortParTrajetDQL($trajet_id)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT avg(m.confort) FROM MyAppUserBundle:Evaluation m where m.trajet=:trajet ")
            ->setParameter('trajet', $trajet_id);
        return $result = $query->getSingleScalarResult();
    }
    public function NbrPropreteParTrajetDQL($trajet_id)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT avg(m.proprete) FROM MyAppUserBundle:Evaluation m where m.trajet=:trajet ")
            ->setParameter('trajet', $trajet_id);
        return $result = $query->getSingleScalarResult();
    }
    public function NbrRapportParTrajetDQL($trajet_id)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT avg(m.rapport) FROM MyAppUserBundle:Evaluation m where m.trajet=:trajet ")
            ->setParameter('trajet', $trajet_id);
        return $result = $query->getSingleScalarResult();
    }
    public function BooleanIfEvaluatedDQL($trajet_id,$user_id)
    {
        $query = $this->getEntityManager()
            ->createQuery("SELECT m FROM MyAppUserBundle:Evaluation m where m.trajet=:trajet and m.user=:user")
            ->setParameter('trajet', $trajet_id)
        ->setParameter('user',$user_id);
        return $query->getResult();
    }

}