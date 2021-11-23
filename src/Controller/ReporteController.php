<?php

namespace App\Controller;

use App\Entity\Reporte;
use App\Form\ReporteType;
use App\Repository\ReporteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
            $primerApellido = $cliente->getPrimerApellido();
            $segundoApellido = $cliente->getSegundoApellido();
            $pasaporte = $cliente->getPasaporte();
            $carnetIdentidad = $cliente->getCarnetIdentidad();
            $pais = $cliente->getPais();
            $estadoCliente = $cliente->getEstadoCliente();
        
            //$fechaInsercion = $cliente->getFechaInsercion();
            
             if($nombre || $primerApellido || $segundoApellido || $pasaporte || $carnetIdentidad || $pais || $estadoCliente)
            {    
             $clientes =  $em->getRepository("App:Cliente")->busquedaPorCliente($nombre, $primerApellido, $segundoApellido , $pasaporte, $carnetIdentidad, $pais, $estadoCliente);
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
            $primerApellido = $expediente->getPrimerApellido();
            $segundoApellido = $expediente->getSegundoApellido();
            $numeroExpediente = $expediente->getNumeroExpediente();
            $pies = $expediente->getPies();
            $numeroMBL = $expediente->getNumeroMBL();
            $entregadoAgencia = $expediente->getEntregadoAgencia();
        
            //$fechaInsercion = $cliente->getFechaInsercion();
            
             if($nombre || $primerApellido || $segundoApellido || $numeroExpediente || $pies || $numeroMBL || $entregadoAgencia)
            {    
             $expedientes =  $em->getRepository("App:Expediente")->busquedaPorExpediente($nombre, $primerApellido, $segundoApellido , $pasaporte, $carnetIdentidad, $pais, $estadoCliente);
            }
                               }
               else{
                $expedientes = $em->getRepository("App:Expediente")->findAll();
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
