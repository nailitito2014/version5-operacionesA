<?php

namespace App\Form;

use App\Entity\Contenedor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ContenedorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroContenedor','Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('cantMenajes','Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('colaboradores','Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('cantBultos','Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('kgCarga','Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('cantidadEnvio','Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('cantEna','Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('mbl','Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('buque', EntityType::class,array('class' => 'App:Buque', 'placeholder' => '-- Seleccionar --'))   
             
                
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contenedor::class,
        ]);
    }
}
