<?php

namespace EmploiyerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mession
 *
 * @ORM\Table(name="mession")
 * @ORM\Entity(repositoryClass="EmploiyerBundle\Repository\MessionRepository")
 */
class Mession
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=200)
     */
    private $designation;

    /**
     * @var int
     *
     * @ORM\Column(name="periode", type="integer")
     */
    private $periode;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debut", type="datetime")
     */
    private $debut;

    /**
     * @ORM\ManyToOne(targetEntity="Employe" , inversedBy="Mession")
     * @ORM\joinColumn(onDelete="cascade", nullable=true)
     */
    private $employer;

    /**
     * @ORM\OneToOne(targetEntity="Adresse")
     *
     * @ORM\joinColumn(onDelete="cascade")
     */
    private $Adresse;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set designation
     *
     * @param string $designation
     *
     * @return Mession
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set periode
     *
     * @param integer $periode
     *
     * @return Mession
     */
    public function setPeriode($periode)
    {
        $this->periode = $periode;

        return $this;
    }

    /**
     * Get periode
     *
     * @return int
     */
    public function getPeriode()
    {
        return $this->periode;
    }

    /**
     * Set debut
     *
     * @param \DateTime $debut
     *
     * @return Mession
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut
     *
     * @return \DateTime
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * @return mixed
     */
    public function getEmployer ()
    {
        return $this->employer;
    }

    /**
     * @param mixed $employer
     */
    public function setEmployer ($employer)
    {
        $this->employer = $employer;
    }

    /**
     * @param mixed $Adresse
     */
    public function setAdresse ($Adresse)
    {
        $this->Adresse = $Adresse;
    }

    /**
     * @return mixed
     */
    public function getAdresse ()
    {
        return $this->Adresse;
    }
}

