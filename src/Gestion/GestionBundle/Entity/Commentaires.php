<?php

namespace Gestion\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaires
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\GestionBundle\Repository\CommentairesRepository")
 */
class Commentaires
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
    private $utilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
     * @ORM\OneToMany(targetEntity="Gestion\GestionBundle\Entity\Fichiers",mappedBy="commentaire",cascade={"persist"}) 
     * @ORM\JoinColumn(nullable=true)
     */
    private $fichier;

    /**
     * @ORM\ManyToOne(targetEntity="Gestion\GestionBundle\Entity\Demandes") 
     * @ORM\JoinColumn(nullable=false)
     */
    private $demande;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCommentaire", type="datetime")
     */
    private $dateCommentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateSuppression", type="datetime", nullable=true)
     */
    private $dateSuppression;

    function __construct() {
        $this->fichier = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set utilisateur
     *
     * @param string $utilisateur
     * @return Commentaires
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
     * Set contenu
     *
     * @param string $contenu
     * @return Commentaires
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
     * Set fichier
     *
     * @param string $fichier
     * @return Commentaires
     */
    public function setFichier($fichier)
    {
        $this->fichier = $fichier;
    
        return $this;
    }

    /**
     * Get fichier
     *
     * @return string 
     */
    public function getFichier()
    {
        return $this->fichier;
    }

    /**
     * Set demande
     *
     * @param string $demande
     * @return Commentaires
     */
    public function setDemande($demande)
    {
        $this->demande = $demande;
    
        return $this;
    }

    /**
     * Get demande
     *
     * @return string 
     */
    public function getDemande()
    {
        return $this->demande;
    }

    /**
     * Set dateCommentaire
     *
     * @param \DateTime $dateCommentaire
     * @return Commentaires
     */
    public function setDateCommentaire($dateCommentaire)
    {
        $this->dateCommentaire = $dateCommentaire;
    
        return $this;
    }

    /**
     * Get dateCommentaire
     *
     * @return \DateTime 
     */
    public function getDateCommentaire()
    {
        return $this->dateCommentaire;
    }

    /**
     * Set dateSuppression
     *
     * @param \DateTime $dateSuppression
     * @return Commentaires
     */
    public function setDateSuppression($dateSuppression)
    {
        $this->dateSuppression = $dateSuppression;
    
        return $this;
    }

    /**
     * Get dateSuppression
     *
     * @return \DateTime 
     */
    public function getDateSuppression()
    {
        return $this->dateSuppression;
    }

    /**
     * Add fichier
     *
     * @param \Gestion\GestionBundle\Entity\Fichiers $fichier
     * @return Commentaires
     */
    public function addFichier(\Gestion\GestionBundle\Entity\Fichiers $fichier)
    {
        $this->fichier[] = $fichier;
    
        return $this;
    }

    /**
     * Remove fichier
     *
     * @param \Gestion\GestionBundle\Entity\Fichiers $fichier
     */
    public function removeFichier(\Gestion\GestionBundle\Entity\Fichiers $fichier)
    {
        $this->fichier->removeElement($fichier);
    }
}
