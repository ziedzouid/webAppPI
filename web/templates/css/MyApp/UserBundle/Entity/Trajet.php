<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trajet
 *
 * @ORM\Table(name="trajet", indexes={@ORM\Index(name="evenement_id", columns={"evenement_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Trajet
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
     * @ORM\Column(name="ville_depart", type="string", length=100, nullable=false)
     */
    private $villeDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_arrive", type="string", length=100, nullable=false)
     */
    private $villeArrive;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_trajet", type="datetime", nullable=false)
     */
    private $dateTrajet;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_annonce", type="datetime", nullable=false)
     */
    private $dateAnnonce = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_place", type="smallint", nullable=false)
     */
    private $nombrePlace;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Livraison", type="boolean", nullable=true)
     */
    private $livraison;

    /**
     * @var \Evenement
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="evenement_id", referencedColumnName="id")
     * })
     */
    private $evenement;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set villeDepart
     *
     * @param string $villeDepart
     *
     * @return Trajet
     */
    public function setVilleDepart($villeDepart)
    {
        $this->villeDepart = $villeDepart;

        return $this;
    }

    /**
     * Get villeDepart
     *
     * @return string
     */
    public function getVilleDepart()
    {
        return $this->villeDepart;
    }

    /**
     * Set villeArrive
     *
     * @param string $villeArrive
     *
     * @return Trajet
     */
    public function setVilleArrive($villeArrive)
    {
        $this->villeArrive = $villeArrive;

        return $this;
    }

    /**
     * Get villeArrive
     *
     * @return string
     */
    public function getVilleArrive()
    {
        return $this->villeArrive;
    }

    /**
     * Set dateTrajet
     *
     * @param \DateTime $dateTrajet
     *
     * @return Trajet
     */
    public function setDateTrajet($dateTrajet)
    {
        $this->dateTrajet = $dateTrajet;

        return $this;
    }

    /**
     * Get dateTrajet
     *
     * @return \DateTime
     */
    public function getDateTrajet()
    {
        return $this->dateTrajet;
    }

    /**
     * Set dateAnnonce
     *
     * @param \DateTime $dateAnnonce
     *
     * @return Trajet
     */
    public function setDateAnnonce($dateAnnonce)
    {
        $this->dateAnnonce = $dateAnnonce;

        return $this;
    }

    /**
     * Get dateAnnonce
     *
     * @return \DateTime
     */
    public function getDateAnnonce()
    {
        return $this->dateAnnonce;
    }

    /**
     * Set nombrePlace
     *
     * @param integer $nombrePlace
     *
     * @return Trajet
     */
    public function setNombrePlace($nombrePlace)
    {
        $this->nombrePlace = $nombrePlace;

        return $this;
    }

    /**
     * Get nombrePlace
     *
     * @return integer
     */
    public function getNombrePlace()
    {
        return $this->nombrePlace;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Trajet
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set livraison
     *
     * @param boolean $livraison
     *
     * @return Trajet
     */
    public function setLivraison($livraison)
    {
        $this->livraison = $livraison;

        return $this;
    }

    /**
     * Get livraison
     *
     * @return boolean
     */
    public function getLivraison()
    {
        return $this->livraison;
    }

    /**
     * Set evenement
     *
     * @param \MyApp\UserBundle\Entity\Evenement $evenement
     *
     * @return Trajet
     */
    public function setEvenement(\MyApp\UserBundle\Entity\Evenement $evenement = null)
    {
        $this->evenement = $evenement;

        return $this;
    }

    /**
     * Get evenement
     *
     * @return \MyApp\UserBundle\Entity\Evenement
     */
    public function getEvenement()
    {
        return $this->evenement;
    }

    /**
     * Set user
     *
     * @param \MyApp\UserBundle\Entity\User $user
     *
     * @return Trajet
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
