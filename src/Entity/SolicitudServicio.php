<?php

namespace App\Entity;

use App\Repository\SolicitudServicioRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SolicitudServicioRepository::class)
 */
class SolicitudServicio
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
    private $numeroSolicitud;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaSolicitud;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="TipoServicio", inversedBy="solicitudServicio")
     */
    private $tipoServicio;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="solicitudServicio")
     */
    private $cliente;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="ViaRecepcion", inversedBy="solicitudServicio")
     */
    private $viaRecepcion;
    
    /**
     * @ORM\Column(type="date")
     */
    private $fechaInsercion;
    
    /**
     * @ORM\Column(type="boolean", nullable = true)
     */
    private $solicitudActiva = true;
    
    /**
     * @ORM\Column(type="date",nullable = true)
     */
    private $fechaDesactivacion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaSolicitud(): ?\DateTimeInterface
    {
        return $this->fechaSolicitud;
    }

    public function setFechaSolicitud(\DateTimeInterface $fechaSolicitud): self
    {
        $this->fechaSolicitud = $fechaSolicitud;

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

    public function getTipoServicio(): ?TipoServicio
    {
        return $this->tipoServicio;
    }

    public function setTipoServicio(?TipoServicio $tipoServicio): self
    {
        $this->tipoServicio = $tipoServicio;

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

    public function getViaRecepcion(): ?ViaRecepcion
    {
        return $this->viaRecepcion;
    }

    public function setViaRecepcion(?ViaRecepcion $viaRecepcion): self
    {
        $this->viaRecepcion = $viaRecepcion;

        return $this;
    }
    
     public function __toString() {
                                return (string)$this->numeroSolicitud; 
                            }

     public function getNumeroSolicitud(): ?string
     {
         return $this->numeroSolicitud;
     }

     public function setNumeroSolicitud(string $numeroSolicitud): self
     {
         $this->numeroSolicitud = $numeroSolicitud;

         return $this;
     }

     public function getSolicitudActiva(): ?bool
     {
         return $this->solicitudActiva;
     }

     public function setSolicitudActiva(?bool $solicitudActiva): self
     {
         $this->solicitudActiva = $solicitudActiva;

         return $this;
     }

     public function getFechaDesactivacion(): ?\DateTimeInterface
     {
         return $this->fechaDesactivacion;
     }

     public function setFechaDesactivacion(\DateTimeInterface $fechaDesactivacion): self
     {
         $this->fechaDesactivacion = $fechaDesactivacion;

         return $this;
     }
}
