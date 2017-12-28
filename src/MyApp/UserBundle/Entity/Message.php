<?php

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use FOS\MessageBundle\Entity\Message as BaseMessage;

/**
 * Message
 *
 * @ORM\Table(name="message", indexes={@ORM\Index(name="to_id", columns={"to_id"}), @ORM\Index(name="from_id", columns={"from_id"})})
 * @ORM\Entity
 */
class Message extends BaseMessage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="string", length=20, nullable=true)
     */
    private $source;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text", nullable=true )
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_message", type="datetime", nullable=true)
     */
    private $dateMessage;

    /**
     * @var boolean
     *
     * @ORM\Column(name="verif", type="boolean", nullable=true)
     */
    private $verif = false;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="to_id", referencedColumnName="id")
     * })
     */
    private $to;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="from_id", referencedColumnName="id")
     * })
     */
    private $from;

    /**
     * @ORM\ManyToOne(
     *   targetEntity="MyApp\UserBundle\Entity\Thread",
     *   inversedBy="messages"
     * )
     * @var \FOS\MessageBundle\Model\ThreadInterface
     */
    protected $thread;

    /**
     * @ORM\ManyToOne(targetEntity="MyApp\UserBundle\Entity\User")
     * @var \FOS\MessageBundle\Model\ParticipantInterface
     */
    protected $sender;

    /**
     * @ORM\OneToMany(
     *   targetEntity="MyApp\UserBundle\Entity\MessageMetadata",
     *   mappedBy="message",
     *   cascade={"all"}
     * )
     * @var MessageMetadata[]|Collection
     */
    protected $metadata;

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
     * Set source
     *
     * @param string $source
     *
     * @return Message
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Message
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
     * Set dateMessage
     *
     * @param \DateTime $dateMessage
     *
     * @return Message
     */
    public function setDateMessage($dateMessage)
    {
        $this->dateMessage = $dateMessage;

        return $this;
    }

    /**
     * Get dateMessage
     *
     * @return \DateTime
     */
    public function getDateMessage()
    {
        return $this->dateMessage;
    }

    /**
     * Set verif
     *
     * @param boolean $verif
     *
     * @return Message
     */
    public function setVerif($verif)
    {
        $this->verif = $verif;

        return $this;
    }

    /**
     * Get verif
     *
     * @return boolean
     */
    public function getVerif()
    {
        return $this->verif;
    }

    /**
     * Set to
     *
     * @param \MyApp\UserBundle\Entity\User $to
     *
     * @return Message
     */
    public function setTo(\MyApp\UserBundle\Entity\User $to = null)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get to
     *
     * @return \MyApp\UserBundle\Entity\User
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set from
     *
     * @param \MyApp\UserBundle\Entity\User $from
     *
     * @return Message
     */
    public function setFrom(\MyApp\UserBundle\Entity\User $from = null)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get from
     *
     * @return \MyApp\UserBundle\Entity\User
     */
    public function getFrom()
    {
        return $this->from;
    }
}
