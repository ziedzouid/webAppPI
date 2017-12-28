<?php
/**
 * Created by PhpStorm.
 * User: esprit
 * Date: 19/11/2017
 * Time: 05:00
 */

namespace MyApp\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mgilet\NotificationBundle\Annotation\Notifiable;
use Mgilet\NotificationBundle\NotifiableInterface;

/**
 * Comment
 *
 * @ORM\Table(name="commentaire", indexes={@ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Table(name="commentaire", indexes={@ORM\Index(name="post_id", columns={"post_id"})})
 * @ORM\Entity(repositoryClass="MyApp\UserBundle\Repository\CommentRepository")
 *  @Notifiable(name="commentaire")
 *
 */

class Comment implements NotifiableInterface
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
     * @ORM\Column(name="contenu", type="text", nullable=false)
     */
    private $content;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_post", type="datetime", nullable=false)
     */
    private $datePost = 'CURRENT_TIMESTAMP';
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
     * @var \Poste
     *
     * @ORM\ManyToOne(targetEntity="Poste")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     * })
     */
    private $poste;
    /**
     * @var string
     *
     * @ORM\Column(name="Mail", type="string", length=255, nullable=true)
     */

    private $mail;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return \DateTime
     */
    public function getDatePost()
    {
        return $this->datePost;
    }

    /**
     * @param \DateTime $datePost
     */
    public function setDatePost($datePost)
    {
        $this->datePost = $datePost;
    }

    /**
     * @return \User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return \Poste
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param \Poste $post
     */
    public function setPost($post)
    {
        $this->post = $post;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return \Poste
     */
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * @param \Poste $poste
     */
    public function setPoste($poste)
    {
        $this->poste = $poste;
    }


}