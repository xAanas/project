<?php

namespace Gestion\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sites
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\GestionBundle\Repository\SitesRepository")
 */
class Sites {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="Gestion\GestionBundle\Entity\Clients") 
     * @ORM\JoinColumn(nullable=false)
     */
    private $clients;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Sites
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Sites
     */
    public function setAdresse($adresse) {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse() {
        return $this->adresse;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Sites
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }


    /**
     * Set clients
     *
     * @param \Gestion\GestionBundle\Entity\Clients $clients
     * @return Sites
     */
    public function setClients(\Gestion\GestionBundle\Entity\Clients $clients)
    {
        $this->clients = $clients;
    
        return $this;
    }

    /**
     * Get clients
     *
     * @return \Gestion\GestionBundle\Entity\Clients 
     */
    public function getClients()
    {
        return $this->clients;
    }
    public function __toString() {
        return $this->getNom();
    }

}
