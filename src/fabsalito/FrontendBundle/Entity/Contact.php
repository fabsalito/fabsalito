<?php

namespace fabsalito\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ORM\Table(name="blog_contact")
 * @ORM\Entity(repositoryClass="fabsalito\Frontend\Entity\ContactRepository")
 */
class Contact
{
    /**
     * @var integer 
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     *
     * @Assert\Type(type="string")
     * @Assert\NotBlank()
     */
    private $name;


    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255)
     *
     * @Assert\Type(type="string")
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string $subject
     *
     * @ORM\Column(name="subject", type="string", length=255)
     *
     * @Assert\Type(type="string")
     * @Assert\NotBlank()
     * @Assert\Length(max = "50")
     */
    private $subject;

    /**
     * @var text $content
     *
     * @ORM\Column(name="content", type="text")
     *
     * @Assert\Length(min = "50")
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
     * Set name
     *
     * @param string $name
     * @return Contact
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return Contact
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    
        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Contact
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
}