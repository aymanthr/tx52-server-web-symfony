<?php

namespace Application\UTBM\TOEFLBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Answer
 */
class Answer
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
     * @var boolean
     */
    private $isTrue;


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
     * @return Answer
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
     * Set isTrue
     *
     * @param boolean $isTrue
     * @return Answer
     */
    public function setIsTrue($isTrue)
    {
        $this->isTrue = $isTrue;
    
        return $this;
    }

    /**
     * Get isTrue
     *
     * @return boolean 
     */
    public function getIsTrue()
    {
        return $this->isTrue;
    }
    /**
     * @var \Application\UTBM\TOEFLBundle\Entity\Question
     */
    private $question;


    /**
     * Set question
     *
     * @param \Application\UTBM\TOEFLBundle\Entity\Question $question
     * @return Answer
     */
    public function setQuestion(\Application\UTBM\TOEFLBundle\Entity\Question $question = null)
    {
        $this->question = $question;
    
        return $this;
    }

    /**
     * Get question
     *
     * @return \Application\UTBM\TOEFLBundle\Entity\Question 
     */
    public function getQuestion()
    {
        return $this->question;
    }


    public function __toString()
    {
        return "Réponse : " . $this->getTitle();
    }
}