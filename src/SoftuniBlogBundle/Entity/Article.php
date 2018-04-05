<?php

namespace SoftuniBlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;



/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="SoftuniBlogBundle\Repository\ArticleRepository")
 */
class Article
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var string
     */
    private $summary;

    /**
     * @var int
     * @ORM\Column(name="authorId",type="integer")
     */
    private $authorId;

    /**
     * @var user
     * @ORM\ManyToOne(targetEntity="SoftuniBlogBundle\Entity\user",inversedBy="articles")
     * @ORM\JoinColumn(name="authorId",referencedColumnName="id")
     */
    private $author;



    public function __construct(){
        $this->dateCreated= new\DateTime('now');
    }



    //region Get_Set
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
     * Set title
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Article
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @return string
     */
    public function getSummary()
    {
        if($this->summary==null){
            $this->setSummary();
        }
        return $this->summary;
    }

    /**
     * @param string
     */
    public function setSummary()
    {
        $this->summary = substr($this->getContent(),0,strlen($this->getContent())/2)."...";
    }

    /**
     * @param int $authorId
     * @return Article
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
        return $this;
    }

    /**
     * @return int
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * @return user
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param user $author
     * @return Article
     *
     */
    public function setAuthor(user $author = null)
    {
        $this->author = $author;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */

    //endregion
}

