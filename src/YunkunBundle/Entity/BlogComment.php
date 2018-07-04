<?php

namespace YunkunBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * BlogComment
 *
 * @ORM\Table(name="blog_comment")
 * @ORM\Entity(repositoryClass="YunkunBundle\Repository\BlogCommentRepository")
 */
class BlogComment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * 
     * @ORM\Column(name="blog_title", type="string")
     */
    private $title;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="commentor", type="string")
     */
    private $commentor;

    /**
     * @var text
     * @Assert\NotBlank()
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;

    /**
     * @var int
     * 
     * @ORM\Column(name="reply", type="integer")
     */
    private $reply;

    /**
     * @var datetime
     *
     * @ORM\Column(name="post_date", type="datetime")
     */
    private $post_date;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return BlogComment
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set commentor.
     *
     * @param string $commentor
     *
     * @return BlogComment
     */
    public function setCommentor($commentor)
    {
        $this->commentor = $commentor;

        return $this;
    }

    /**
     * Get commentor.
     *
     * @return string
     */
    public function getCommentor()
    {
        return $this->commentor;
    }

    /**
     * Set comment.
     *
     * @param string $comment
     *
     * @return BlogComment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment.
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set reply.
     *
     * @param int $reply
     *
     * @return BlogComment
     */
    public function setReply($reply)
    {
        $this->reply = $reply;

        return $this;
    }

    /**
     * Get reply.
     *
     * @return int
     */
    public function getReply()
    {
        return $this->reply;
    }

    /**
     * Set postDate.
     *
     * @param \DateTime $postDate
     *
     * @return BlogComment
     */
    public function setPostDate($postDate)
    {
        $this->post_date = $postDate;

        return $this;
    }

    /**
     * Get postDate.
     *
     * @return \DateTime
     */
    public function getPostDate()
    {
        return $this->post_date;
    }
}
