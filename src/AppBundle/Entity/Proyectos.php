<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proyectos
 *
 * @ORM\Table(name="proyectos")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProyectosRepository")
 */
class Proyectos
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
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255)
     */
    private $imagen;

    /**
     * @var string
     *
     * @ORM\Column(name="fuen_finan", type="string", length=255)
     */
    private $fuenFinan;

    /**
     * @var string
     *
     * @ORM\Column(name="modalidad", type="string", length=255)
     */
    private $modalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="objetivos", type="string", length=255)
     */
    private $objetivos;


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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Proyectos
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Proyectos
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set fuenFinan
     *
     * @param string $fuenFinan
     *
     * @return Proyectos
     */
    public function setFuenFinan($fuenFinan)
    {
        $this->fuenFinan = $fuenFinan;

        return $this;
    }

    /**
     * Get fuenFinan
     *
     * @return string
     */
    public function getFuenFinan()
    {
        return $this->fuenFinan;
    }

    /**
     * Set modalidad
     *
     * @param string $modalidad
     *
     * @return Proyectos
     */
    public function setModalidad($modalidad)
    {
        $this->modalidad = $modalidad;

        return $this;
    }

    /**
     * Get modalidad
     *
     * @return string
     */
    public function getModalidad()
    {
        return $this->modalidad;
    }

    /**
     * Set objetivos
     *
     * @param string $objetivos
     *
     * @return Proyectos
     */
    public function setObjetivos($objetivos)
    {
        $this->objetivos = $objetivos;

        return $this;
    }

    /**
     * Get objetivos
     *
     * @return string
     */
    public function getObjetivos()
    {
        return $this->objetivos;
    }
}

