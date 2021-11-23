<?php

namespace App\Entity;

use App\Repository\RectificacionDesgloseManifiestoRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RectificacionDesgloseManifiestoRepository::class)
 */
class RectificacionDesgloseManifiesto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $aduaman;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaInsercion;

    /**
     * @ORM\Column(type="text")
     */
    private $tipo;

    /**
     * @ORM\Column(type="boolean")
     */
    private $multa;

    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="string", length=100)
     */
    private $numeroMBL;
    
    /**
     * @ORM\Column(type="integer", length=11, nullable =  true)
     */
    private $numeroMulta;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $numeroManifiesto;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $numeroRectificacionDesglose;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $desagrupe; 
    
    /**
     * @ORM\Column(type="date")
     */
    private $fechaReciboManifiesto;
    
    /**
     * @ORM\Column(type="date")
     */
    private $fechaRecibidaMulta;
    
    
    /**
     * @ORM\Column(type="date")
     */
    private $fechaCreacionRectificacion;
    
    /**
     * @ORM\Column(type="date")
     */
    private $fechaNotificacionMulta;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Contenedor", inversedBy="rectificacionDesgloseManifiesto")
     */
    private $contenedor; 
     
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Naviera", inversedBy="rectificacionDesgloseManifiesto")
     */
    private $naviera;  
    

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

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

    public function getNumeroMBL(): ?string
    {
        return $this->numeroMBL;
    }

    public function setNumeroMBL(string $numeroMBL): self
    {
        $this->numeroMBL = $numeroMBL;

        return $this;
    }

    public function getNumeroManifiesto(): ?string
    {
        return $this->numeroManifiesto;
    }

    public function setNumeroManifiesto(string $numeroManifiesto): self
    {
        $this->numeroManifiesto = $numeroManifiesto;

        return $this;
    }

    public function getDesagrupe(): ?string
    {
        return $this->desagrupe;
    }

    public function setDesagrupe(string $desagrupe): self
    {
        $this->desagrupe = $desagrupe;

        return $this;
    }

    public function getNumeroRectificacionDesglose(): ?string
    {
        return $this->numeroRectificacionDesglose;
    }

    public function setNumeroRectificacionDesglose(string $numeroRectificacionDesglose): self
    {
        $this->numeroRectificacionDesglose = $numeroRectificacionDesglose;

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

    public function getNaviera(): ?Naviera
    {
        return $this->naviera;
    }

    public function setNaviera(?Naviera $naviera): self
    {
        $this->naviera = $naviera;

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

    public function getFechaCreacionRectificacion(): ?\DateTimeInterface
    {
        return $this->fechaCreacionRectificacion;
    }

    public function setFechaCreacionRectificacion(\DateTimeInterface $fechaCreacionRectificacion): self
    {
        $this->fechaCreacionRectificacion = $fechaCreacionRectificacion;

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

    public function getNumeroMulta(): ?int
    {
        return $this->numeroMulta;
    }

    public function setNumeroMulta(int $numeroMulta): self
    {
        $this->numeroMulta = $numeroMulta;

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
    public function __toString() {
                                return $this->numeroRectificacionDesglose; 
                            }
    
    
    
}
