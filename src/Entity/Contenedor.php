<?php

namespace App\Entity;

use App\Repository\ContenedorRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContenedorRepository::class)
 */
class Contenedor
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
    private $numeroContenedor;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $cantMenajes;

    /**
     * @ORM\Column(type="integer")
     */
    private $colaboradores;

    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="string", length=100)
     */
    private $cantBultos;

    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="string", length=100)
     */
    private $kgCarga;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $cantidadEnvio;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $cantEna;

    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="string", length=100)
     */
    private $mbl;

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
     * @ORM\ManyToOne(targetEntity="Buque", inversedBy="contenedor")
     */
    private $buque;
    
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroContenedor(): ?string
    {
        return $this->numeroContenedor;
    }

    public function setNumeroContenedor(string $numeroContenedor): self
    {
        $this->numeroContenedor = $numeroContenedor;

        return $this;
    }
    public function getColaboradores(): ?int
    {
        return $this->colaboradores;
    }

    public function setColaboradores(int $colaboradores): self
    {
        $this->colaboradores = $colaboradores;

        return $this;
    }

    public function getCantBultos(): ?string
    {
        return $this->cantBultos;
    }

    public function setCantBultos(string $cantBultos): self
    {
        $this->cantBultos = $cantBultos;

        return $this;
    }

    public function getKgCarga(): ?string
    {
        return $this->kgCarga;
    }

    public function setKgCarga(string $kgCarga): self
    {
        $this->kgCarga = $kgCarga;

        return $this;
    }

    public function getCantidadEnvio(): ?string
    {
        return $this->cantidadEnvio;
    }

    public function setCantidadEnvio(string $cantidadEnvio): self
    {
        $this->cantidadEnvio = $cantidadEnvio;

        return $this;
    }

    public function getCantEna(): ?string
    {
        return $this->cantEna;
    }

    public function setCantEna(string $cantEna): self
    {
        $this->cantEna = $cantEna;

        return $this;
    }

    public function getMbl(): ?string
    {
        return $this->mbl;
    }

    public function setMbl(string $mbl): self
    {
        $this->mbl = $mbl;

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

    public function getCantMenajes(): ?string
    {
        return $this->cantMenajes;
    }

    public function setCantMenajes(string $cantMenajes): self
    {
        $this->cantMenajes = $cantMenajes;

        return $this;
    }

     public function __toString() {
                                return $this->numeroContenedor; 
                            }

     public function getBuque(): ?Buque
     {
         return $this->buque;
     }

     public function setBuque(?Buque $buque): self
     {
         $this->buque = $buque;

         return $this;
     }  
    
    
    
    
  }
