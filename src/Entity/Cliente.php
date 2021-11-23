<?php

namespace App\Entity;

use App\Repository\ClienteRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClienteRepository::class)
 */
class Cliente
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
      * @Assert\Regex(pattern="/^[a-zA-ZñÁÉÍÓÚáéíó ú]+$/", message = "Insertar solo letras en el campo nombre.")
      * @Assert\NotBlank(message = "El campo no puede estar en blanco") 
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;
    
    /**
      * @Assert\Regex(pattern="/^[a-zA-ZñÁÉÍÓÚáéíó ú]+$/", message = "Insertar solo letras en el campo primer apellido.")
      * @Assert\NotBlank(message = "El campo no puede estar en blanco") 
     * @ORM\Column(type="string", length=255)
     */
    private $primerApellido;
    
    /**
      * @Assert\Regex(pattern="/^[a-zA-ZñÁÉÍÓÚáéíó ú]+$/", message = "Insertar solo letras en el campo segundo apellido.")
      * @Assert\NotBlank(message = "El campo no puede estar en blanco")    
     * @ORM\Column(type="string", length=255)
     */
    private $segundoApellido;
    
    /**
     * @ORM\Column(type="date")
     */
    private $fechaCertificoInmigracion;
    
    /**
     * @ORM\Column(type="date", nullable = true)
     */
    private $fechaVencimientoCertificoInmigracion;
    
    /**
     * @Assert\Regex(pattern="/^[0-9]{11}$/", message = "Debe contener exactamente 11 dígitos.")
     * @Assert\Regex(pattern="/^(?!([0-9]*[a-z]+)).+$/", message = "No puede contener letras.")
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="bigint", length=11)
     */
    private $carnetIdentidad;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @Assert\Regex(pattern="/^[0-9]{11}$/", message = "Debe contener exactamente 11 dígitos.")
     * @ORM\Column(type="string", length=100)
     */
    private $pasaporte;
    
    
     /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Pais", inversedBy="cliente")
     */
    private $pais;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="CategoriaCliente", inversedBy="cliente")
     */
    private $categoriaCliente;
    
    
    /**
     * @ORM\Column(type="datetime", nullable =true)
     */
    private $fecha;
    
    /**
     * @ORM\Column(type="date", nullable = true)
     */
    private $fechaInsercion; 
    
    /**
     * @ORM\Column(type="boolean", nullable = true)
     */
    private $clienteActivo = true;
    
    /**
     * @ORM\Column(type="date", nullable = true)
     */
    private $fechaDesactivacion;
    
    

    public function getId(): ?int
    {
        return $this->id;
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
    
 public function __toString() {                   return $this->nombre.' '. $this->primerApellido.' '.$this->segundoApellido; 
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

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(?\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getFechaInsercion(): ?\DateTimeInterface
    {
        return $this->fechaInsercion;
    }

    public function setFechaInsercion(?\DateTimeInterface $fechaInsercion): self
    {
        $this->fechaInsercion = $fechaInsercion;

        return $this;
    }

    public function getFechaCertificoInmigracion(): ?\DateTimeInterface
    {
        return $this->fechaCertificoInmigracion;
    }

    public function setFechaCertificoInmigracion(\DateTimeInterface $fechaCertificoInmigracion): self
    {
        $this->fechaCertificoInmigracion = $fechaCertificoInmigracion;

        return $this;
    }

    public function getCarnetIdentidad(): ?string
    {
        return $this->carnetIdentidad;
    }

    public function setCarnetIdentidad(string $carnetIdentidad): self
    {
        $this->carnetIdentidad = $carnetIdentidad;

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

    public function getPasaporte(): ?string
    {
        return $this->pasaporte;
    }

    public function setPasaporte(string $pasaporte): self
    {
        $this->pasaporte = $pasaporte;

        return $this;
    }

    public function getCategoriaCliente(): ?CategoriaCliente
    {
        return $this->categoriaCliente;
    }

    public function setCategoriaCliente(?CategoriaCliente $categoriaCliente): self
    {
        $this->categoriaCliente = $categoriaCliente;

        return $this;
    }

    public function getFechaVencimientoCertificoInmigracion(): ?\DateTimeInterface
    {
        return $this->fechaVencimientoCertificoInmigracion;
    }

    public function setFechaVencimientoCertificoInmigracion(\DateTimeInterface $fechaVencimientoCertificoInmigracion): self
    {
        $this->fechaVencimientoCertificoInmigracion = $fechaVencimientoCertificoInmigracion;

        return $this;
    }

    public function getClienteActivo(): ?bool
    {
        return $this->clienteActivo;
    }

    public function setClienteActivo(?bool $clienteActivo): self
    {
        $this->clienteActivo = $clienteActivo;

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
