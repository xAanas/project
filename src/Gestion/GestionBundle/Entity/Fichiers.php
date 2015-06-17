<?php

namespace Gestion\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Fichiers
 *
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Gestion\GestionBundle\Repository\FichiersRepository")
 */
class Fichiers {

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
     * @ORM\Column(name="lien", type="string", length=255, nullable=true)
     */
    private $lien;

    /**
     * @ORM\ManyToOne(targetEntity="Gestion\GestionBundle\Entity\Demandes",inversedBy="fichiers") 
     * @ORM\JoinColumn(nullable=true)
     */
    private $publication;

    /**
     * @ORM\ManyToOne(targetEntity="Gestion\GestionBundle\Entity\Commentaires",inversedBy="fichier") 
     * @ORM\JoinColumn(nullable=true)
     */
    private $commentaire;

    /**
     * @Assert\File(maxSize="600000000")
     */
    public $file;

    function getFile() {
        return $this->file;
    }

    function setFile($file) {
        $this->file = $file;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set lien
     *
     * @param string $lien
     * @return Fichiers
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
     * Set publication
     *
     * @param string $publication
     * @return Fichiers
     */
    public function setPublication($publication) {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return string 
     */
    public function getPublication() {
        return $this->publication;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     * @return Fichiers
     */
    public function setCommentaire($commentaire) {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string 
     */
    public function getCommentaire() {
        return $this->commentaire;
    }
    
    public function getAbsolutePath() {
        return null === $this->lien ? null : $this->getUploadRootDir() . '/' . $this->lien;
    }

    public function getWebPath() {
        return null === $this->lien ? null : $this->getUploadDir() . '/' . $this->lien;
    }

    protected function getUploadRootDir() {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'uploads';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
        if (null !== $this->file) {


            $this->lien = sha1(uniqid(mt_rand(), true)) . '.' . $this->file->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {

        if (null === $this->file) {
            return;
        }


        $this->file->move($this->getUploadRootDir(), $this->lien);

        unset($this->file);
    }
    
    public function __toString() {
        return $this->getId().'ok';
    }

}
