<?php

namespace App\Form;

use App\Entity\Programacion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class ProgramacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('observaciones',TextareaType::class, array('attr' => ['style'  => 'width: 100% !important;', 'rows' => 8]))
                  ->add('fechaArriboMariel','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))   
            ->add('fechaEntregadoAduana','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))   
           ->add('fechaDespachar','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))   
          
            ->add('deposito','Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('bultos','Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('numeroManifiesto','Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('numeroDesglose','Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('detalleCarga',TextareaType::class, array('attr' => ['style'  => 'width: 100% !important;', 'rows' => 8]))
             ->add('cliente', EntityType::class,array('class' => 'App:Cliente', 'placeholder' => '-- Seleccionar --'))   
          
           ->add('tipoContenedor', EntityType::class,array('class' => 'App:TipoContenedor', 'placeholder' => '-- Seleccionar --'))   
          
            ->add('transitario')
            ->add('naviera', EntityType::class,array('class' => 'App:Naviera', 'placeholder' => '-- Seleccionar --'))   
           ->add('transitario', EntityType::class,array('class' => 'App:Transitario', 'placeholder' => '-- Seleccionar --'))   
          
            ->add('contenedor', EntityType::class,array('class' => 'App:Contenedor', 'placeholder' => '-- Seleccionar --'))   
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Programacion::class,
        ]);
    }
}
