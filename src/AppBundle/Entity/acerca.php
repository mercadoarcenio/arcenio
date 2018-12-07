<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * acerca
 *
 * @ORM\Table(name="acerca")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\acercaRepository")
 */
class acerca
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
     * @ORM\Column(name="mision", type="string", length=255)
     */
    private $mision;

    /**
     * @var string
     *
     * @ORM\Column(name="vision", type="string", length=255)
     */
    private $vision;

    /**
     * @var string
     *
     * @ORM\Column(name="historia", type="text")
     */
    private $historia;


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
     * Set mision
     *
     * @param string $mision
     *
     * @return acerca
     */
    public function setMision($mision)
    {
        $this->mision = $mision;

        return $this;
    }

    /**
     * Get mision
     *
     * @return string
     */
    public function getMision()
    {
        return $this->mision;
    }

    /**
     * Set vision
     *
     * @param string $vision
     *
     * @return acerca
     */
    public function setVision($vision)
    {
        $this->vision = $vision;

        return $this;
    }

    /**
     * Get vision
     *
     * @return string
     */
    public function getVision()
    {
        return $this->vision;
    }

    /**
     * Set historia
     *
     * @param string $historia
     *
     * @return acerca
     */
    public function setHistoria($historia)
    {
        $this->historia = $historia;

        return $this;
    }

    /**
     * Get historia
     *
     * @return string
     */
    public function getHistoria()
    {
        return $this->historia;
    }
}

