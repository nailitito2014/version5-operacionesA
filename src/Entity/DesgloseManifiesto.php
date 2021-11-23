<?php

namespace App\Entity;

use App\Repository\DesgloseManifiestoRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DesgloseManifiestoRepository::class)
 */
class DesgloseManifiesto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $numeroDesgloseManifiesto;

    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="integer")
     */
    private $numeroMBL;

    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="integer")
     */
    private $numeroViaje;

    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="string", length=255)
     */
    private $aduaman;

    /**
     * @ORM\Column(type="boolean")
     */
    private $multa;

    /**
      * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="date")
     */
    private $fechaArriboBuque;

    /**
      * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="date")
     */
    private $fechaReciboManifiesto;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaDesgloseManifiesto;

    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="string", length=255)
     */
    private $coment;

    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="date")
     */
    private $fechaNotificacionMulta;

    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="date")
     */
    private $fechaRecibidaMulta;

    /**
     * @ORM\Column(type="integer",nullable= true)
     */
    private $numeroMulta;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Contenedor", inversedBy="desgloseManifiesto")
     */
    private $contenedor;
    
    /**
     * @ORM\Column(type="date")
     */
    private $fechaInsercion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroDesgloseManifiesto(): ?string
    {
        return $this->numeroDesgloseManifiesto;
    }

    public function setNumeroDesgloseManifiesto(string $numeroDesgloseManifiesto): self
    {
        $this->numeroDesgloseManifiesto = $numeroDesgloseManifiesto;

        return $this;
    }

    public function getNumeroMBL(): ?int
    {
        return $this->numeroMBL;
    }

    public function setNumeroMBL(int $numeroMBL): self
    {
        $this->numeroMBL = $numeroMBL;

        return $this;
    }

    public function getNumeroContenedor(): ?int
    {
        return $this->numeroContenedor;
    }

    public function setNumeroContenedor(int $numeroContenedor): self
    {
        $this->numeroContenedor = $numeroContenedor;

        return $this;
    }

    public function getNumeroViaje(): ?int
    {
        return $this->numeroViaje;
    }

    public function setNumeroViaje(int $numeroViaje): self
    {
        $this->numeroViaje = $numeroViaje;

        return $this;
    }

    public function getAduaman(): ?string
    {
        return $this->aduaman;
    }

    public function setAduaman(string $aduaman): self
    {
        $this->aduaman = $aduaman;

        return $this;
    }

    public function getMulta(): ?bool
    {
        return $this->multa;
    }

    public function setMulta(bool $multa): self
    {
        $this->multa = $multa;

        return $this;
    }

    public function getFechaArriboBuque(): ?\DateTimeInterface
    {
        return $this->fechaArriboBuque;
    }

    public function setFechaArriboBuque(\DateTimeInterface $fechaArriboBuque): self
    {
        $this->fechaArriboBuque = $fechaArriboBuque;

        return $this;
    }

    public function getFechaReciboManifiesto(): ?\DateTimeInterface
    {
        return $this->fechaReciboManifiesto;
    }

    public function setFechaReciboManifiesto(\DateTimeInterface $fechaReciboManifiesto): self
    {
        $this->fechaReciboManifiesto = $fechaReciboManifiesto;

        return $this;
    }

    public function getFechaDesgloseManifiesto(): ?\DateTimeInterface
    {
        return $this->fechaDesgloseManifiesto;
    }

    public function setFechaDesgloseManifiesto(\DateTimeInterface $fechaDesgloseManifiesto): self
    {
        $this->fechaDesgloseManifiesto = $fechaDesgloseManifiesto;

        return $this;
    }

    public function getComent(): ?string
    {
        return $this->coment;
    }

    public function setComent(string $coment): self
    {
        $this->coment = $coment;

        return $this;
    }

    public function getFechaNotificacionMulta(): ?\DateTimeInterface
    {
        return $this->fechaNotificacionMulta;
    }

    public function setFechaNotificacionMulta(\DateTimeInterface $fechaNotificacionMulta): self
    {
        $this->fechaNotificacionMulta = $fechaNotificacionMulta;

        return $this;
    }

    public function getFechaRecibidaMulta(): ?\DateTimeInterface
    {
        return $this->fechaRecibidaMulta;
    }

    public function setFechaRecibidaMulta(\DateTimeInterface $fechaRecibidaMulta): self
    {
        $this->fechaRecibidaMulta = $fechaRecibidaMulta;

        return $this;
    }

    public function getNumeroMulta(): ?int
    {
        return $this->numeroMulta;
    }

    public function setNumeroMulta(int $numeroMulta): self
    {
        $this->numeroMulta = $numeroMulta;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getFechaInsercion(): ?\DateTimeInterface
    {
        return $this->fechaInsercion;
    }

    public function setFechaInsercion(\DateTimeInterface $fechaInsercion): self
    {
        $this->fechaInsercion = $fechaInsercion;

        return $this;
    }

    public function getContenedor(): ?Contenedor
    {
        return $this->contenedor;
    }

    public function setContenedor(?Contenedor $contenedor): self
    {
        $this->contenedor = $contenedor;

        return $this;
    }
       public function __toString() {
                                return (string)$this->numeroDesgloseManifiesto; 
                            }
}
