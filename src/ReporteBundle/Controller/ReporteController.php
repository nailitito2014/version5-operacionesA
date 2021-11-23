<?php

namespace App\ReporteBundle\Controller;

use App\Entity\Reporte;
use App\Form\ReporteType;
use App\Repository\ReporteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Cliente;



/**
 * @Route("/reporte")
 */
class ReporteController extends AbstractController
{
    
    /**
     * BUSQUEDA GENERAL POR CLIENTE
     *
     * @Route("/busqueda/por/cliente", name="busqueda_por_cliente")
     * @Method({"GET", "POST"})
     */
    public function busquedaPorClienteAction(Request $request)
    {
        $cliente = new Cliente();
        $form = $this->createForm('ReporteBundle\Form\busquedaClienteType', $cliente);
        $form->add('Buscar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn green'], 'label' => 'Buscar'));
       
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $clientes = $em->getRepository("App:Cliente")->findAll();
        
        if ($form->isSubmitted()) {
            
            $nombre = $cliente->getNombre();
            $telefono = $cliente->getTelefono();
            $correo = $cliente->getCorreo();
            $codigoreup = $cliente->getCodigoreup();
            $codigonit = $cliente->getCodigonit();
             if($nombre || $telefono || $correo || $codigoreup || $codigonit)
            {    
             $clientes =  $em->getRepository("App:Cliente")->busquedaPorCliente($nombre, $telefono, $correo , $codigoreup, $codigonit);
            }
                               }
               else{
                $clientes = $em->getRepository("App:Cliente")->findAll();
                }
                
            //$usuario = $this->getUser();
            //$rol = $usuario->getRol();
            //$nombre = $usuario->getNombre();
            //$nombreUsuario = $usuario->getNombreUsuario();
            //$primerApellido = $usuario->getPrimerApellido();
            //$segundoApellido = $usuario->getSegundoApellido();
           
           //$ip = $request->getClientIp();
           //Util::crearTraza($em, $nombre, $primerApellido, $segundoApellido, $nombreUsuario, $rol, "Visualizar búsqueda por cliente, con nombre de usuario ".$nombreUsuario.' y rol '.$rol.'.' , $ip);
 
     
        return $this->render('reportes/busquedas/cliente/busquedaPorCliente.html.twig', array(
            'form' => $form->createView(),
            'clientes' => $clientes
        ));
    }     
    
    /**
     * BUSQUEDA GENERAL POR EXPEDIENTE
     *
     * @Route("/busqueda/por/expediente", name="busqueda_por_expediente")
     * @Method({"GET", "POST"})
     */
    public function busquedaPorExpedienteAction(Request $request)
    {
        $expediente = new Expediente();
        $form = $this->createForm('ReporteBundle\Form\busquedaExpedienteType', $expediente);
        $form->add('Buscar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn green'], 'label' => 'Buscar'));
       
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $expedientes = $em->getRepository("App:Expediente")->findAll();
        
        if ($form->isSubmitted()) {
            
            $nombre = $cliente->getNombre();
            $telefono = $cliente->getTelefono();
            $correo = $cliente->getCorreo();
            $codigoreup = $cliente->getCodigoreup();
            $codigonit = $cliente->getCodigonit();
             if($nombre || $telefono || $correo || $codigoreup || $codigonit)
            {    
             $clientes =  $em->getRepository("App:Expediente")->busquedaPorCliente($nombre, $telefono, $correo , $codigoreup, $codigonit);
            }
                               }
               else{
                $clientes = $em->getRepository("App:Expediente")->findAll();
                }
                
            //$usuario = $this->getUser();
            //$rol = $usuario->getRol();
            //$nombre = $usuario->getNombre();
            //$nombreUsuario = $usuario->getNombreUsuario();
            //$primerApellido = $usuario->getPrimerApellido();
            //$segundoApellido = $usuario->getSegundoApellido();
           
           //$ip = $request->getClientIp();
           //Util::crearTraza($em, $nombre, $primerApellido, $segundoApellido, $nombreUsuario, $rol, "Visualizar búsqueda por cliente, con nombre de usuario ".$nombreUsuario.' y rol '.$rol.'.' , $ip);
 
     
        return $this->render('reportes/busquedas/expediente/busquedaPorExpediente.html.twig', array(
            'form' => $form->createView(),
            'expedientes' => $expedientes
        ));
    }     
    /**
     * BUSQUEDA GENERAL POR SOLICITUD DE SERVICIO
     *
     * @Route("/busqueda/por/solicitudServicio", name="busqueda_por_solicitudServicio")
     * @Method({"GET", "POST"})
     */
    public function busquedaPorSolicitudServicioAction(Request $request)
    {
        $solicitudServicio = new SolicitudServicio();
        $form = $this->createForm('ReporteBundle\Form\busquedaSolicitudServicioType', $solicitudServicio);
        $form->add('Buscar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn green'], 'label' => 'Buscar'));
       
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $solicitudesServicio = $em->getRepository("App:SolicitudServicio")->findAll();
        
        if ($form->isSubmitted()) {
            
            $nombre = $cliente->getNombre();
            $telefono = $cliente->getTelefono();
            $correo = $cliente->getCorreo();
            $codigoreup = $cliente->getCodigoreup();
            $codigonit = $cliente->getCodigonit();
             if($nombre || $telefono || $correo || $codigoreup || $codigonit)
            {    
             $solicitudesServicio =  $em->getRepository("App:SolicitudServicio")->busquedaPorSolicitudServicio($nombre, $telefono, $correo , $codigoreup, $codigonit);
            }
                               }
               else{
                $solicitudesServicio = $em->getRepository("App:SolicitudServicio")->findAll();
                }
                
            //$usuario = $this->getUser();
            //$rol = $usuario->getRol();
            //$nombre = $usuario->getNombre();
            //$nombreUsuario = $usuario->getNombreUsuario();
            //$primerApellido = $usuario->getPrimerApellido();
            //$segundoApellido = $usuario->getSegundoApellido();
           
           //$ip = $request->getClientIp();
           //Util::crearTraza($em, $nombre, $primerApellido, $segundoApellido, $nombreUsuario, $rol, "Visualizar búsqueda por cliente, con nombre de usuario ".$nombreUsuario.' y rol '.$rol.'.' , $ip);
 
     
        return $this->render('reportes/busquedas/solicitudServicio/busquedaPorSolicitudServicio.html.twig', array(
            'form' => $form->createView(),
            'solicitudesServicio' => $solicitudesServicio
        ));
    } 
    /**
     * BUSQUEDA GENERAL POR CONTRATO
     *
     * @Route("/busqueda/por/contrato", name="busqueda_por_contrato")
     * @Method({"GET", "POST"})
     */
    public function busquedaPorContratoAction(Request $request)
    {
        $contrato = new Contrato();
        $form = $this->createForm('ReporteBundle\Form\busquedaContratoType', $contrato);
        $form->add('Buscar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn green'], 'label' => 'Buscar'));
       
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $contratos = $em->getRepository("App:Contrato")->findAll();
        
        if ($form->isSubmitted()) {
            
            $nombre = $cliente->getNombre();
            $telefono = $cliente->getTelefono();
            $correo = $cliente->getCorreo();
            $codigoreup = $cliente->getCodigoreup();
            $codigonit = $cliente->getCodigonit();
             if($nombre || $telefono || $correo || $codigoreup || $codigonit)
            {    
             $contratos =  $em->getRepository("App:Contrato")->busquedaPorContrato($nombre, $telefono, $correo , $codigoreup, $codigonit);
            }
                               }
               else{
                $contratos = $em->getRepository("App:Contrato")->findAll();
                }
                
            //$usuario = $this->getUser();
            //$rol = $usuario->getRol();
            //$nombre = $usuario->getNombre();
            //$nombreUsuario = $usuario->getNombreUsuario();
            //$primerApellido = $usuario->getPrimerApellido();
            //$segundoApellido = $usuario->getSegundoApellido();
           
           //$ip = $request->getClientIp();
           //Util::crearTraza($em, $nombre, $primerApellido, $segundoApellido, $nombreUsuario, $rol, "Visualizar búsqueda por cliente, con nombre de usuario ".$nombreUsuario.' y rol '.$rol.'.' , $ip);
 
     
        return $this->render('reportes/busquedas/contratos/busquedaPorContrato.html.twig', array(
            'form' => $form->createView(),
            'contratos' => $contratos
        ));
    }   
    /**
     * BUSQUEDA GENERAL POR DESGLOSES DE MANIFIESTO
     *
     * @Route("/busqueda/por/desglose/manifiesto", name="busqueda_por_desglose_manifiesto")
     * @Method({"GET", "POST"})
     */
    public function busquedaPorDesgloseManifiestoAction(Request $request)
    {
        $desgloseManifiesto = new DesgloseManifiesto();
        $form = $this->createForm('ReporteBundle\Form\busquedaDesgloseManifiestoType', $desgloseManifiesto);
        $form->add('Buscar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn green'], 'label' => 'Buscar'));
       
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $desglosesManifiesto = $em->getRepository("App:DesgloseManifiesto")->findAll();
        
        if ($form->isSubmitted()) {
            
            $nombre = $cliente->getNombre();
            $telefono = $cliente->getTelefono();
            $correo = $cliente->getCorreo();
            $codigoreup = $cliente->getCodigoreup();
            $codigonit = $cliente->getCodigonit();
             if($nombre || $telefono || $correo || $codigoreup || $codigonit)
            {    
             $desglosesManifiesto =  $em->getRepository("App:DesgloseManifiesto")->busquedaPorDesglosesManifiesto($nombre, $telefono, $correo , $codigoreup, $codigonit);
            }
                               }
               else{
                $desglosesManifiesto = $em->getRepository("App:DesgloseManifiesto")->findAll();
                }
                
            //$usuario = $this->getUser();
            //$rol = $usuario->getRol();
            //$nombre = $usuario->getNombre();
            //$nombreUsuario = $usuario->getNombreUsuario();
            //$primerApellido = $usuario->getPrimerApellido();
            //$segundoApellido = $usuario->getSegundoApellido();
           
           //$ip = $request->getClientIp();
           //Util::crearTraza($em, $nombre, $primerApellido, $segundoApellido, $nombreUsuario, $rol, "Visualizar búsqueda por cliente, con nombre de usuario ".$nombreUsuario.' y rol '.$rol.'.' , $ip);
 
     
        return $this->render('reportes/busquedas/desglosesManifiesto/busquedaPorDesgloseManifiesto.html.twig', array(
            'form' => $form->createView(),
            'desglosesManifiesto' => $desglosesManifiesto
        ));
    }   
    
    
    
    
    /**
     * BUSQUEDA GENERAL POR IMPORTACION
     *
     * @Route("/busqueda/por/importacion", name="busqueda_por_importacion")
     * @Method({"GET", "POST"})
     */
    public function busquedaPorImportacionAction(Request $request)
    {
        $importacion = new Importacion();
        $form = $this->createForm('ReporteBundle\Form\busquedaImportacionType', $importacion);
        $form->add('Buscar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn green'], 'label' => 'Buscar'));
       
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $importaciones = $em->getRepository("App:Importacion")->findAll();
        
        if ($form->isSubmitted()) {
            
            $nombre = $cliente->getNombre();
            $telefono = $cliente->getTelefono();
            $correo = $cliente->getCorreo();
            $codigoreup = $cliente->getCodigoreup();
            $codigonit = $cliente->getCodigonit();
             if($nombre || $telefono || $correo || $codigoreup || $codigonit)
            {    
             $contratos =  $em->getRepository("App:Importacion")->busquedaPorContrato($nombre, $telefono, $correo , $codigoreup, $codigonit);
            }
                               }
               else{
                $contratos = $em->getRepository("App:Importacion")->findAll();
                }
                
            //$usuario = $this->getUser();
            //$rol = $usuario->getRol();
            //$nombre = $usuario->getNombre();
            //$nombreUsuario = $usuario->getNombreUsuario();
            //$primerApellido = $usuario->getPrimerApellido();
            //$segundoApellido = $usuario->getSegundoApellido();
           
           //$ip = $request->getClientIp();
           //Util::crearTraza($em, $nombre, $primerApellido, $segundoApellido, $nombreUsuario, $rol, "Visualizar búsqueda por cliente, con nombre de usuario ".$nombreUsuario.' y rol '.$rol.'.' , $ip);
 
     
        return $this->render('reportes/busquedas/importaciones/busquedaPorImportacion.html.twig', array(
            'form' => $form->createView(),
            'importaciones' => $importaciones
        ));
    }   
    
    
    
    /**
     * BUSQUEDA GENERAL POR CONTENEDOR
     *
     * @Route("/busqueda/por/contenedor", name="busqueda_por_contenedor")
     * @Method({"GET", "POST"})
     */
    public function busquedaPorContenedorAction(Request $request)
    {
        $contenedor = new Contenedor();
        $form = $this->createForm('ReporteBundle\Form\busquedaContenedorType', $contenedor);
        $form->add('Buscar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn green'], 'label' => 'Buscar'));
       
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $contenedores = $em->getRepository("App:Contenedor")->findAll();
        
        if ($form->isSubmitted()) {
            
            $nombre = $cliente->getNombre();
            $telefono = $cliente->getTelefono();
            $correo = $cliente->getCorreo();
            $codigoreup = $cliente->getCodigoreup();
            $codigonit = $cliente->getCodigonit();
             if($nombre || $telefono || $correo || $codigoreup || $codigonit)
            {    
             $contenedores =  $em->getRepository("App:Contenedor")->busquedaPorCliente($nombre, $telefono, $correo , $codigoreup, $codigonit);
            }
                               }
               else{
                $contenedoress = $em->getRepository("App:Contenedor")->findAll();
                }
                
            //$usuario = $this->getUser();
            //$rol = $usuario->getRol();
            //$nombre = $usuario->getNombre();
            //$nombreUsuario = $usuario->getNombreUsuario();
            //$primerApellido = $usuario->getPrimerApellido();
            //$segundoApellido = $usuario->getSegundoApellido();
           
           //$ip = $request->getClientIp();
           //Util::crearTraza($em, $nombre, $primerApellido, $segundoApellido, $nombreUsuario, $rol, "Visualizar búsqueda por cliente, con nombre de usuario ".$nombreUsuario.' y rol '.$rol.'.' , $ip);
 
     
        return $this->render('reportes/busquedas/contenedor/busquedaPorContenedor.html.twig', array(
            'form' => $form->createView(),
            'contenedores' => $contenedores
        ));
    }     
    
    
    
    /**
     * @Route("/", name="reporte_index", methods={"GET"})
     */
    public function index(ReporteRepository $reporteRepository): Response
    {
        return $this->render('reporte/index.html.twig', [
            'reportes' => $reporteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="reporte_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $reporte = new Reporte();
        $form = $this->createForm(ReporteType::class, $reporte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reporte);
            $entityManager->flush();

            return $this->redirectToRoute('reporte_index');
        }

        return $this->render('reporte/new.html.twig', [
            'reporte' => $reporte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reporte_show", methods={"GET"})
     */
    public function show(Reporte $reporte): Response
    {
        return $this->render('reporte/show.html.twig', [
            'reporte' => $reporte,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reporte_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reporte $reporte): Response
    {
        $form = $this->createForm(ReporteType::class, $reporte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reporte_index');
        }

        return $this->render('reporte/edit.html.twig', [
            'reporte' => $reporte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reporte_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Reporte $reporte): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reporte->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reporte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reporte_index');
    }
}
