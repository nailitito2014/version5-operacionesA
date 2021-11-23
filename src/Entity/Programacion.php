<?php

namespace App\Entity;

use App\Repository\ProgramacionRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProgramacionRepository::class)
 */
class Programacion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $observaciones;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaArriboMariel;
    
    /**
     * @ORM\Column(type="date")
     */
    private $fechaEntregadoAduana;
    
    /**
     * @ORM\Column(type="date")
     */
    private $fechaDespachar;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco") 
     * @ORM\Column(type="integer", length=11)
     */
    private $deposito;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco") 
     * @ORM\Column(type="integer", length=11)
     */
    private $bultos;
    
   
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco") 
     * @ORM\Column(type="integer", length=11)
     */
    private $numeroManifiesto;  
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco") 
     * @ORM\Column(type="integer", length=11)
     */
    private $numeroDesglose; 
    
    /**
     * @ORM\Column(type="text")
     */
    private $detalleCarga;  
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="programacion")
     */
    private $cliente;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="TipoContenedor", inversedBy="programacion")
     */
    private $tipoContenedor;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Transitario", inversedBy="programacion")
     */
    private $transitario; 
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Naviera", inversedBy="programacion")
     */
    private $naviera;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Contenedor", inversedBy="programacion")
     */
    private $contenedor;
    
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaInsercion;
      

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(string $observaciones): self
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    public function getFechaArriboMariel(): ?\DateTimeInterface
    {
        return $this->fechaArriboMariel;
    }

    public function setFechaArriboMariel(\DateTimeInterface $fechaArriboMariel): self
    {
        $this->fechaArriboMariel = $fechaArriboMariel;

        return $this;
    }

    public function getFechaEntregadoAduana(): ?\DateTimeInterface
    {
        return $this->fechaEntregadoAduana;
    }

    public function setFechaEntregadoAduana(\DateTimeInterface $fechaEntregadoAduana): self
    {
        $this->fechaEntregadoAduana = $fechaEntregadoAduana;

        return $this;
    }

    public function getFechaDespachar(): ?\DateTimeInterface
    {
        return $this->fechaDespachar;
    }

    public function setFechaDespachar(\DateTimeInterface $fechaDespachar): self
    {
        $this->fechaDespachar = $fechaDespachar;

        return $this;
    }

    public function getDeposito(): ?int
    {
        return $this->deposito;
    }

    public function setDeposito(int $deposito): self
    {
        $this->deposito = $deposito;

        return $this;
    }

    public function getBultos(): ?int
    {
        return $this->bultos;
    }

    public function setBultos(int $bultos): self
    {
        $this->bultos = $bultos;

        return $this;
    }

    public function getNumeroManifiesto(): ?int
    {
        return $this->numeroManifiesto;
    }

    public function setNumeroManifiesto(int $numeroManifiesto): self
    {
        $this->numeroManifiesto = $numeroManifiesto;

        return $this;
    }

    public function getNumeroDesglose(): ?int
    {
        return $this->numeroDesglose;
    }

    public function setNumeroDesglose(int $numeroDesglose): self
    {
        $this->numeroDesglose = $numeroDesglose;

        return $this;
    }

    public function getDetalleCarga(): ?string
    {
        return $this->detalleCarga;
    }

    public function setDetalleCarga(string $detalleCarga): self
    {
        $this->detalleCarga = $detalleCarga;

        return $this;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getTipoContenedor(): ?TipoContenedor
    {
        return $this->tipoContenedor;
    }

    public function setTipoContenedor(?TipoContenedor $tipoContenedor): self
    {
        $this->tipoContenedor = $tipoContenedor;

        return $this;
    }

    public function getTransitario(): ?Transitario
    {
        return $this->transitario;
    }

    public function setTransitario(?Transitario $transitario): self
    {
        $this->transitario = $transitario;

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

    public function getContenedor(): ?Contenedor
    {
        return $this->contenedor;
    }

    public function setContenedor(?Contenedor $contenedor): self
    {
        $this->contenedor = $contenedor;

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
    
      public function __toString() {
                                return (string)$this->id; 
                            }
}
