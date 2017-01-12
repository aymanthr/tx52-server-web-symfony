<?php

namespace Application\UTBM\TOEFLBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Card
 */
class Card
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;


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
     * Set title
     *
     * @param string $title
     * @return Card
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
     * @return Card
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
     * @var \Application\Sonata\MediaBundle\Entity\Media
     */
    private $media;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $tags;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set media
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $media
     * @return Card
     */
    public function setMedia(\Application\Sonata\MediaBundle\Entity\Media $media = null)
    {
        $this->media = $media;
    
        return $this;
    }

    /**
     * Get media
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Add tags
     *
     * @param \Application\Sonata\ClassificationBundle\Entity\Tag $tags
     * @return Card
     */
    public function addTag(\Application\Sonata\ClassificationBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;
    
        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Application\Sonata\ClassificationBundle\Entity\Tag $tags
     */
    public function removeTag(\Application\Sonata\ClassificationBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }


    public function __toString() {
        return $this->title . "";
    }

    /**
     * @var \Application\Sonata\ClassificationBundle\Entity\Category
     */
    private $category;


    /**
     * Set category
     *
     * @param \Application\Sonata\ClassificationBundle\Entity\Category $category
     * @return Card
     */
    public function setCategory(\Application\Sonata\ClassificationBundle\Entity\Category $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \Application\Sonata\ClassificationBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}