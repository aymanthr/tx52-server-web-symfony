<?php

namespace Application\UTBM\TOEFLBundle\Entity;

use Application\Sonata\ClassificationBundle\Entity\Tag;
use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 */
class Question
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
    private $hint;

    /**
     * @var string
     */
    private $response;


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
     * @return Question
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
     * Set hint
     *
     * @param string $hint
     * @return Question
     */
    public function setHint($hint)
    {
        $this->hint = $hint;
    
        return $this;
    }

    /**
     * Get hint
     *
     * @return string 
     */
    public function getHint()
    {
        return $this->hint;
    }

    /**
     * Set response
     *
     * @param string $response
     * @return Question
     */
    public function setResponse($response)
    {
        $this->response = $response;
    
        return $this;
    }

    /**
     * Get response
     *
     * @return string 
     */
    public function getResponse()
    {
        return $this->response;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $answers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->answers = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add answers
     *
     * @param \Application\UTBM\TOEFLBundle\Entity\Answer $answers
     * @return Question
     */
    public function addAnswer(\Application\UTBM\TOEFLBundle\Entity\Answer $answers)
    {
        $this->answers[] = $answers;
    
        return $this;
    }

    /**
     * Remove answers
     *
     * @param \Application\UTBM\TOEFLBundle\Entity\Answer $answers
     */
    public function removeAnswer(\Application\UTBM\TOEFLBundle\Entity\Answer $answers)
    {
        $this->answers->removeElement($answers);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    public function __toString()
    {
        return "Question : " . $this->getTitle();
    }

    public function getContentFormatter() {
        return "markdown";
    }

    public function getRawContent() {
        return "";
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $tags;


    /**
     * Add tags
     *
     * @param Tag $tags
     * @return Question
     */
    public function addTag(Tag $tags)
    {
        $this->tags[] = $tags;
    
        return $this;
    }

    /**
     * Remove tags
     *
     * @param Tag $tags
     */
    public function removeTag(Tag $tags)
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
}