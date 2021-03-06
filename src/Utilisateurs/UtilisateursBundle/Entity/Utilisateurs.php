<?php

namespace Utilisateurs\UtilisateursBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class Utilisateurs extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;
    
    /**
     * @ORM\OneToOne(targetEntity="Gestion\GestionBundle\Entity\Fichiers")
     * @ORM\JoinColumn(nullable=true)
     */
    private $photo;
    
    /**
     * @ORM\OneToMany(targetEntity="Gestion\GestionBundle\Entity\Demandes",mappedBy="utilisateur")
     * @ORM\JoinColumn(nullable=true)
     */
    private $Demandes;
    
    public function __construct()
    {
        parent::__construct();
        $this->Demandes = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Add Demandes
     *
     * @param \Gestion\GestionBundle\Entity\Demandes $demandes
     * @return Utilisateurs
     */
    public function addDemande(\Gestion\GestionBundle\Entity\Demandes $demandes)
    {
        $this->Demandes[] = $demandes;
    
        return $this;
    }

    /**
     * Remove Demandes
     *
     * @param \Gestion\GestionBundle\Entity\Demandes $demandes
     */
    public function removeDemande(\Gestion\GestionBundle\Entity\Demandes $demandes)
    {
        $this->Demandes->removeElement($demandes);
    }

    /**
     * Get Demandes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDemandes()
    {
        return $this->Demandes;
    }


    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Utilisateurs
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    
        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Utilisateurs
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set photo
     *
     * @param \Gestion\GestionBundle\Entity\Fichiers $photo
     * @return Utilisateurs
     */
    public function setPhoto(\Gestion\GestionBundle\Entity\Fichiers $photo = null)
    {
        $this->photo = $photo;
    
        return $this;
    }

    /**
     * Get photo
     *
     * @return \Gestion\GestionBundle\Entity\Fichiers 
     */
    public function getPhoto()
    {
        return $this->photo;
    }
}
