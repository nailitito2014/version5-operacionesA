<?php

namespace App\Entity;

use App\Repository\ExpedienteRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExpedienteRepository::class)
 */
class Expediente
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
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $primerApellido;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $segundoApellido;

    /**
     * @ORM\Column(type="integer")
     */
    private $bultos;
    
    /**
     * @ORM\Column(type="string", length= 100, nullable = true)
     */
    private $numeroExpediente;
    
    /**
     * @ORM\Column(type="string", length= 100, nullable = true)
     */
    private $numeroManifiesto;

    /**
     * @ORM\Column(type="float")
     */
    private $pesoKg;

    /**
     * @ORM\Column(type="float")
     */
    private $pies;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaInsercion;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaCreacionExpediente;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $numeroMBL;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaDespacho;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $recibidoAduana;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $entregadoAgencia;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaEntrega;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaArribo;
    
    /**
     * @ORM\Column(type="string", length=50, nullable = true)
     */
    private $telefonoFijo;
    
    /**
     * @ORM\Column(type="string", length=50, nullable = true)
     */
    private $telefonoMovil;
    
    /**
     * @ORM\Column(type="text", nullable = true)
     */
    private $notas;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Naviera", inversedBy="expediente")
     */
    private $naviera;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Contenedor", inversedBy="expediente")
     */
    private $contenedor; 
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Pais", inversedBy="expediente")
     */
    private $pais; 
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Provincia", inversedBy="expediente")
     */
    private $provincia;
    
    /**
     * @ORM\ManyToOne(targetEntity="DesgloseManifiesto", inversedBy="expediente")
     */
    private $desgloseManifiesto;
    
    /**
     * @ORM\ManyToOne(targetEntity="ImportaCubano", inversedBy="expediente")
     */
    private $importacionCubano;
    
    private $certificoInmigracionFile;
    
    private $desgloseFile;
    
    private $manifiestoFile;
    
    private $franquiciaDiplomaticaFile;
   
    private $cartaOriginalFile;
      
    /**
     * @var string
     *
     * @ORM\Column(name="certificoInmigracion", type="string", length=100, nullable = true)
     */
    private $certificoInmigracion;
    
    /**
     * @var string
     *
     * @ORM\Column(name="franquiciaDiplomatica", type="string", length=10, nullable = true)
     */
    private $franquiciaDiplomatica;
    
    /**
     * @var string
     *
     * @ORM\Column(name="cartaOriginal", type="string", length=100, nullable = true)
     */
    private $cartaOriginal; 
    
    /**
     * @var string
     *
     * @ORM\Column(name="desglose", type="string", length=100, nullable = true)
     */
    private $desglose;
    
    /**
     * @var string
     *
     * @ORM\Column(name="manifiesto", type="string", length=100, nullable = true)
     */
    private $manifiesto;
    
    /**
     * @ORM\Column(type="date", nullable = true)
     */
    private $fechaEntregadoDeposito;
    
    
    

    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setCertificoInmigracionFile(UploadedFile $certificoInmigracionFile = null)
    {
        $this->certificoInmigracionFile = $certificoInmigracionFile;
    }   
    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getCertificoInmigracionFile()
    {
        return $this->certificoInmigracionFile;
    }
     /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setdesgloseFile(UploadedFile $desgloseFile = null)
    {
        $this->desgloseFile = $desgloseFile;
    }   
    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getdesgloseFile()
    {
        return $this->desgloseFile;
    }
    
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setmanifiestoFile(UploadedFile $manifiestoFile = null)
    {
        $this->manifiestoFile = $manifiestoFile;
    }   
    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getmanifiestoFile()
    {
        return $this->manifiestoFile;
    }
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setfranquiciaDiplomaticaFile(UploadedFile $franquiciaDiplomaticaFile = null)
    {
        $this->franquiciaDiplomaticaFile = $franquiciaDiplomaticaFile;
    }   
    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getfranquiciaDiplomaticaFile()
    {
        return $this->franquiciaDiplomaticaFile;
    } 
    
       /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setcartaOriginalFile(UploadedFile $cartaOriginalFile = null)
    {
        $this->cartaOriginalFile = $cartaOriginalFile;
    }   
    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getcartaOriginalFile()
    {
        return $this->cartaOriginalFile;
    } 
     
    
    
    
    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getPrimerApellido(): ?string
    {
        return $this->primerApellido;
    }

    public function setPrimerApellido(string $primerApellido): self
    {
        $this->primerApellido = $primerApellido;

        return $this;
    }

    public function getSegundoApellido(): ?string
    {
        return $this->segundoApellido;
    }

    public function setSegundoApellido(string $segundoApellido): self
    {
        $this->segundoApellido = $segundoApellido;

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

    public function getPesoKg(): ?float
    {
        return $this->pesoKg;
    }

    public function setPesoKg(float $pesoKg): self
    {
        $this->pesoKg = $pesoKg;

        return $this;
    }

    public function getPies(): ?float
    {
        return $this->pies;
    }

    public function setPies(float $pies): self
    {
        $this->pies = $pies;

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

    public function getFechaCreacionExpediente(): ?\DateTimeInterface
    {
        return $this->fechaCreacionExpediente;
    }

    public function setFechaCreacionExpediente(\DateTimeInterface $fechaCreacionExpediente): self
    {
        $this->fechaCreacionExpediente = $fechaCreacionExpediente;

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

    public function getFechaDespacho(): ?\DateTimeInterface
    {
        return $this->fechaDespacho;
    }

    public function setFechaDespacho(\DateTimeInterface $fechaDespacho): self
    {
        $this->fechaDespacho = $fechaDespacho;

        return $this;
    }

    public function getRecibidoAduana(): ?string
    {
        return $this->recibidoAduana;
    }

    public function setRecibidoAduana(string $recibidoAduana): self
    {
        $this->recibidoAduana = $recibidoAduana;

        return $this;
    }

    public function getEntregadoAgencia(): ?string
    {
        return $this->entregadoAgencia;
    }

    public function setEntregadoAgencia(string $entregadoAgencia): self
    {
        $this->entregadoAgencia = $entregadoAgencia;

        return $this;
    }

    public function getFechaEntrega(): ?\DateTimeInterface
    {
        return $this->fechaEntrega;
    }

    public function setFechaEntrega(\DateTimeInterface $fechaEntrega): self
    {
        $this->fechaEntrega = $fechaEntrega;

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

    public function getTelefonoFijo(): ?string
    {
        return $this->telefonoFijo;
    }

    public function setTelefonoFijo(string $telefonoFijo): self
    {
        $this->telefonoFijo = $telefonoFijo;

        return $this;
    }

    public function getTelefonoMovil(): ?string
    {
        return $this->telefonoMovil;
    }

    public function setTelefonoMovil(string $telefonoMovil): self
    {
        $this->telefonoMovil = $telefonoMovil;

        return $this;
    }

    public function getNotas(): ?string
    {
        return $this->notas;
    }

    public function setNotas(string $notas): self
    {
        $this->notas = $notas;

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

    public function getPais(): ?Pais
    {
        return $this->pais;
    }

    public function setPais(?Pais $pais): self
    {
        $this->pais = $pais;

        return $this;
    }

    public function getProvincia(): ?Provincia
    {
        return $this->provincia;
    }

    public function setProvincia(?Provincia $provincia): self
    {
        $this->provincia = $provincia;

        return $this;
    }

    public function getDesgloseManifiesto(): ?DesgloseManifiesto
    {
        return $this->desgloseManifiesto;
    }

    public function setDesgloseManifiesto(?DesgloseManifiesto $desgloseManifiesto): self
    {
        $this->desgloseManifiesto = $desgloseManifiesto;

        return $this;
    }
      public function __toString() {
                                return (string)$this->numeroExpediente; 
                            }

      public function getImportacionCubano(): ?ImportaCubano
      {
          return $this->importacionCubano;
      }

      public function setImportacionCubano(?ImportaCubano $importacionCubano): self
      {
          $this->importacionCubano = $importacionCubano;

          return $this;
      }

      public function getNumeroExpediente(): ?string
      {
          return $this->numeroExpediente;
      }

      public function setNumeroExpediente(?string $numeroExpediente): self
      {
          $this->numeroExpediente = $numeroExpediente;

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

      public function getNumeroManifiesto(): ?string
      {
          return $this->numeroManifiesto;
      }

      public function setNumeroManifiesto(?string $numeroManifiesto): self
      {
          $this->numeroManifiesto = $numeroManifiesto;

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

      public function getFechaEntregadoDeposito(): ?\DateTimeInterface
      {
          return $this->fechaEntregadoDeposito;
      }

      public function setFechaEntregadoDeposito(?\DateTimeInterface $fechaEntregadoDeposito): self
      {
          $this->fechaEntregadoDeposito = $fechaEntregadoDeposito;

          return $this;
      }
}
