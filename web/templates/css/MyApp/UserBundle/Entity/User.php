<?php

namespace MyApp\UserBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use FOS\MessageBundle\Model\ParticipantInterface;
use Doctrine\ORM\Mapping as ORM;


/**
 * User
 *
 * @ORM\Table(name="user", indexes={@ORM\Index(name="circle_id", columns={"circle_id"})})
 * @ORM\Entity
 */
class User extends BaseUser implements ParticipantInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=100, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=20, nullable=true)
     */
    private $sexe;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissance", type="date", nullable=true)
     */
    private $dateNaissance;

    /**
     * @var integer
     *
     * @ORM\Column(name="telephone", type="integer", nullable=true)
     */
    private $telephone;
    /**
     * @var integer
     *
     * @ORM\Column(name="bann", type="integer", nullable=true)
     */
    private $bann = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="mdp", type="string", length=20, nullable=true)
     */
    private $mdp;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="string", length=200, nullable=true)
     */
    private $avatar;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255, nullable=true)
     */
    private $role;

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
     * @var string
     *
     * @ORM\Column(name="facebookID", type="string", length=255, nullable=true)
     */
    private $facebookID;

    /**
     * @return string
     */
    public function getFacebookID()
    {
        return $this->facebookID;
    }

    /**
     * @param string $facebookID
     */
    public function setFacebookID($facebookID)
    {
        $this->facebookID = $facebookID;
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
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return int
     */
    public function getBann()
    {
        return $this->bann;
    }

    /**
     * @param int $bann
     */
    public function setBann($bann)
    {
        $this->bann = $bann;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return User
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return User
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set telephone
     *
     * @param integer $telephone
     *
     * @return User
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return integer
     */
    public function getTelephone()
    {
        return $this->telephone;
    }


    /**
     * Set mdp
     *
     * @param string $mdp
     *
     * @return User
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get mdp
     *
     * @return string
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     *
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set circle
     *
     * @param \MyApp\UserBundle\Entity\Circle $circle
     *
     * @return User
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
