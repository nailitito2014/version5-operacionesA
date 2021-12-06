<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImportacionCubano
 *
 * @ORM\Table(name="importacion_cubano", indexes={@ORM\Index(name="IDX_241A930336DDC72C", columns={"desglose_manifiesto_id"}), @ORM\Index(name="IDX_241A9303429FFEC2", columns={"pais_procedencia_id"}), @ORM\Index(name="IDX_241A93034BC64AB7", columns={"estado_servicio_id"}), @ORM\Index(name="IDX_241A93034E7121AF", columns={"provincia_id"}), @ORM\Index(name="IDX_241A930369806DFD", columns={"solicitud_servicio_id"}), @ORM\Index(name="IDX_241A9303896D82D1", columns={"transitario_id"}), @ORM\Index(name="IDX_241A9303C1A15772", columns={"contenedor_id"}), @ORM\Index(name="IDX_241A9303D21CF971", columns={"naviera_id"})})
 * @ORM\Entity
 */
class ImportacionCubano
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
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_entrega_aduana", type="date", nullable=true)
     */
    private $fechaEntregaAduana;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="expediente_ok", type="boolean", nullable=true)
     */
    private $expedienteOk;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_arribo", type="date", nullable=true)
     */
    private $fechaArribo;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_autorizo_embarque", type="date", nullable=true)
     */
    private $fechaAutorizoEmbarque;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_insercion", type="date", nullable=false)
     */
    private $fechaInsercion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="numero_importacion_cubano", type="string", length=100, nullable=true)
     */
    private $numeroImportacionCubano;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="importacion_cubana_activa", type="boolean", nullable=true)
     */
    private $importacionCubanaActiva;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_desactivacion", type="date", nullable=true)
     */
    private $fechaDesactivacion;

    /**
     * @var \DesgloseManifiesto
     *
     * @ORM\ManyToOne(targetEntity="DesgloseManifiesto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="desglose_manifiesto_id", referencedColumnName="id")
     * })
     */
    private $desgloseManifiesto;

    /**
     * @var \Pais
     *
     * @ORM\ManyToOne(targetEntity="Pais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pais_procedencia_id", referencedColumnName="id")
     * })
     */
    private $paisProcedencia;

    /**
     * @var \EstadoServicio
     *
     * @ORM\ManyToOne(targetEntity="EstadoServicio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estado_servicio_id", referencedColumnName="id")
     * })
     */
    private $estadoServicio;

    /**
     * @var \Provincia
     *
     * @ORM\ManyToOne(targetEntity="Provincia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="provincia_id", referencedColumnName="id")
     * })
     */
    private $provincia;

    /**
     * @var \SolicitudServicio
     *
     * @ORM\ManyToOne(targetEntity="SolicitudServicio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="solicitud_servicio_id", referencedColumnName="id")
     * })
     */
    private $solicitudServicio;

    /**
     * @var \Transitario
     *
     * @ORM\ManyToOne(targetEntity="Transitario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="transitario_id", referencedColumnName="id")
     * })
     */
    private $transitario;

    /**
     * @var \Contenedor
     *
     * @ORM\ManyToOne(targetEntity="Contenedor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contenedor_id", referencedColumnName="id")
     * })
     */
    private $contenedor;

    /**
     * @var \Naviera
     *
     * @ORM\ManyToOne(targetEntity="Naviera")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="naviera_id", referencedColumnName="id")
     * })
     */
    private $naviera;


}
