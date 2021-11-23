<?php

namespace App\Entity;

use App\Repository\BuqueRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BuqueRepository::class)
 */
class Buque
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
     * @ORM\Column(type="string", length=50)
     */
    private $numeroViaje;
    
    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\ManyToOne(targetEntity="Puerto", inversedBy="buque")
     */
    private $puertoSalida; 
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaInsercion;
    
    /**
     * @ORM\Column(type="boolean", nullable = true)
     */
    private $buqueActivo = true;
    
    /**
     * @ORM\Column(type="date",nullable = true)
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

    public function getNumeroViaje(): ?string
    {
        return $this->numeroViaje;
    }

    public function setNumeroViaje(string $numeroViaje): self
    {
        $this->numeroViaje = $numeroViaje;

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
                                return $this->nombre; 
                            }

        public function getPuertoSalida(): ?Puerto
        {
            return $this->puertoSalida;
        }

        public function setPuertoSalida(?Puerto $puertoSalida): self
        {
            $this->puertoSalida = $puertoSalida;

            return $this;
        }

        public function getBuqueActivo(): ?bool
        {
            return $this->buqueActivo;
        }

        public function setBuqueActivo(?bool $buqueActivo): self
        {
            $this->buqueActivo = $buqueActivo;

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
}
