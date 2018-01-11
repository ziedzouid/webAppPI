<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actualite
 *
 * @ORM\Table(name="actualite", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="circle_id", columns={"circle_id"})})
 * @ORM\Entity
 */
class Actualite
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
     * @var string
     *
     * @ORM\Column(name="type", type="text", length=65535, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="rubrique", type="string", length=100, nullable=false)
     */
    private $rubrique;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_actualite", type="datetime", nullable=false)
     */
    private $dateActualite = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=255, nullable=false)
     */
    private $contenu;

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
     * @var \Circle
     *
     * @ORM\ManyToOne(targetEntity="Circle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="circle_id", referencedColumnName="id")
     * })
     */
    private $circle;



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
     * Set type
     *
     * @param string $type
     *
     * @return Actualite
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set rubrique
     *
     * @param string $rubrique
     *
     * @return Actualite
     */
    public function setRubrique($rubrique)
    {
        $this->rubrique = $rubrique;

        return $this;
    }

    /**
     * Get rubrique
     *
     * @return string
     */
    public function getRubrique()
    {
        return $this->rubrique;
    }

    /**
     * Set dateActualite
     *
     * @param \DateTime $dateActualite
     *
     * @return Actualite
     */
    public function setDateActualite($dateActualite)
    {
        $this->dateActualite = $dateActualite;

        return $this;
    }

    /**
     * Get dateActualite
     *
     * @return \DateTime
     */
    public function getDateActualite()
    {
        return $this->dateActualite;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Actualite
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set user
     *
     * @param \MyApp\UserBundle\Entity\User $user
     *
     * @return Actualite
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

    /**
     * Set circle
     *
     * @param \MyApp\UserBundle\Entity\Circle $circle
     *
     * @return Actualite
     */
    public function setCircle(\MyApp\UserBundle\Entity\Circle $circle = null)
    {
        $this->circle = $circle;

        return $this;
    }

    /**
     * Get circle
     *
     * @return \MyApp\UserBundle\Entity\Circle
     */
    public function getCircle()
    {
        return $this->circle;
    }
}
