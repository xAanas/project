<?php

namespace Gestion\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demandes
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\GestionBundle\Repository\DemandesRepository")
 */
class Demandes {

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
     * @ORM\ManyToOne(targetEntity="Gestion\GestionBundle\Entity\Categories") 
     * @ORM\JoinColumn(nullable=true)
     */
    private $categorie;
    /**
     * @var string
     *
     * @ORM\Column(name="potentielfacturation", type="string", length=255, nullable=true)
     */
    private $potentielFacturation;
    /**
     * @ORM\ManyToOne(targetEntity="Utilisateurs\UtilisateursBundle\Entity\Utilisateurs") 
     * @ORM\JoinColumn(nullable=true)
     */
    private $auNomDe;
     /**
     * @var string
     *
     * @ORM\Column(name="chefdeproject", type="string", length=255, nullable=true)
     */
    private $chefDeProjet;
    /**
     * @var string
     *
     * @ORM\Column(name="client", type="string", length=255, nullable=true)
     */
    private $client;
    /**
     * @ORM\ManyToOne(targetEntity="Gestion\GestionBundle\Entity\Sites") 
     * @ORM\JoinColumn(nullable=false)
     */
    private $sites;

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
     * @var string
     *
     * @ORM\Column(name="lien", type="text", nullable=true)
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
     * @ORM\Column(name="niveauUrgence", type="string", length=100)
     */
    private $niveauUrgence;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=100)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="confidentialite", type="string", length=255)
     */
    private $confidentialite;

    /**
     * @var string
     *
     * @ORM\Column(name="docGdl", type="string", length=255, nullable=true)
     */
    private $docGdl;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="envoiePrevuLe", type="datetime", nullable=true)
     */
    private $envoiePrevuLe;

    /**
     * @var string
     *
     * @ORM\Column(name="mettreEnCopie", type="string", length=255, nullable=true)
     */
    private $mettreEnCopie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePosteDemande", type="datetime")
     */
    private $datePosteDemande;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDernierMiseAJour", type="datetime")
     */
    private $dateDernierMiseAJour;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateLivraison", type="datetime", nullable=true)
     */
    private $dateLivraison;
    
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
    public function getId() {
        return $this->id;
    }

    /**
     * Set autres
     *
     * @param string $autres
     * @return Demandes
     */
    public function setAutres($autres) {
        $this->autres = $autres;

        return $this;
    }

    /**
     * Get autres
     *
     * @return string 
     */
    public function getAutres() {
        return $this->autres;
    }

    /**
     * Set detailsMissionOne
     *
     * @param string $detailsMissionOne
     * @return Demandes
     */
    public function setDetailsMissionOne($detailsMissionOne) {
        $this->detailsMissionOne = $detailsMissionOne;

        return $this;
    }

    /**
     * Get detailsMissionOne
     *
     * @return string 
     */
    public function getDetailsMissionOne() {
        return $this->detailsMissionOne;
    }

    /**
     * Set detailsMissionTwo
     *
     * @param string $detailsMissionTwo
     * @return Demandes
     */
    public function setDetailsMissionTwo($detailsMissionTwo) {
        $this->detailsMissionTwo = $detailsMissionTwo;

        return $this;
    }

    /**
     * Get detailsMissionTwo
     *
     * @return string 
     */
    public function getDetailsMissionTwo() {
        return $this->detailsMissionTwo;
    }

    /**
     * Set detailsMissionThree
     *
     * @param string $detailsMissionThree
     * @return Demandes
     */
    public function setDetailsMissionThree($detailsMissionThree) {
        $this->detailsMissionThree = $detailsMissionThree;

        return $this;
    }

    /**
     * Get detailsMissionThree
     *
     * @return string 
     */
    public function getDetailsMissionThree() {
        return $this->detailsMissionThree;
    }

    /**
     * Set dateLimite
     *
     * @param \DateTime $dateLimite
     * @return Demandes
     */
    public function setDateLimite($dateLimite) {
        $this->dateLimite = $dateLimite;

        return $this;
    }

    /**
     * Get dateLimite
     *
     * @return \DateTime 
     */
    public function getDateLimite() {
        return $this->dateLimite;
    }

    /**
     * Set lien
     *
     * @param string $lien
     * @return Demandes
     */
    public function setLien($lien) {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string 
     */
    public function getLien() {
        return $this->lien;
    }

    /**
     * Set jaime
     *
     * @param integer $jaime
     * @return Demandes
     */
    public function setJaime($jaime) {
        $this->jaime = $jaime;

        return $this;
    }

    /**
     * Get jaime
     *
     * @return integer 
     */
    public function getJaime() {
        return $this->jaime;
    }

    /**
     * Set jeNaimePas
     *
     * @param integer $jeNaimePas
     * @return Demandes
     */
    public function setJeNaimePas($jeNaimePas) {
        $this->jeNaimePas = $jeNaimePas;

        return $this;
    }

    /**
     * Get jeNaimePas
     *
     * @return integer 
     */
    public function getJeNaimePas() {
        return $this->jeNaimePas;
    }

    /**
     * Set niveauUrgence
     *
     * @param string $niveauUrgence
     * @return Demandes
     */
    public function setNiveauUrgence($niveauUrgence) {
        $this->niveauUrgence = $niveauUrgence;

        return $this;
    }

    /**
     * Get niveauUrgence
     *
     * @return string 
     */
    public function getNiveauUrgence() {
        return $this->niveauUrgence;
    }

    /**
     * Set etat
     *
     * @param string $etat
     * @return Demandes
     */
    public function setEtat($etat) {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string 
     */
    public function getEtat() {
        return $this->etat;
    }

    /**
     * Set confidentialite
     *
     * @param string $confidentialite
     * @return Demandes
     */
    public function setConfidentialite($confidentialite) {
        $this->confidentialite = $confidentialite;

        return $this;
    }

    /**
     * Get confidentialite
     *
     * @return string 
     */
    public function getConfidentialite() {
        return $this->confidentialite;
    }

    /**
     * Set docGdl
     *
     * @param string $docGdl
     * @return Demandes
     */
    public function setDocGdl($docGdl) {
        $this->docGdl = $docGdl;

        return $this;
    }

    /**
     * Get docGdl
     *
     * @return string 
     */
    public function getDocGdl() {
        return $this->docGdl;
    }

    /**
     * Set envoiePrevuLe
     *
     * @param \DateTime $envoiePrevuLe
     * @return Demandes
     */
    public function setEnvoiePrevuLe($envoiePrevuLe) {
        $this->envoiePrevuLe = $envoiePrevuLe;

        return $this;
    }

    /**
     * Get envoiePrevuLe
     *
     * @return \DateTime 
     */
    public function getEnvoiePrevuLe() {
        return $this->envoiePrevuLe;
    }

    /**
     * Set mettreEnCopie
     *
     * @param string $mettreEnCopie
     * @return Demandes
     */
    public function setMettreEnCopie($mettreEnCopie) {
        $this->mettreEnCopie = $mettreEnCopie;

        return $this;
    }

    /**
     * Get mettreEnCopie
     *
     * @return string 
     */
    public function getMettreEnCopie() {
        return $this->mettreEnCopie;
    }

    /**
     * Set datePosteDemande
     *
     * @param \DateTime $datePosteDemande
     * @return Demandes
     */
    public function setDatePosteDemande($datePosteDemande) {
        $this->datePosteDemande = $datePosteDemande;

        return $this;
    }

    /**
     * Get datePosteDemande
     *
     * @return \DateTime 
     */
    public function getDatePosteDemande() {
        return $this->datePosteDemande;
    }

    /**
     * Set dateDernierMiseAJour
     *
     * @param \DateTime $dateDernierMiseAJour
     * @return Demandes
     */
    public function setDateDernierMiseAJour($dateDernierMiseAJour) {
        $this->dateDernierMiseAJour = $dateDernierMiseAJour;

        return $this;
    }

    /**
     * Get dateDernierMiseAJour
     *
     * @return \DateTime 
     */
    public function getDateDernierMiseAJour() {
        return $this->dateDernierMiseAJour;
    }

    /**
     * Set accueil
     *
     * @param integer $accueil
     * @return Demandes
     */
    public function setAccueil($accueil) {
        $this->accueil = $accueil;

        return $this;
    }

    /**
     * Get accueil
     *
     * @return integer 
     */
    public function getAccueil() {
        return $this->accueil;
    }


    /**
     * Set utilisateur
     *
     * @param \Utilisateurs\UtilisateursBundle\Entity\Utilisateurs $utilisateur
     * @return Demandes
     */
    public function setUtilisateur(\Utilisateurs\UtilisateursBundle\Entity\Utilisateurs $utilisateur)
    {
        $this->utilisateur = $utilisateur;
    
        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \Utilisateurs\UtilisateursBundle\Entity\Utilisateurs 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set auNomDe
     *
     * @param \Utilisateurs\UtilisateursBundle\Entity\Utilisateurs $auNomDe
     * @return Demandes
     */
    public function setAuNomDe(\Utilisateurs\UtilisateursBundle\Entity\Utilisateurs $auNomDe = null)
    {
        $this->auNomDe = $auNomDe;
    
        return $this;
    }

    /**
     * Get auNomDe
     *
     * @return \Utilisateurs\UtilisateursBundle\Entity\Utilisateurs 
     */
    public function getAuNomDe()
    {
        return $this->auNomDe;
    }

    /**
     * Set sites
     *
     * @param \Gestion\GestionBundle\Entity\Sites $sites
     * @return Demandes
     */
    public function setSites(\Gestion\GestionBundle\Entity\Sites $sites)
    {
        $this->sites = $sites;
    
        return $this;
    }

    /**
     * Get sites
     *
     * @return \Gestion\GestionBundle\Entity\Sites 
     */
    public function getSites()
    {
        return $this->sites;
    }

    /**
     * Set missionOne
     *
     * @param \Gestion\GestionBundle\Entity\Missions $missionOne
     * @return Demandes
     */
    public function setMissionOne(\Gestion\GestionBundle\Entity\Missions $missionOne = null)
    {
        $this->missionOne = $missionOne;
    
        return $this;
    }

    /**
     * Get missionOne
     *
     * @return \Gestion\GestionBundle\Entity\Missions 
     */
    public function getMissionOne()
    {
        return $this->missionOne;
    }

    /**
     * Set missionTwo
     *
     * @param \Gestion\GestionBundle\Entity\Missions $missionTwo
     * @return Demandes
     */
    public function setMissionTwo(\Gestion\GestionBundle\Entity\Missions $missionTwo = null)
    {
        $this->missionTwo = $missionTwo;
    
        return $this;
    }

    /**
     * Get missionTwo
     *
     * @return \Gestion\GestionBundle\Entity\Missions 
     */
    public function getMissionTwo()
    {
        return $this->missionTwo;
    }

    /**
     * Set missionThree
     *
     * @param \Gestion\GestionBundle\Entity\Missions $missionThree
     * @return Demandes
     */
    public function setMissionThree(\Gestion\GestionBundle\Entity\Missions $missionThree = null)
    {
        $this->missionThree = $missionThree;
    
        return $this;
    }

    /**
     * Get missionThree
     *
     * @return \Gestion\GestionBundle\Entity\Missions 
     */
    public function getMissionThree()
    {
        return $this->missionThree;
    }
    public function __toString() {
        return $this->getSites()." : ".$this->getId();
    }


    /**
     * Set dateLivraison
     *
     * @param \DateTime $dateLivraison
     * @return Demandes
     */
    public function setDateLivraison($dateLivraison)
    {
        $this->dateLivraison = $dateLivraison;
    
        return $this;
    }

    /**
     * Get dateLivraison
     *
     * @return \DateTime 
     */
    public function getDateLivraison()
    {
        return $this->dateLivraison;
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
     * Set chefDeProjet
     *
     * @param string $chefDeProjet
     * @return Demandes
     */
    public function setChefDeProjet($chefDeProjet)
    {
        $this->chefDeProjet = $chefDeProjet;
    
        return $this;
    }

    /**
     * Get chefDeProjet
     *
     * @return string 
     */
    public function getChefDeProjet()
    {
        return $this->chefDeProjet;
    }
    
    /**
     * Set potentielFacturation
     *
     * @param string $potentielFacturation
     * @return Demandes
     */
    public function setPotentielFacturation($potentielFacturation)
    {
        $this->potentielFacturation = $potentielFacturation;
    
        return $this;
    }

    /**
     * Get potentielFacturation
     *
     * @return string 
     */
    public function getPotentielFacturation()
    {
        return $this->potentielFacturation;
    }

    /**
     * Set categorie
     *
     * @param \Gestion\GestionBundle\Entity\Categories $categorie
     * @return Demandes
     */
    public function setCategorie(\Gestion\GestionBundle\Entity\Categories $categorie = null)
    {
        $this->categorie = $categorie;
    
        return $this;
    }

    /**
     * Get categorie
     *
     * @return \Gestion\GestionBundle\Entity\Categories 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
}
