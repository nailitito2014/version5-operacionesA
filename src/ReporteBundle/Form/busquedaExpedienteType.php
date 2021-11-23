<?php

namespace ReporteBundle\Form;

use App\Entity\EstadoServicio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;

class busquedaExpedienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroExpediente')
            ->add('primerApellido')
            ->add('segundoApellido')
            ->add('numeroExpediente','Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('pies','Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('numeroMBL','Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('pies','Symfony\Component\Form\Extension\Core\Type\TextType')
           

//->add('pais', EntityType::class,array('class' => 'App:Pais', 'placeholder' => '-- Seleccionar --'))   
            //->add('estadoCliente', EntityType::class,array('class' => 'App:EstadoCliente', 'placeholder' => '-- Seleccionar --'))   
            
                ;
            
        if($options['validation'] == false)
        {
            $builder->addEventListener(FormEvents::POST_SUBMIT, function ($event) {
                    $event->stopPropagation();
                }, 900); 
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\Expediente',
            'validation' => true,
        ]);
    }
}
