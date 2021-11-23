<?php

namespace App\Form;

use App\Entity\Importacion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ImportacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add('descripcionCarga',TextareaType::class, array('attr' => ['style'  => 'width: 100% !important;', 'rows' => 8]))
            ->add('direccionDestino',TextareaType::class, array('attr' => ['style'  => 'width: 100% !important;', 'rows' => 8]))
            ->add('contenedor', EntityType::class,array('class' => 'App:Contenedor', 'placeholder' => '-- Seleccionar --'))
            ->add('contrato', EntityType::class,array('class' => 'App:Contrato', 'placeholder' => '-- Seleccionar --'))
            ->add('viaTransportacion', EntityType::class,array('class' => 'App:ViaTransportacion', 'placeholder' => '-- Seleccionar --'))
           ->add('condicionCompra', EntityType::class,array('class' => 'App:CondicionCompra', 'placeholder' => '-- Seleccionar --'))
           ->add('solicitudServicio', EntityType::class,array('class' => 'App:SolicitudServicio', 'placeholder' => '-- Seleccionar --'))          
           ->add('estadoServicio', EntityType::class,array('class' => 'App:EstadoServicio', 'placeholder' => '-- Seleccionar --'))
            ->add('puertoDestino', EntityType::class,array('class' => 'App:Puerto', 'placeholder' => '-- Seleccionar --'))
           ->add('puertoOrigen', EntityType::class,array('class' => 'App:Puerto', 'placeholder' => '-- Seleccionar --'))
            ->add('desgloseManifiesto')  
            ->add('documentosRecibidos',TextareaType::class, array('attr' => ['style'  => 'width: 100% !important;', 'rows' => 8]))
            ->add('detalleServicios',TextareaType::class, array('attr' => ['style'  => 'width: 100% !important;', 'rows' => 8]))
            ->add('observaciones',TextareaType::class, array('attr' => ['style'  => 'width: 100% !important;', 'rows' => 8]))
           ->add('costoOrigen')
            ->add('flete')
           ->add('destino')     
           ->add('recargo')
           ->add('rx')     
           ->add('fechaEstimadoServicio','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))   
          ->add('fechaSalidaEmbarque','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))   
           ->add('fechaArribo','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))   
          ->add('fechaEstimadaSalida','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))   
          ->add('tipoMoneda', EntityType::class,array('class' => 'App:TipoMoneda', 'placeholder' => '-- Seleccionar --'))   
                  
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Importacion::class,
        ]);
    }
}
