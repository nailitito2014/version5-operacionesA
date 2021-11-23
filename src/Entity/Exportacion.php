<?php

namespace App\Entity;

use App\Repository\ExportacionRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExportacionRepository::class)
 */
class Exportacion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaVisita;
    
    /**
     * @ORM\Column(type="string" , length= 100, nullable = true)
     */
    private $numeroExportacion;
    
    /**
     * @ORM\Column(type="float" , nullable = true)
     */
    private $costoOrigen;
    
    /**
     * @ORM\Column(type="float" , nullable = true)
     */
    private $flete;
    
    /**
     * @ORM\Column(type="float" , nullable = true)
     */
    private $destino;
    
    /**
     * @ORM\Column(type="float" , nullable = true)
     */
    private $recargo;
    
    /**
     * @ORM\Column(type="float" , nullable = true)
     */
    private $rx;

    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="text")
     */
    private $descripcionCarga;

    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="text")
     */
    private $direccionOrigen;

    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="date")
     */
    private $fechaEstimadoServicio;

    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="date")
     */
    private $fechaSalidaEmbarque;

    /**
      * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="date")
     */
    private $fechaArribo;

    /**
      * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="date")
     */
    private $fechaEstimadaSalida;

    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="text")
     */
    private $documentosRecibidos;

    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="text")
     */
    private $detalleServicios;

    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="text")
     */
    private $observaciones;

    /**
     * @ORM\Column(type="float",nullable = true)
     */
    private $presupuesto;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaInsercion;
    
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="SolicitudServicio", inversedBy="exportacion")
     */
    private $solicitudServicio;
    
 
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="CondicionCompra", inversedBy="exportacion")
     */
    private $condicionCompra; 
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Puerto", inversedBy="exportacion")
     */
    private $puertoOrigen; 
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Puerto", inversedBy="exportacion")
     */
    private $puertoDestino; 
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Contenedor", inversedBy="exportacion")
     */
    private $contenedor; 
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Contrato", inversedBy="exportacion")
     */
    private $contrato; 
    
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="text")
     */
    private $direccionDestino;
    
    
    /**
     * @ORM\Column(type="boolean", nullable = true)
     */
    private $exportacionActiva = true;
    
    /**
     * @ORM\Column(type="date",nullable = true)
     */
    private $fechaDesactivacion;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="TipoMoneda", inversedBy="exportacion")
     */
    private $tipoMoneda;
    
     /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="ViaTransportacion", inversedBy="exportacion")
     */
    private $viaTransportacion;
    
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdServicio(): ?int
    {
        return $this->idServicio;
    }

    public function setIdServicio(int $idServicio): self
    {
        $this->idServicio = $idServicio;

        return $this;
    }

    public function getFechaVisita(): ?\DateTimeInterface
    {
        return $this->fechaVisita;
    }

    public function setFechaVisita(\DateTimeInterface $fechaVisita): self
    {
        $this->fechaVisita = $fechaVisita;

        return $this;
    }

    public function getDescripcionCarga(): ?string
    {
        return $this->descripcionCarga;
    }

    public function setDescripcionCarga(string $descripcionCarga): self
    {
        $this->descripcionCarga = $descripcionCarga;

        return $this;
    }

    public function getDireccionOrigen(): ?string
    {
        return $this->direccionOrigen;
    }

    public function setDireccionOrigen(string $direccionOrigen): self
    {
        $this->direccionOrigen = $direccionOrigen;

        return $this;
    }

    public function getFechaEstimadoServicio(): ?\DateTimeInterface
    {
        return $this->fechaEstimadoServicio;
    }

    public function setFechaEstimadoServicio(\DateTimeInterface $fechaEstimadoServicio): self
    {
        $this->fechaEstimadoServicio = $fechaEstimadoServicio;

        return $this;
    }

    public function getFechaSalidaEmbarque(): ?\DateTimeInterface
    {
        return $this->fechaSalidaEmbarque;
    }

    public function setFechaSalidaEmbarque(\DateTimeInterface $fechaSalidaEmbarque): self
    {
        $this->fechaSalidaEmbarque = $fechaSalidaEmbarque;

        return $this;
    }

    public function getFechaArribo(): ?\DateTimeInterface
    {
        return $this->fechaArribo;
    }

    public function setFechaArribo(\DateTimeInterface $fechaArribo): self
    {
        $this->fechaArribo = $fechaArribo;

        return $this;
    }

    public function getFechaEstimadaSalida(): ?\DateTimeInterface
    {
        return $this->fechaEstimadaSalida;
    }

    public function setFechaEstimadaSalida(\DateTimeInterface $fechaEstimadaSalida): self
    {
        $this->fechaEstimadaSalida = $fechaEstimadaSalida;

        return $this;
    }

    public function getDocumentosRecibidos(): ?string
    {
        return $this->documentosRecibidos;
    }

    public function setDocumentosRecibidos(string $documentosRecibidos): self
    {
        $this->documentosRecibidos = $documentosRecibidos;

        return $this;
    }

    public function getDetalleServicios(): ?string
    {
        return $this->detalleServicios;
    }

    public function setDetalleServicios(string $detalleServicios): self
    {
        $this->detalleServicios = $detalleServicios;

        return $this;
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

    public function getPresupuesto(): ?float
    {
        return $this->presupuesto;
    }

    public function setPresupuesto(float $presupuesto): self
    {
        $this->presupuesto = $presupuesto;

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

    public function getSolicitudServicio(): ?SolicitudServicio
    {
        return $this->solicitudServicio;
    }

    public function setSolicitudServicio(?SolicitudServicio $solicitudServicio): self
    {
        $this->solicitudServicio = $solicitudServicio;

        return $this;
    }

    public function getViaTransportacion(): ?ViaTransportacion
    {
        return $this->viaTransportacion;
    }

    public function setViaTransportacion(?ViaTransportacion $viaTransportacion): self
    {
        $this->viaTransportacion = $viaTransportacion;

        return $this;
    }

    public function getCondicionCompra(): ?CondicionCompra
    {
        return $this->condicionCompra;
    }

    public function setCondicionCompra(?CondicionCompra $condicionCompra): self
    {
        $this->condicionCompra = $condicionCompra;

        return $this;
    }

    public function getDireccionDestino(): ?string
    {
        return $this->direccionDestino;
    }

    public function setDireccionDestino(string $direccionDestino): self
    {
        $this->direccionDestino = $direccionDestino;

        return $this;
    }

    public function getPuertoOrigen(): ?Puerto
    {
        return $this->puertoOrigen;
    }

    public function setPuertoOrigen(?Puerto $puertoOrigen): self
    {
        $this->puertoOrigen = $puertoOrigen;

        return $this;
    }

    public function getPuertoDestino(): ?Puerto
    {
        return $this->puertoDestino;
    }

    public function setPuertoDestino(?Puerto $puertoDestino): self
    {
        $this->puertoDestino = $puertoDestino;

        return $this;
    }
    public function getCostoOrigen(): ?float
    {
        return $this->costoOrigen;
    }

    public function setCostoOrigen(?float $costoOrigen): self
    {
        $this->costoOrigen = $costoOrigen;

        return $this;
    }

    public function getFlete(): ?float
    {
        return $this->flete;
    }

    public function setFlete(?float $flete): self
    {
        $this->flete = $flete;

        return $this;
    }

    public function getDestino(): ?float
    {
        return $this->destino;
    }

    public function setDestino(?float $destino): self
    {
        $this->destino = $destino;

        return $this;
    }

    public function getRecargo(): ?float
    {
        return $this->recargo;
    }

    public function setRecargo(?float $recargo): self
    {
        $this->recargo = $recargo;

        return $this;
    }

    public function getRx(): ?float
    {
        return $this->rx;
    }

    public function setRx(?float $rx): self
    {
        $this->rx = $rx;

        return $this;
    }
        public function __toString() {
                                return (string)$this->numeroExportacion; 
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

        public function getContrato(): ?Contrato
        {
            return $this->contrato;
        }

        public function setContrato(?Contrato $contrato): self
        {
            $this->contrato = $contrato;

            return $this;
        }

        public function getBuque(): ?buque
        {
            return $this->buque;
        }

        public function setBuque(?buque $buque): self
        {
            $this->buque = $buque;

            return $this;
        }

        public function getNumeroExportacion(): ?string
        {
            return $this->numeroExportacion;
        }

        public function setNumeroExportacion(?string $numeroExportacion): self
        {
            $this->numeroExportacion = $numeroExportacion;

            return $this;
        }

        public function getExportacionActiva(): ?bool
        {
            return $this->exportacionActiva;
        }

        public function setExportacionActiva(?bool $exportacionActiva): self
        {
            $this->exportacionActiva = $exportacionActiva;

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

        public function getTipoMoneda(): ?TipoMoneda
        {
            return $this->tipoMoneda;
        }

        public function setTipoMoneda(?TipoMoneda $tipoMoneda): self
        {
            $this->tipoMoneda = $tipoMoneda;

            return $this;
        }
}
