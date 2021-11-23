<?php

namespace App\Form;

use App\Entity\Buque;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class BuqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('numeroViaje')
            ->add('puertoSalida', EntityType::class,array('class' => 'App:Puerto', 'placeholder' => '-- Seleccionar --'))   
        
                 
                
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Buque::class,
        ]);
    }
}
