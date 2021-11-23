<?php

namespace App\Form;

use App\Entity\SolicitudServicio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class SolicitudServicioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           //->add('fechaSolicitud','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
              //  'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))   
            ->add('cliente')
            ->add('viaRecepcion')
            ->add('cliente', EntityType::class,array('class' => 'App:Cliente', 'placeholder' => '-- Seleccionar --'))   
            ->add('tipoServicio', EntityType::class,array('class' => 'App:TipoServicio', 'placeholder' => '-- Seleccionar --'))   
            ->add('viaRecepcion', EntityType::class,array('class' => 'App:ViaRecepcion', 'placeholder' => '-- Seleccionar --'))   
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SolicitudServicio::class,
        ]);
    }
}
