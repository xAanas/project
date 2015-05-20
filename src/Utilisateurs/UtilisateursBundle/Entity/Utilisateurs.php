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

}
