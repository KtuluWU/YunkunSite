<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Blog
 *
 * @ORM\Table(name="blog")
 * @ORM\Entity(repositoryClass="App\Repository\BlogRepository")
 */
class Blog
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
     * @Assert\NotBlank()
     * @ORM\Column(name="title", type="string")
     */
    private $title;

    /**
     * @var string
     * 
     * @ORM\Column(name="author", type="string", length=70)
     */
    private $author;

    /**
     * @var string
     * 
     * @ORM\Column(name="editor", type="string", length=70)
     */
    private $editor;

    /**
     * @var text
     * 
     * @ORM\Column(name="pre_text", type="text")
     */
    private $pre_text;

    /**
     * @var text
     * 
     * @ORM\Column(name="pre_html", type="text")
     */
    private $pre_html;

    /**
     * @var text
     * 
     * @ORM\Column(name="article_text", type="text")
     */
    private $article_text;

    /**
     * @var text
     * 
     * @ORM\Column(name="article_html", type="text")
     */
    private $article_html;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\File(
     *     maxSize = "50M"
     * )
     * @var string
     */
    private $image;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\File(
     *     maxSize = "50M"
     * )
     * @var string
     */
    private $image_2;
    
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\File(
     *     maxSize = "50M"
     * )
     * @var string
     */
    private $image_3;

    /**
     * @var datetime
     *
     * @ORM\Column(name="post_date", type="datetime")
     */
    private $post_date;

    /**
     * @var datetime
     *
     * @ORM\Column(name="edit_date", type="datetime")
     */
    private $edit_date;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="category", type="string")
     */
    private $category;

    /**
     * Get id
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
     * @return Blog
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
     * Set author.
     *
     * @param string $author
     *
     * @return Blog
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author.
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set preText.
     *
     * @param string $preText
     *
     * @return Blog
     */
    public function setPreText($preText)
    {
        $this->pre_text = $preText;

        return $this;
    }

    /**
     * Get preText.
     *
     * @return string
     */
    public function getPreText()
    {
        return $this->pre_text;
    }

    /**
     * Set preHtml.
     *
     * @param string $preHtml
     *
     * @return Blog
     */
    public function setPreHtml($preHtml)
    {
        $this->pre_html = $preHtml;

        return $this;
    }

    /**
     * Get preHtml.
     *
     * @return string
     */
    public function getPreHtml()
    {
        return $this->pre_html;
    }

    /**
     * Set articleText.
     *
     * @param string $articleText
     *
     * @return Blog
     */
    public function setArticleText($articleText)
    {
        $this->article_text = $articleText;

        return $this;
    }

    /**
     * Get articleText.
     *
     * @return string
     */
    public function getArticleText()
    {
        return $this->article_text;
    }

    /**
     * Set articleHtml.
     *
     * @param string $articleHtml
     *
     * @return Blog
     */
    public function setArticleHtml($articleHtml)
    {
        $this->article_html = $articleHtml;

        return $this;
    }

    /**
     * Get articleHtml.
     *
     * @return string
     */
    public function getArticleHtml()
    {
        return $this->article_html;
    }

    /**
     * Set image.
     *
     * @param string $image
     *
     * @return Blog
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image.
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set image2.
     *
     * @param string $image2
     *
     * @return Blog
     */
    public function setImage2($image2)
    {
        $this->image_2 = $image2;

        return $this;
    }

    /**
     * Get image2.
     *
     * @return string
     */
    public function getImage2()
    {
        return $this->image_2;
    }

    /**
     * Set image3.
     *
     * @param string $image3
     *
     * @return Blog
     */
    public function setImage3($image3)
    {
        $this->image_3 = $image3;

        return $this;
    }

    /**
     * Get image3.
     *
     * @return string
     */
    public function getImage3()
    {
        return $this->image_3;
    }

    /**
     * Set postDate.
     *
     * @param \DateTime $postDate
     *
     * @return Blog
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

    /**
     * Set category.
     *
     * @param string $category
     *
     * @return Blog
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category.
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set editor.
     *
     * @param string $editor
     *
     * @return Blog
     */
    public function setEditor($editor)
    {
        $this->editor = $editor;

        return $this;
    }

    /**
     * Get editor.
     *
     * @return string
     */
    public function getEditor()
    {
        return $this->editor;
    }

    /**
     * Set editDate.
     *
     * @param \DateTime $editDate
     *
     * @return Blog
     */
    public function setEditDate($editDate)
    {
        $this->edit_date = $editDate;

        return $this;
    }

    /**
     * Get editDate.
     *
     * @return \DateTime
     */
    public function getEditDate()
    {
        return $this->edit_date;
    }
}
