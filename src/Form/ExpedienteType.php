<?php

namespace App\Form;

use App\Entity\Expediente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class ExpedienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('primerApellido')
            ->add('segundoApellido')
            ->add('bultos','Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('pesoKg')
             ->add('pies')
            ->add('numeroMBL')
            ->add('numeroManifiesto')
            ->add('fechaDespacho','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))             
          ->add('fechaEntrega','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))              
          ->add('fechaArribo','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))           
          ->add('recibidoAduana')
            ->add('entregadoAgencia')
            ->add('telefonoFijo')
            ->add('telefonoMovil')
            ->add('notas',TextareaType::class, array('attr' => ['style'  => 'width: 100% !important;', 'rows' => 8]))
              ->add('provincia', EntityType::class,array('class' => 'App:Provincia', 'placeholder' => '-- Seleccionar --'))   
            ->add('pais', EntityType::class,array('class' => 'App:Pais', 'placeholder' => '-- Seleccionar --'))   
           ->add('contenedor', EntityType::class,array('class' => 'App:Contenedor', 'placeholder' => '-- Seleccionar --'))   
           ->add('naviera', EntityType::class,array('class' => 'App:Naviera', 'placeholder' => '-- Seleccionar --'))   
           ->add('certificoInmigracionFile' , FileType::class,array('label' => 'Certifico de inmigracion'))
            ->add('desgloseFile' , FileType::class)
            ->add('manifiestoFile' , FileType::class)
            ->add('cartaOriginalFile' , FileType::class)
            ->add('franquiciaDiplomaticaFile' , FileType::class)
            ->add('fechaEntregadoDeposito','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))           
            
                
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Expediente::class,
        ]);
    }
}
