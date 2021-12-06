<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario", indexes={@ORM\Index(name="IDX_2265B05D4BAB96C", columns={"rol_id"})})
 * @ORM\Entity
 */
class Usuario
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreUsuario", type="string", length=255, nullable=false)
     */
    private $nombreusuario;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="primerApellido", type="string", length=255, nullable=false)
     */
    private $primerapellido;

    /**
     * @var string
     *
     * @ORM\Column(name="segundoApellido", type="string", length=255, nullable=false)
     */
    private $segundoapellido;

    /**
     * @var string
     *
     * @ORM\Column(name="contrasenna", type="string", length=255, nullable=false)
     */
    private $contrasenna;

    /**
     * @var \Rol
     *
     * @ORM\ManyToOne(targetEntity="Rol")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rol_id", referencedColumnName="id")
     * })
     */
    private $rol;


}
