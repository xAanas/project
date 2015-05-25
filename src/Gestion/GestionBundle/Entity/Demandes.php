<?php

namespace Gestion\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demandes
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\GestionBundle\Repository\DemandesRepository")
 */
class Demandes
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
     * @ORM\ManyToOne(targetEntity="Utilisateurs\UtilisateursBundle\Entity\Utilisateurs",inversedBy="Demandes") 
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="auNomDe", type="string", length=100, nullable=true)
     */
    private $auNomDe;

    /**
     * @var string
     *
     * @ORM\Column(name="client", type="string", length=100)
     */
    private $client;

    /**
     * @var string
     *
     * @ORM\Column(name="site", type="string", length=100)
     */
    private $site;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\ManyToOne(targetEntity="Gestion\GestionBundle\Entity\Missions") 
     * @ORM\JoinColumn(nullable=true)
     */
    private $missionOne;

    /**
     * @ORM\ManyToOne(targetEntity="Gestion\GestionBundle\Entity\Missions") 
     * @ORM\JoinColumn(nullable=true)
     */
    private $missionTwo;

    /**
     * @ORM\ManyToOne(targetEntity="Gestion\GestionBundle\Entity\Missions") 
     * @ORM\JoinColumn(nullable=true)
     */
    private $missionThree;

    /**
     * @var string
     *
     * @ORM\Column(name="autres", type="string", length=255, nullable=true)
     */
    private $autres;

    /**
     * @var string
     *
     * @ORM\Column(name="detailsMissionOne", type="string", length=255, nullable=true)
     */
    private $detailsMissionOne;

    /**
     * @var string
     *
     * @ORM\Column(name="detailsMissionTwo", type="string", length=255, nullable=true)
     */
    private $detailsMissionTwo;

    /**
     * @var string
     *
     * @ORM\Column(name="detailsMissionThree", type="string", length=255, nullable=true)
     */
    private $detailsMissionThree;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateLimite", type="datetime")
     */
    private $dateLimite;

    /**
     * @ORM\OneToMany(targetEntity="Gestion\GestionBundle\Entity\Fichiers",mappedBy="publication",cascade={"persist"}) 
     * @ORM\JoinColumn(nullable=true)
     */
    private $fichiers;
    
  
    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=255, nullable=true)
     */
    private $lien;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="jaime", type="integer")
     */
    private $jaime;

    /**
     * @var integer
     *
     * @ORM\Column(name="jeNaimePas", type="integer")
     */
    private $jeNaimePas;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=100)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="avancement", type="string", length=50)
     */
    private $avancement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePosteDemande", type="datetime")
     */
    private $datePosteDemande;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDerniereMiseAJour", type="datetime")
     */
    private $dateDerniereMiseAJour;

    /**
     * @var integer
     *
     * @ORM\Column(name="accueil", type="integer")
     */
    private $accueil;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    function __construct() {
        $this->fichiers = new \Doctrine\Common\Collections\ArrayCollection();
        
    }

    /**
     * Set utilisateur
     *
     * @param string $utilisateur
     * @return Demandes
     */
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;
    
        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return string 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set auNomDe
     *
     * @param string $auNomDe
     * @return Demandes
     */
    public function setAuNomDe($auNomDe)
    {
        $this->auNomDe = $auNomDe;
    
        return $this;
    }

    /**
     * Get auNomDe
     *
     * @return string 
     */
    public function getAuNomDe()
    {
        return $this->auNomDe;
    }

    /**
     * Set client
     *
     * @param string $client
     * @return Demandes
     */
    public function setClient($client)
    {
        $this->client = $client;
    
        return $this;
    }

    /**
     * Get client
     *
     * @return string 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set site
     *
     * @param string $site
     * @return Demandes
     */
    public function setSite($site)
    {
        $this->site = $site;
    
        return $this;
    }

    /**
     * Get site
     *
     * @return string 
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Demandes
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    
        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set missionOne
     *
     * @param string $missionOne
     * @return Demandes
     */
    public function setMissionOne($missionOne)
    {
        $this->missionOne = $missionOne;
    
        return $this;
    }

    /**
     * Get missionOne
     *
     * @return string 
     */
    public function getMissionOne()
    {
        return $this->missionOne;
    }

    /**
     * Set missionTwo
     *
     * @param string $missionTwo
     * @return Demandes
     */
    public function setMissionTwo($missionTwo)
    {
        $this->missionTwo = $missionTwo;
    
        return $this;
    }

    /**
     * Get missionTwo
     *
     * @return string 
     */
    public function getMissionTwo()
    {
        return $this->missionTwo;
    }

    /**
     * Set missionThree
     *
     * @param string $missionThree
     * @return Demandes
     */
    public function setMissionThree($missionThree)
    {
        $this->missionThree = $missionThree;
    
        return $this;
    }

    /**
     * Get missionThree
     *
     * @return string 
     */
    public function getMissionThree()
    {
        return $this->missionThree;
    }

    /**
     * Set autres
     *
     * @param string $autres
     * @return Demandes
     */
    public function setAutres($autres)
    {
        $this->autres = $autres;
    
        return $this;
    }

    /**
     * Get autres
     *
     * @return string 
     */
    public function getAutres()
    {
        return $this->autres;
    }

    /**
     * Set detailsMissionOne
     *
     * @param string $detailsMissionOne
     * @return Demandes
     */
    public function setDetailsMissionOne($detailsMissionOne)
    {
        $this->detailsMissionOne = $detailsMissionOne;
    
        return $this;
    }

    /**
     * Get detailsMissionOne
     *
     * @return string 
     */
    public function getDetailsMissionOne()
    {
        return $this->detailsMissionOne;
    }

    /**
     * Set detailsMissionTwo
     *
     * @param string $detailsMissionTwo
     * @return Demandes
     */
    public function setDetailsMissionTwo($detailsMissionTwo)
    {
        $this->detailsMissionTwo = $detailsMissionTwo;
    
        return $this;
    }

    /**
     * Get detailsMissionTwo
     *
     * @return string 
     */
    public function getDetailsMissionTwo()
    {
        return $this->detailsMissionTwo;
    }

    /**
     * Set detailsMissionThree
     *
     * @param string $detailsMissionThree
     * @return Demandes
     */
    public function setDetailsMissionThree($detailsMissionThree)
    {
        $this->detailsMissionThree = $detailsMissionThree;
    
        return $this;
    }

    /**
     * Get detailsMissionThree
     *
     * @return string 
     */
    public function getDetailsMissionThree()
    {
        return $this->detailsMissionThree;
    }

    /**
     * Set dateLimite
     *
     * @param \DateTime $dateLimite
     * @return Demandes
     */
    public function setDateLimite($dateLimite)
    {
        $this->dateLimite = $dateLimite;
    
        return $this;
    }

    /**
     * Get dateLimite
     *
     * @return \DateTime 
     */
    public function getDateLimite()
    {
        return $this->dateLimite;
    }

    /**
     * Set fichiers
     *
     * @param string $fichiers
     * @return Demandes
     */
    public function setFichiers($fichiers)
    {
        $this->fichiers = $fichiers;
    
        return $this;
    }

    /**
     * Get fichiers
     *
     * @return string 
     */
    public function getFichiers()
    {
        return $this->fichiers;
    }

    /**
     * Set jaime
     *
     * @param integer $jaime
     * @return Demandes
     */
    public function setJaime($jaime)
    {
        $this->jaime = $jaime;
    
        return $this;
    }

    /**
     * Get jaime
     *
     * @return integer 
     */
    public function getJaime()
    {
        return $this->jaime;
    }

    /**
     * Set jeNaimePas
     *
     * @param integer $jeNaimePas
     * @return Demandes
     */
    public function setJeNaimePas($jeNaimePas)
    {
        $this->jeNaimePas = $jeNaimePas;
    
        return $this;
    }

    /**
     * Get jeNaimePas
     *
     * @return integer 
     */
    public function getJeNaimePas()
    {
        return $this->jeNaimePas;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Demandes
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set avancement
     *
     * @param string $avancement
     * @return Demandes
     */
    public function setAvancement($avancement)
    {
        $this->avancement = $avancement;
    
        return $this;
    }

    /**
     * Get avancement
     *
     * @return string 
     */
    public function getAvancement()
    {
        return $this->avancement;
    }

    /**
     * Set datePosteDemande
     *
     * @param \DateTime $datePosteDemande
     * @return Demandes
     */
    public function setDatePosteDemande($datePosteDemande)
    {
        $this->datePosteDemande = $datePosteDemande;
    
        return $this;
    }

    /**
     * Get datePosteDemande
     *
     * @return \DateTime 
     */
    public function getDatePosteDemande()
    {
        return $this->datePosteDemande;
    }

    /**
     * Set dateDerniereMiseAJour
     *
     * @param \DateTime $dateDerniereMiseAJour
     * @return Demandes
     */
    public function setDateDerniereMiseAJour($dateDerniereMiseAJour)
    {
        $this->dateDerniereMiseAJour = $dateDerniereMiseAJour;
    
        return $this;
    }

    /**
     * Get dateDerniereMiseAJour
     *
     * @return \DateTime 
     */
    public function getDateDerniereMiseAJour()
    {
        return $this->dateDerniereMiseAJour;
    }

    /**
     * Set accueil
     *
     * @param integer $accueil
     * @return Demandes
     */
    public function setAccueil($accueil)
    {
        $this->accueil = $accueil;
    
        return $this;
    }

    /**
     * Get accueil
     *
     * @return integer 
     */
    public function getAccueil()
    {
        return $this->accueil;
    }

    /**
     * Add fichiers
     *
     * @param \Gestion\GestionBundle\Entity\Fichiers $fichiers
     * @return Demandes
     */
    public function addFichier(\Gestion\GestionBundle\Entity\Fichiers $fichiers)
    {
        $this->fichiers[] = $fichiers;
    
        return $this;
    }

    /**
     * Remove fichiers
     *
     * @param \Gestion\GestionBundle\Entity\Fichiers $fichiers
     */
    public function removeFichier(\Gestion\GestionBundle\Entity\Fichiers $fichiers)
    {
        $this->fichiers->removeElement($fichiers);
    }

    /**
     * Set lien
     *
     * @param string $lien
     * @return Demandes
     */
    public function setLien($lien)
    {
        $this->lien = $lien;
    
        return $this;
    }

    /**
     * Get lien
     *
     * @return string 
     */
    public function getLien()
    {
        return $this->lien;
    }
    
    public function __toString() {
       return $this->getClient()." : ".$this->getId();
    }

}
