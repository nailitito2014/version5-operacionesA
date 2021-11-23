<?php

namespace App\Form;

use App\Entity\RectificacionDesgloseManifiesto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class RectificacionDesgloseManifiestoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('aduaman')
            ->add('tipo')
            ->add('multa')
            ->add('numeroMBL')
            ->add('numeroMulta','Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('numeroManifiesto')
            ->add('desagrupe')
            ->add('contenedor', EntityType::class,array('class' => 'App:Contenedor', 'placeholder' => '-- Seleccionar --'))
            ->add('naviera', EntityType::class,array('class' => 'App:Naviera', 'placeholder' => '-- Seleccionar --'))
            ->add('fechaNotificacionMulta','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))   
            ->add('fechaReciboManifiesto','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))   
            ->add('fechaRecibidaMulta','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))   
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RectificacionDesgloseManifiesto::class,
        ]);
    }
}
