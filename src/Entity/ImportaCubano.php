<?php

namespace App\Entity;

use App\Repository\ImportaCubanoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImportaCubanoRepository::class)
 */
class ImportaCubano
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="date", nullable = true)
     */
    private $fechaEntregaAduana;
    
    /**
     * @ORM\Column(type="boolean", nullable = true)
     */
    private $expedienteOK;

    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="date", nullable = true)
     */
    private $fechaArribo;

    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="date", nullable = true)
     */
    private $fechaAutorizoEmbarque;
    
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
     * @ORM\ManyToOne(targetEntity="Provincia", inversedBy="importacionCubana")
     */
    private $provincia;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Pais", inversedBy="importacionCubana")
     */
    private $paisProcedencia;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Transitario", inversedBy="importacionCubana")
     */
    private $transitario;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Naviera", inversedBy="importacionCubana")
     */
    private $naviera;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="DesgloseManifiesto", inversedBy="importacionCubana")
     */
    private $desgloseManifiesto;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Contenedor", inversedBy="importacionCubana")
     */
    private $contenedor;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="SolicitudServicio", inversedBy="importacionCubano")
     */
    private $solicitudServicio;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="EstadoServicio", inversedBy="importacionCubano")
     */
    private $estadoServicio;
    
    /**
     * @ORM\OneToMany(targetEntity="ImportaCubano", mappedBy="importacionCubano")
     */
    private $expediente;

    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="integer")
     */
    private $numeroManifiesto;
    
    /**
     * @ORM\Column(type="string", length= 100, nullable = true)
     */
    private $numeroImportacionCubano;
    
      
    /**
     * @ORM\Column(type="boolean", nullable = true)
     */
    private $importacionCubanaActiva = true;
    
    /**
     * @ORM\Column(type="date", nullable = true)
     */
    private $fechaDesactivacion;
    
    

    public function __construct()
    {
        $this->expediente = new ArrayCollection();
    }
    

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPaisProcedencia(): ?Pais
    {
        return $this->paisProcedencia;
    }

    public function setPaisProcedencia(?Pais $paisProcedencia): self
    {
        $this->paisProcedencia = $paisProcedencia;

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

    public function getDesgloseManifiesto(): ?DesgloseManifiesto
    {
        return $this->desgloseManifiesto;
    }

    public function setDesgloseManifiesto(?DesgloseManifiesto $desgloseManifiesto): self
    {
        $this->desgloseManifiesto = $desgloseManifiesto;

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
                                return $this->numeroImportacionCubano; 
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

      /**
       * @return Collection|ImportaCubano[]
       */
      public function getExpediente(): Collection
      {
          return $this->expediente;
      }

      public function addExpediente(ImportaCubano $expediente): self
      {
          if (!$this->expediente->contains($expediente)) {
              $this->expediente[] = $expediente;
              $expediente->setImportacionCubano($this);
          }

          return $this;
      }

      public function removeExpediente(ImportaCubano $expediente): self
      {
          if ($this->expediente->contains($expediente)) {
              $this->expediente->removeElement($expediente);
              // set the owning side to null (unless already changed)
              if ($expediente->getImportacionCubano() === $this) {
                  $expediente->setImportacionCubano(null);
              }
          }

          return $this;
      }

      public function getNumeroImportacionCubano(): ?string
      {
          return $this->numeroImportacionCubano;
      }

      public function setNumeroImportacionCubano(?string $numeroImportacionCubano): self
      {
          $this->numeroImportacionCubano = $numeroImportacionCubano;

          return $this;
      }

      public function getExpedienteOK(): ?bool
      {
          return $this->expedienteOK;
      }

      public function setExpedienteOK(bool $expedienteOK): self
      {
          $this->expedienteOK = $expedienteOK;

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

      public function getFechaEntregaAduana(): ?\DateTimeInterface
      {
          return $this->fechaEntregaAduana;
      }

      public function setFechaEntregaAduana(?\DateTimeInterface $fechaEntregaAduana): self
      {
          $this->fechaEntregaAduana = $fechaEntregaAduana;

          return $this;
      }

      public function getFechaAutorizoEmbarque(): ?\DateTimeInterface
      {
          return $this->fechaAutorizoEmbarque;
      }

      public function setFechaAutorizoEmbarque(?\DateTimeInterface $fechaAutorizoEmbarque): self
      {
          $this->fechaAutorizoEmbarque = $fechaAutorizoEmbarque;

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

      public function getEstadoServicio(): ?EstadoServicio
      {
          return $this->estadoServicio;
      }

      public function setEstadoServicio(?EstadoServicio $estadoServicio): self
      {
          $this->estadoServicio = $estadoServicio;

          return $this;
      }

      public function getImportacionCubanaActiva(): ?bool
      {
          return $this->importacionCubanaActiva;
      }

      public function setImportacionCubanaActiva(?bool $importacionCubanaActiva): self
      {
          $this->importacionCubanaActiva = $importacionCubanaActiva;

          return $this;
      }

      public function getFechaDesactivacion(): ?\DateTimeInterface
      {
          return $this->fechaDesactivacion;
      }

      public function setFechaDesactivacion(?\DateTimeInterface $fechaDesactivacion): self
      {
          $this->fechaDesactivacion = $fechaDesactivacion;

          return $this;
      }

      public function getFechaArribo(): ?\DateTimeInterface
      {
          return $this->fechaArribo;
      }

      public function setFechaArribo(?\DateTimeInterface $fechaArribo): self
      {
          $this->fechaArribo = $fechaArribo;

          return $this;
      }

}
