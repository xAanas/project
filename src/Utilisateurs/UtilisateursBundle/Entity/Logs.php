<?php

namespace Utilisateurs\UtilisateursBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Logs
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Utilisateurs\UtilisateursBundle\Repository\LogsRepository")
 */
class Logs
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
     * @var string
     *
     * @ORM\Column(name="log", type="text")
     */
    private $log;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateLog", type="date")
     */
    private $dateLog;


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
     * Set log
     *
     * @param string $log
     * @return Logs
     */
    public function setLog($log)
    {
        $this->log = $log;
    
        return $this;
    }

    /**
     * Get log
     *
     * @return string 
     */
    public function getLog()
    {
        return $this->log;
    }

    /**
     * Set dateLog
     *
     * @param \DateTime $dateLog
     * @return Logs
     */
    public function setDateLog($dateLog)
    {
        $this->dateLog = $dateLog;
    
        return $this;
    }

    /**
     * Get dateLog
     *
     * @return \DateTime 
     */
    public function getDateLog()
    {
        return $this->dateLog;
    }
}
