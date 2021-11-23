<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BaseDatosType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('servidorIp', 'Symfony\Component\Form\Extension\Core\Type\TextType', array('data' => '127.0.0.1'))
            ->add('nombreUsuario', 'Symfony\Component\Form\Extension\Core\Type\TextType', array('data' => 'root'))
            ->add('contrasenna', 'Symfony\Component\Form\Extension\Core\Type\PasswordType', array('label' => 'Contraseña'))
            //->add('fecha', null, 
                    //array('attr'=>array('required'=>true, 'class'=>'datepicker1','readonly' => 'readonly','title'=>'Campo obligatorio')))
       
             //->add('fecha','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                //'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false))   
          
            ;
    }
    
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\BaseDatos'
        ));
    }
    
    
    /**
     * @return string
     */
    public function getName()
    {
        return 'app_basedatos';
    }
}
