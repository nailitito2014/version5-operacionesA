<?php

namespace App\Form;

use App\Entity\Exportacion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class ExportacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('fechaVisita','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))   
           ->add('fechaEstimadoServicio','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))   
            ->add('fechaSalidaEmbarque','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))   
            ->add('fechaArribo','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))   
           ->add('fechaEstimadaSalida','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))   
           ->add('descripcionCarga',TextareaType::class, array('attr' => ['style'  => 'width: 100% !important;', 'rows' => 8]))
            ->add('direccionOrigen',TextareaType::class, array('attr' => ['style'  => 'width: 100% !important;', 'rows' => 8]))      
             ->add('direccionDestino',TextareaType::class, array('attr' => ['style'  => 'width: 100% !important;', 'rows' => 8]))
            ->add('documentosRecibidos',TextareaType::class, array('attr' => ['style'  => 'width: 100% !important;', 'rows' => 8]))
            ->add('detalleServicios',TextareaType::class, array('attr' => ['style'  => 'width: 100% !important;', 'rows' => 8]))
            ->add('observaciones',TextareaType::class, array('attr' => ['style'  => 'width: 100% !important;', 'rows' => 8]))
            ->add('solicitudServicio', EntityType::class,array('class' => 'App:SolicitudServicio', 'placeholder' => '-- Seleccionar --'))
            ->add('viaTransportacion', EntityType::class,array('class' => 'App:ViaTransportacion', 'placeholder' => '-- Seleccionar --'))
            ->add('condicionCompra', EntityType::class,array('class' => 'App:CondicionCompra', 'placeholder' => '-- Seleccionar --'))
           ->add('puertoOrigen', EntityType::class,array('class' => 'App:Puerto', 'placeholder' => '-- Seleccionar --'))
           ->add('puertoDestino', EntityType::class,array('class' => 'App:Puerto', 'placeholder' => '-- Seleccionar --'))
           ->add('contenedor', EntityType::class,array('class' => 'App:Contenedor', 'placeholder' => '-- Seleccionar --'))
            ->add('contrato', EntityType::class,array('class' => 'App:Contrato', 'placeholder' => '-- Seleccionar --'))
            ->add('tipoMoneda', EntityType::class,array('class' => 'App:TipoMoneda', 'placeholder' => '-- Seleccionar --'))   
           ->add('costoOrigen')
           ->add('flete')
           ->add('destino')     
           ->add('recargo')
           ->add('rx')     
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Exportacion::class,
        ]);
    }
}
