<?php

namespace Gestion\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jaime
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gestion\GestionBundle\Repository\JaimeRepository")
 */
class Jaime
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
     * @var integer
     *
     * @ORM\Column(name="utilisateur", type="integer")
     */
    private $utilisateur;

    /**
     * @var integer
     *
     * @ORM\Column(name="demande", type="integer")
     */
    private $demande;

    /**
     * @var integer
     *
     * @ORM\Column(name="jaime", type="integer")
     */
    private $jaime;

    /**
     * @var integer
     *
     * @ORM\Column(name="jaimepas", type="integer")
     */
    private $jaimepas;


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
     * @param integer $utilisateur
     * @return Jaime
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
     * Set demande
     *
     * @param integer $demande
     * @return Jaime
     */
    public function setDemande($demande)
    {
        $this->demande = $demande;
    
        return $this;
    }

    /**
     * Get demande
     *
     * @return integer 
     */
    public function getDemande()
    {
        return $this->demande;
    }

    /**
     * Set jaime
     *
     * @param integer $jaime
     * @return Jaime
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
     * Set jaimepas
     *
     * @param integer $jaimepas
     * @return Jaime
     */
    public function setJaimepas($jaimepas)
    {
        $this->jaimepas = $jaimepas;
    
        return $this;
    }

    /**
     * Get jaimepas
     *
     * @return integer 
     */
    public function getJaimepas()
    {
        return $this->jaimepas;
    }
}
