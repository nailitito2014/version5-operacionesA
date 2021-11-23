<?php

namespace App\Entity;

use App\Repository\ImportacionRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImportacionRepository::class)
 */
class Importacion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length= 100, nullable = true)
     */
    private $numeroImportacion;

    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="text")
     */
    private $descripcionCarga;

    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="text")
     */
    private $direccionDestino;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaEstimadoServicio;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaSalidaEmbarque;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaArribo;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaEstimadaSalida;

    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="text")
     */
    private $documentosRecibidos;

    /**
     * @ORM\Column(type="text")
     */
    private $detalleServicios;

    /**
     * @ORM\Column(type="text")
     */
    private $observaciones;

    /**
     * @ORM\Column(type="float" , nullable = true)
     */
    private $presupuesto;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="CondicionCompra", inversedBy="importacionExtranjera")
     */
    private $condicionCompra;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Contenedor", inversedBy="importacionExtranjera")
     */
    private $contenedor;  
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Contrato", inversedBy="importacionExtranjera")
     */
    private $contrato;  
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Puerto", inversedBy="importacionExtranjera")
     */
    private $puertoDestino;
 
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Puerto", inversedBy="importacionExtranjera")
     */
    private $puertoOrigen;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="EstadoServicio", inversedBy="importacion")
     */
    private $estadoServicio;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="SolicitudServicio", inversedBy="importacion")
     */
    private $solicitudServicio;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="ViaTransportacion", inversedBy="importacion")
     */
    private $viaTransportacion;
   
    /**
     * @ORM\Column(type="float", nullable = true)
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
     * @ORM\Column(type="boolean", nullable = true)
     */
    private $desgloseManifiesto;
    
    /**
     * @ORM\Column(type="boolean", nullable = true)
     */
    private $importacionActiva = true;
    
    /**
     * @ORM\Column(type="date", nullable = true)
     */
    private $fechaDesactivacion;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="TipoMoneda", inversedBy="importacion")
     */
    private $tipoMoneda;
    
    
    /**
     * @ORM\Column(type="date")
     */
    private $fechaInsercion;
    

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDireccionDestino(): ?string
    {
        return $this->direccionDestino;
    }

    public function setDireccionDestino(string $direccionDestino): self
    {
        $this->direccionDestino = $direccionDestino;

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

    public function getCondicionCompra(): ?CondicionCompra
    {
        return $this->condicionCompra;
    }

    public function setCondicionCompra(?CondicionCompra $condicionCompra): self
    {
        $this->condicionCompra = $condicionCompra;

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

    public function getCostoOrigen(): ?float
    {
        return $this->costoOrigen;
    }

    public function setCostoOrigen(float $costoOrigen): self
    {
        $this->costoOrigen = $costoOrigen;

        return $this;
    }

    public function getFlete(): ?float
    {
        return $this->flete;
    }

    public function setFlete(float $flete): self
    {
        $this->flete = $flete;

        return $this;
    }

    public function getDestino(): ?float
    {
        return $this->destino;
    }

    public function setDestino(float $destino): self
    {
        $this->destino = $destino;

        return $this;
    }

    public function getRecargo(): ?float
    {
        return $this->recargo;
    }

    public function setRecargo(float $recargo): self
    {
        $this->recargo = $recargo;

        return $this;
    }

    public function getRx(): ?float
    {
        return $this->rx;
    }

    public function setRx(float $rx): self
    {
        $this->rx = $rx;

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

    public function getSolicitudServicio(): ?solicitudServicio
    {
        return $this->solicitudServicio;
    }

    public function setSolicitudServicio(?solicitudServicio $solicitudServicio): self
    {
        $this->solicitudServicio = $solicitudServicio;

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

    public function getPuertoOrigen(): ?Puerto
    {
        return $this->puertoOrigen;
    }

    public function setPuertoOrigen(?Puerto $puertoOrigen): self
    {
        $this->puertoOrigen = $puertoOrigen;

        return $this;
    }

    public function getEstadoServicio(): ?EstadoServicio
    {
        return $this->estadoServicio;
    }

    public function setEstadoServicio(?EstadoServicio $estadoServicio): self
    {
        $this->estadoServicio = $estadoServicio;

        return $this;
    }

       public function __toString() {
                                return (string)$this->numeroImportacion; 
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
       public function getDesgloseManifiesto(): ?bool
       {
           return $this->desgloseManifiesto;
       }

       public function setDesgloseManifiesto(bool $desgloseManifiesto): self
       {
           $this->desgloseManifiesto = $desgloseManifiesto;

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

       public function getNumeroImportacion(): ?string
       {
           return $this->numeroImportacion;
       }

       public function setNumeroImportacion(?string $numeroImportacion): self
       {
           $this->numeroImportacion = $numeroImportacion;

           return $this;
       }

       public function getImage(): ?string
       {
           return $this->image;
       }

       public function setImage(string $image): self
       {
           $this->image = $image;

           return $this;
       }

       public function getCertificoInmigracion(): ?string
       {
           return $this->certificoInmigracion;
       }

       public function setCertificoInmigracion(string $certificoInmigracion): self
       {
           $this->certificoInmigracion = $certificoInmigracion;

           return $this;
       }

       public function getFranquiciaDiplomatica(): ?string
       {
           return $this->franquiciaDiplomatica;
       }

       public function setFranquiciaDiplomatica(string $franquiciaDiplomatica): self
       {
           $this->franquiciaDiplomatica = $franquiciaDiplomatica;

           return $this;
       }

       public function getCartaOriginal(): ?string
       {
           return $this->cartaOriginal;
       }

       public function setCartaOriginal(string $cartaOriginal): self
       {
           $this->cartaOriginal = $cartaOriginal;

           return $this;
       }

       public function getDesglose(): ?string
       {
           return $this->desglose;
       }

       public function setDesglose(string $desglose): self
       {
           $this->desglose = $desglose;

           return $this;
       }

       public function getManifiesto(): ?string
       {
           return $this->manifiesto;
       }

       public function setManifiesto(string $manifiesto): self
       {
           $this->manifiesto = $manifiesto;

           return $this;
       }

       public function getImportacionActiva(): ?bool
       {
           return $this->importacionActiva;
       }

       public function setImportacionActiva(?bool $importacionActiva): self
       {
           $this->importacionActiva = $importacionActiva;

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
