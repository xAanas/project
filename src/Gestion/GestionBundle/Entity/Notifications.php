<?php

namespace Gestion\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notifications
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\GestionBundle\Repository\NotificationsRepository")
 */
class Notifications
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
     * @ORM\ManyToOne(targetEntity="Utilisateurs\UtilisateursBundle\Entity\Utilisateurs") 
     * @ORM\JoinColumn(nullable=false)
     */
    private $acteur;
    
    /**
     * @ORM\ManyToOne(targetEntity="Gestion\GestionBundle\Entity\Demandes") 
     * @ORM\JoinColumn(nullable=false)
     */
    private $publication;
    
    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
     * @var integer
     *
     * @ORM\Column(name="enable", type="integer")
     */
    private $enable;

    /**
     * @var integer
     *
     * @ORM\Column(name="utilisateur", type="integer")
     */
    private $utilisateur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNotification", type="datetime")
     */
    private $dateNotification;


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
     * Set contenu
     *
     * @param string $contenu
     * @return Notifications
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
     * Set enable
     *
     * @param integer $enable
     * @return Notifications
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;
    
        return $this;
    }

    /**
     * Get enable
     *
     * @return integer 
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Set utilisateur
     *
     * @param integer $utilisateur
     * @return Notifications
     */
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;
    
        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return integer 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set dateNotification
     *
     * @param \DateTime $dateNotification
     * @return Notifications
     */
    public function setDateNotification($dateNotification)
    {
        $this->dateNotification = $dateNotification;
    
        return $this;
    }

    /**
     * Get dateNotification
     *
     * @return \DateTime 
     */
    public function getDateNotification()
    {
        return $this->dateNotification;
    }

    /**
     * Set acteur
     *
     * @param \Utilisateurs\UtilisateursBundle\Entity\Utilisateurs $acteur
     * @return Notifications
     */
    public function setActeur(\Utilisateurs\UtilisateursBundle\Entity\Utilisateurs $acteur)
    {
        $this->acteur = $acteur;
    
        return $this;
    }

    /**
     * Get acteur
     *
     * @return \Utilisateurs\UtilisateursBundle\Entity\Utilisateurs 
     */
    public function getActeur()
    {
        return $this->acteur;
    }

    /**
     * Set publication
     *
     * @param \Gestion\GestionBundle\Entity\Demandes $publication
     * @return Notifications
     */
    public function setPublication(\Gestion\GestionBundle\Entity\Demandes $publication)
    {
        $this->publication = $publication;
    
        return $this;
    }

    /**
     * Get publication
     *
     * @return \Gestion\GestionBundle\Entity\Demandes 
     */
    public function getPublication()
    {
        return $this->publication;
    }
    public function __toString() {
        return $this->getContenu();
    }

}
