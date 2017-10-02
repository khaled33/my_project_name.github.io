<?php

namespace EmploiyerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Absence
 *
 * @ORM\Table(name="Absence")
 * @ORM\Entity(repositoryClass="EmploiyerBundle\Repository\AbsenceRepository")
 */
class Absence
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
     * @var int
     *
     * @ORM\Column(name="employe_id", type="integer")
     */
    private $employe_id;


    /**
     * @ORM\ManyToOne(targetEntity="Employe")
     * @ORM\joinColumn(onDelete="cascade", nullable=true)
     */

    private $Employe;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debut", type="datetime")
     */


    private $debut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin", type="datetime")
     */
    private $fin;

    /**
     * @var string
     *
     * @ORM\Column(name="remarque", type="string", length=200)
     */
    private $remarque;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     *@var \int
     *
     *@ORM\Column(name="diff", type="integer", length=255)
     */
    private $diff;

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
     * @param int $id
     */
    public function setId ($id)
    {
        $this->id = $id;
    }

    /**
     * Set debut
     *
     * @param \DateTime $debut
     *
     * @return absence
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
     * Set fin
     *
     * @param \DateTime $fin
     *
     * @return absence
     */
    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin
     *
     * @return \DateTime
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set remarque
     *
     * @param string $remarque
     *
     * @return absence
     */
    public function setRemarque($remarque)
    {
        $this->remarque = $remarque;

        return $this;
    }

    /**
     * Get remarque
     *
     * @return string
     */
    public function getRemarque()
    {
        return $this->remarque;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return absence
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getEmploye ()
    {
        return $this->Employe;
    }

    /**
     * @param mixed $Employe
     */
    public function setEmploye ($Employe)
    {
        $this->Employe = $Employe;
    }

    /**
     * @return int
     */
    public function getEmployeId ()
    {
        return $this->employe_id;
    }

    /**
     * @param int $employe_id
     */
    public function setEmployeId ($employe_id)
    {
        $this->employe_id = $employe_id;
    }

    /**
     * @return mixed
     */
    public function getDiff ()
    {
        return $this->diff;
    }

    /**
     * @param mixed $diff
     */
    public function setDiff ($diff)
    {
        $this->diff = $diff;
    }




}

