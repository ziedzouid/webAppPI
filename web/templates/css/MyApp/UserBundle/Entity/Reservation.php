<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="trajet_id", columns={"trajet_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Reservation
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_reservation", type="datetime", nullable=false)
     */
    private $dateReservation = 'CURRENT_TIMESTAMP';

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateReservation
     *
     * @param \DateTime $dateReservation
     *
     * @return Reservation
     */
    public function setDateReservation($dateReservation)
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    /**
     * Get dateReservation
     *
     * @return \DateTime
     */
    public function getDateReservation()
    {
        return $this->dateReservation;
    }

    /**
     * Set trajet
     *
     * @param \MyApp\UserBundle\Entity\Trajet $trajet
     *
     * @return Reservation
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
     * @return Reservation
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
