<?php

namespace App\Form;

use App\Entity\DesgloseManifiesto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DesgloseManifiestoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroMBL','Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('contenedor', EntityType::class,array('class' => 'App:Contenedor', 'placeholder' => '-- Seleccionar --'))
            ->add('aduaman')
            ->add('multa')
            ->add('fechaArriboBuque','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))    
            ->add('fechaReciboManifiesto','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))   
                
           ->add('fechaDesgloseManifiesto','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))   
           ->add('fechaNotificacionMulta','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))   
          ->add('fechaRecibidaMulta','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))   
           ->add('coment')
            ->add('numeroMulta','Symfony\Component\Form\Extension\Core\Type\TextType')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DesgloseManifiesto::class,
        ]);
    }
}
