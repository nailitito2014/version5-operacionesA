<?php

namespace App\Entity;

use App\Repository\ContratoRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContratoRepository::class)
 */
class Contrato
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @Assert\Regex(pattern="/^[0-9]$/", message = "Insertar solo numeros en el campo Numero de contrato.")
     * @ORM\Column(type="string", length=255 )
     */
    private $numeroContrato;

    /**
     * @ORM\Column(type="date", nullable = true)
     */
    private $fechaVencimiento;

    /**
      * @Assert\Regex(pattern="/^[a-zA-ZñÁÉÍÓÚáéíó ú]+$/", message = "Insertar solo letras en el campo titular.")
      * @Assert\NotBlank(message = "El campo no puede estar en blanco")
     * @ORM\Column(type="string", length=255)
     */
    private $titular;
    
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
     * @ORM\ManyToOne(targetEntity="TipoContrato", inversedBy="contrato")
     */
    private $tipoContrato;
    
    
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
       public function __toString() {
                                return $this->numeroContrato; 
                            }

       public function getNumeroContrato(): ?string
       {
           return $this->numeroContrato;
       }

       public function setNumeroContrato(string $numeroContrato): self
       {
           $this->numeroContrato = $numeroContrato;

           return $this;
       }

       public function getFechaVencimiento(): ?\DateTimeInterface
       {
           return $this->fechaVencimiento;
       }

       public function setFechaVencimiento(?\DateTimeInterface $fechaVencimiento): self
       {
           $this->fechaVencimiento = $fechaVencimiento;

           return $this;
       }

       public function getTitular(): ?string
       {
           return $this->titular;
       }

       public function setTitular(string $titular): self
       {
           $this->titular = $titular;

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

       public function getTipoContrato(): ?TipoContrato
       {
           return $this->tipoContrato;
       }

       public function setTipoContrato(?TipoContrato $tipoContrato): self
       {
           $this->tipoContrato = $tipoContrato;

           return $this;
       }

  
    
}
