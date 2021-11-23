<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\BaseDatos;
use Symfony\Component\Form\FormError;



ini_set('memory_limit', '2048M');
ini_set('max_input_time', -1);
ini_set('max_execution_time',-1);
            
/**
 * Medios controller.
 *
 * @Route("/baseDatos")
 */
class BaseDatosController extends AbstractController
{
    
     /*
     * Devuelve la ruta al directorio  utilizado para guardar las bases de datos
     */
      private function getUploadsDir() {             
        return __DIR__.'/../../public/bd/';
    }
    
    /**
     * 
     * @Route("/salvar", name="base_datos_salvar")
     */
    public function salvarBaseDatosAction()
    {        
        $entity = new BaseDatos();
        $form   = $this->createCreateForm($entity, 'base_datos_salvar_dump');
        $form->add('Salvar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));

       
        return $this->render('basedatos/salvar.html.twig', array(
            'form'   => $form->createView(),
        ));        
    }
    
    
    /**
     * 
     * @Route("/salvarDUMP", name="base_datos_salvar_dump")
     */
    public function salvarDUMPBaseDatosAction(Request $request)
    {
        $entity = new BaseDatos();
        $form = $this->createCreateForm($entity, 'base_datos_salvar_dump');
        $form->add('Salvar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn green']));
        
        $form->handleRequest($request);
        
        
        if ($form->isValid())
        {            
            $servidorIp = $entity->getServidorIp();
            $usuario = $entity->getNombreUsuario();
            $contrasenna = $entity->getContrasenna();            
            
             
            $db="operacionesaduana". date('d_m_Y');
            $nombreFichero=$db.".sql";
            $ruta=$this->getUploadsDir();
            
            
            if (file_exists("$ruta$nombreFichero")) 
            {
                unlink("$ruta$nombreFichero");
            }
            
            //print_r("$ruta$nombreFichero");
            //print_r("E:/xampp/mysql/bin/mysqldump -u $usuario --password=$contrasenna -h $servidorIp --opt controlmedios >  $ruta$nombreFichero");
            ini_set('memory_limit', '2048M');
            ini_set('max_input_time', -1);
            ini_set('max_execution_time',-1);
            system("/xampp/mysql/bin/mysqldump -u $usuario --password=$contrasenna -h $servidorIp --opt operacionesaduana >  $ruta$nombreFichero", $output);	
            
            
            
            if($output)
            {
                $this->get('session')->getFlashBag()->add('notice','Base de datos no salvada. Revise su configuración de conexión');
                return $this->render('basedatos/salvar.html.twig', array(
                    'entity' => $entity,
                    'form'   => $form->createView(),
                ));
            }
            
            
            $em = $this->getDoctrine()->getManager();
            $usuario = $this->getUser();
            $ip = $request->getClientIp();
            //Util::crearTraza($em, $usuario, "Guardar base de datos", $ip);
            
            
            $this->get('session')->getFlashBag()->add('notice','La base datos fue salvada correctamente.');
            return $this->redirect($this->generateUrl('base_datos_salvar'));            
        }
        
        return $this->render('basedatos/salvar.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    
    
    
     /**
     * Creates a form to create a Centro entity.
     *
     * @param Centro $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(BaseDatos $entity, $url)
    {
        $form = $this->createForm('App\Form\BaseDatosType', $entity, array(
            'action' => $this->generateUrl($url),
            'method' => 'POST',
        ));
        return $form;
    }
    /**
     * 
     * @Route("/cargar", name="base_datos_cargar")
     */
    public function cargarBaseDatosAction()
    {        
        $entity = new BaseDatos();
        $form   = $this->createCreateForm($entity, 'basedatos_restaurar_desdedump');
        $form->add('fecha','Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('style'=>'width: 100% !important;'), 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false));   
           
        
        
        
        $form->add('Restaurar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
       
        return $this->render('BaseDatos/restaurar.html.twig', array(
            'form'   => $form->createView(),
        ));        
    } 
    /**
     * 
     * @Route("/cargar_dump", name="basedatos_restaurar_desdedump")
     */
    public function restaurarBaseDatosDumpAction(Request $request)
    {
        $entity = new BaseDatos();
        $form = $this->createCreateForm($entity, 'basedatos_restaurar_desdedump');
        $form->add('fecha', 'Symfony\Component\Form\Extension\Core\Type\DateType', array('attr'=>array('class'=>'datepicker1'),  'label' => 'Fecha', 
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy','html5' => false));
        
        $form->add('Restaurar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
        
        $form->handleRequest($request);
        
        
        if(!$form->get('fecha')->getData())
        {
            $form->get('fecha')->addError(new FormError("El campo fecha no puede estar en blanco."));
        }

        if ($form->isValid()) 
        {            
            $servidorIp = $entity->getServidorIp();
            $usuario = $entity->getNombreUsuario();
            $contrasenna = $entity->getContrasenna();
            
            $fecha = $entity->getFecha();
             
            $db="operacionesaduana".$fecha->format('d')."_".$fecha->format('m'). "_" . $fecha->format('Y');
                  
            $nombreFichero=$db.".sql";
            
            $ruta=$this->getUploadsDir();
            
            if (!file_exists("$ruta$nombreFichero")) 
            {
                $this->get('session')->getFlashBag()->add('notice','La base datos no existe con esta fecha.');
                return $this->redirect($this->generateUrl('base_datos_cargar'));      
            }

            ini_set('memory_limit', '2048M');
            ini_set('max_input_time', -1);
            ini_set('max_execution_time',-1);
            system("/xampp/mysql/bin/mysql -u $usuario --password=$contrasenna -h $servidorIp operacionesaduana < $ruta$nombreFichero", $output);	

            if($output)
            {
                $this->get('session')->getFlashBag()->add('notice','Base de datos no salvada. Revise su configuración de conexión');
                
                return $this->render('basedatos/restaurar.html.twig', array(
                    'entity' => $entity,
                    'form'   => $form->createView(),
                ));
            }
            
            $em = $this->getDoctrine()->getManager();
            $usuario = $this->getUser();
            $ip = $request->getClientIp();
            //Util::crearTraza($em, $usuario, "Restaurar base de datos", $ip);
            
            $this->get('session')->getFlashBag()->add('notice','La base datos fue restaurada correctamente.');
            return $this->redirect($this->generateUrl('base_datos_cargar'));            
        }
        return $this->render('basedatos/restaurar.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    
}
