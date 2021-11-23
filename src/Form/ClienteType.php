<?php

namespace App\Form;

use App\Entity\Cliente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class ClienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('primerApellido')
            ->add('segundoApellido')
            ->add('carnetIdentidad','Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('pasaporte','Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('pais', EntityType::class,array('class' => 'App:Pais', 'placeholder' => '-- Seleccionar --'))   
            ->add('categoriaCliente', EntityType::class,array('class' => 'App:CategoriaCliente', 'placeholder' => '-- Seleccionar --'))   
            ->add('fechaCertificoInmigracion','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))   
            ->add('fechaVencimientoCertificoInmigracion','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))   
           
                 
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cliente::class,
        ]);
    }
}
