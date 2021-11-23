<?php

namespace App\Form;

use App\Entity\ImportaCubano;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ImportaCubanoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('numeroManifiesto','Symfony\Component\Form\Extension\Core\Type\TextType')
             ->add('provincia', EntityType::class,array('class' => 'App:Provincia', 'placeholder' => '-- Seleccionar --'))   
            ->add('naviera', EntityType::class,array('class' => 'App:Naviera', 'placeholder' => '-- Seleccionar --'))   
            ->add('transitario', EntityType::class,array('class' => 'App:Transitario', 'placeholder' => '-- Seleccionar --'))   
            ->add('contenedor', EntityType::class,array('class' => 'App:Contenedor', 'placeholder' => '-- Seleccionar --'))   
            ->add('solicitudServicio', EntityType::class,array('class' => 'App:SolicitudServicio', 'placeholder' => '-- Seleccionar --'))   
            ->add('estadoServicio', EntityType::class,array('class' => 'App:EstadoServicio', 'placeholder' => '-- Seleccionar --'))   
            ->add('paisProcedencia', EntityType::class,array('class' => 'App:Pais', 'placeholder' => '-- Seleccionar --'))   
              ->add('fechaEntregaAduana','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))   
             ->add('fechaAutorizoEmbarque','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))    
               ->add('desgloseManifiesto', EntityType::class,array('class' => 'App:DesgloseManifiesto', 'placeholder' => '-- Seleccionar --'))   
            ->add('fechaArribo','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))    
           
                 
                
                
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ImportaCubano::class,
        ]);
    }
}
