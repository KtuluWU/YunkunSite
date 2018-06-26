<?php

namespace YunkunBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="YunkunBundle\Repository\ContactRepository")
 */
class Contact
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
     * @ORM\Column(name="contact_username", type="string")
     */
    private $contact_username;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="contact_email", type="string")
     */
    private $contact_email;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="contact_subject", type="string")
     */
    private $contact_subject;

    /**
     * @var text
     * @Assert\NotBlank()
     * @ORM\Column(name="contact_message", type="text")
     */
    private $contact_message;

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
     * Set contactUsername.
     *
     * @param string $contactUsername
     *
     * @return Contact
     */
    public function setContactUsername($contactUsername)
    {
        $this->contact_username = $contactUsername;

        return $this;
    }

    /**
     * Get contactUsername.
     *
     * @return string
     */
    public function getContactUsername()
    {
        return $this->contact_username;
    }

    /**
     * Set contactEmail.
     *
     * @param string $contactEmail
     *
     * @return Contact
     */
    public function setContactEmail($contactEmail)
    {
        $this->contact_email = $contactEmail;

        return $this;
    }

    /**
     * Get contactEmail.
     *
     * @return string
     */
    public function getContactEmail()
    {
        return $this->contact_email;
    }

    /**
     * Set contactSubject.
     *
     * @param string $contactSubject
     *
     * @return Contact
     */
    public function setContactSubject($contactSubject)
    {
        $this->contact_subject = $contactSubject;

        return $this;
    }

    /**
     * Get contactSubject.
     *
     * @return string
     */
    public function getContactSubject()
    {
        return $this->contact_subject;
    }

    /**
     * Set contactMessage.
     *
     * @param string $contactMessage
     *
     * @return Contact
     */
    public function setContactMessage($contactMessage)
    {
        $this->contact_message = $contactMessage;

        return $this;
    }

    /**
     * Get contactMessage.
     *
     * @return string
     */
    public function getContactMessage()
    {
        return $this->contact_message;
    }
}
