<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evaluation
 *
 * @ORM\Table(name="evaluation", indexes={@ORM\Index(name="trajet_id", columns={"trajet_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity(repositoryClass="MyApp\UserBundle\Entity\EvaluationRepository")
 */
class Evaluation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="note", type="smallint", nullable=false)
     */
    private $note;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_evaluation", type="datetime", nullable=false)
     */
    private $dateEvaluation;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", nullable=false)
     */
    private $commentaire;

    /**
     * @var \Trajet
     *
     * @ORM\ManyToOne(targetEntity="Trajet")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trajet_id", referencedColumnName="id")
     * })
     */
    private $trajet;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;
    /**
     * @var integer
     *
     * @ORM\Column(name="proprete", type="integer", nullable=true)
     */
    private $proprete;
    /**
     * @var integer
     *
     * @ORM\Column(name="confort", type="integer", nullable=true)
     */
    private $confort;
    /**
     * @var integer
     *
     * @ORM\Column(name="conducteur", type="integer", nullable=true)
     */
    private $conducteur;

    /**
     * @var integer
     *
     * @ORM\Column(name="rapport", type="integer", nullable=true)
     */
    private $rapport;

    /**
     * @return int
     */
    public function getProprete()
    {
        return $this->proprete;
    }

    /**
     * @param int $proprete
     */
    public function setProprete($proprete)
    {
        $this->proprete = $proprete;
    }

    /**
     * @return int
     */
    public function getConfort()
    {
        return $this->confort;
    }

    /**
     * @param int $confort
     */
    public function setConfort($confort)
    {
        $this->confort = $confort;
    }

    /**
     * @return int
     */
    public function getConducteur()
    {
        return $this->conducteur;
    }

    /**
     * @param int $conducteur
     */
    public function setConducteur($conducteur)
    {
        $this->conducteur = $conducteur;
    }

    /**
     * @return int
     */
    public function getRapport()
    {
        return $this->rapport;
    }

    /**
     * @param int $rapport
     */
    public function setRapport($rapport)
    {
        $this->rapport = $rapport;
    }



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set note
     *
     * @param integer $note
     *
     * @return Evaluation
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return integer
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set dateEvaluation
     *
     * @param \DateTime $dateEvaluation
     *
     * @return Evaluation
     */
    public function setDateEvaluation($dateEvaluation)
    {
        $this->dateEvaluation = $dateEvaluation;

        return $this;
    }

    /**
     * Get dateEvaluation
     *
     * @return \DateTime
     */
    public function getDateEvaluation()
    {
        return $this->dateEvaluation;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Evaluation
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set trajet
     *
     * @param \MyApp\UserBundle\Entity\Trajet $trajet
     *
     * @return Evaluation
     */
    public function setTrajet(\MyApp\UserBundle\Entity\Trajet $trajet = null)
    {
        $this->trajet = $trajet;

        return $this;
    }

    /**
     * Get trajet
     *
     * @return \MyApp\UserBundle\Entity\Trajet
     */
    public function getTrajet()
    {
        return $this->trajet;
    }

    /**
     * Set user
     *
     * @param \MyApp\UserBundle\Entity\User $user
     *
     * @return Evaluation
     */
    public function setUser(\MyApp\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \MyApp\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
