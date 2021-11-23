<?php

namespace App\Form;

use App\Entity\Contrato;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ContratoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroContrato','Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('fechaVencimiento','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))   
          
            ->add('titular')
            ->add('tipoContrato', EntityType::class,array('class' => 'App:TipoContrato', 'placeholder' => '-- Seleccionar --'))
        
           //->add('estadoCliente', EntityType::class, ['class' => EstadoCliente::class, 'choice_label' => 'Estado Cliente'])
          
                
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contrato::class,
        ]);
    }
}
