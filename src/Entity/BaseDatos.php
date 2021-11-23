<?php

namespace App\Entity;

use App\Repository\BaseDatosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BaseDatosRepository::class)
 */
class BaseDatos
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
    private $nombreUsuario;
    
    private $contrasenna;
    
    private $fecha;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $servidorIP;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreUsuario(): ?string
    {
        return $this->nombreUsuario;
    }

    public function setNombreUsuario(string $nombreUsuario): self
    {
        $this->nombreUsuario = $nombreUsuario;

        return $this;
    }

    public function getServidorIP(): ?string
    {
        return $this->servidorIP;
    }

    public function setServidorIP(string $servidorIP): self
    {
        $this->servidorIP = $servidorIP;

        return $this;
    }
    
    /**
     * Set contrasenna
     *
     * @param string $contrasenna
     * @return BaseDatos
     */
    public function setContrasenna($contrasenna)
    {
        $this->contrasenna = $contrasenna;

        return $this;
    }

    /**
     * Get contrasenna
     *
     * @return string 
     */
    public function getContrasenna()
    {
        return $this->contrasenna;
    }
    
      
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    
    
    
    public function getFecha()
    {
        return $this->fecha;
    }
}
