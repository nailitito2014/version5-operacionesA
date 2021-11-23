<?php

namespace App\Controller;

use App\Entity\Cliente;
use App\Form\ClienteType;
use App\Repository\ClienteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;

/**
 * @Route("/cliente")
 */
class ClienteController extends AbstractController
{
    
    
    /**
     * DESACTIVAR  CLIENTE
     * 
     * @Route("/desactivar/cliente/{id}/", name="desactivar_cliente")
     * @Method("GET")
     */
    public function desactivarClientesAction(Request $request, $id )
    {
        $em = $this->getDoctrine()->getManager();
         
        $cliente = $em->getRepository("App:Cliente")->find($id);
        
        $cliente->setFechaDesactivacion(new \DateTime('now'));
     
        $cliente->setClienteActivo(false);
        $em->persist($cliente);
        $em->flush();
        
        $this->get('session')->getFlashBag()->add('success', 'El cliente ' . $cliente . " fue desactivado satisfactoriamente". '.');
        
        return $this->redirectToRoute('cliente_index');
    } 
    
    
    
    
    /**
     * @Route("/", name="cliente_index", methods={"GET"})
     */
    public function index(ClienteRepository $clienteRepository): Response
    {
        return $this->render('cliente/index.html.twig', [
            'clientes' => $clienteRepository->clientesOrdenadosDESC(),
        ]);
    }

    /**
     * @Route("/new", name="cliente_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cliente = new Cliente();
        $form = $this->createForm(ClienteType::class, $cliente);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
           
          if ($form->isSubmitted())        
        {       
            $existeCliente = $entityManager->getRepository("App:Cliente")->findByNombre($cliente->getNombre());
            if(count($existeCliente) > 0)
                $form->get('nombre')->addError(new FormError("Ya existe un cliente con este nombre."));
        }

        if ($form->isSubmitted() && $form->isValid()) {
           
            $cliente->setFecha(new \DateTime('now'));
            $cliente->setFechaInsercion(new \DateTime('now'));
            
            $entityManager->persist($cliente);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Insertado satisfactoriamente el cliente '.$cliente.'.');

            return $this->redirectToRoute('cliente_index');
        }

        return $this->render('cliente/new.html.twig', [
            'cliente' => $cliente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cliente_show", methods={"GET"})
     */
    public function show(Cliente $cliente): Response
    {
        return $this->render('cliente/show.html.twig', [
            'cliente' => $cliente,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cliente_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cliente $cliente): Response
    {
        $form = $this->createForm(ClienteType::class, $cliente);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
      
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success' , 'Modificado satisfactoriamente el cliente '.$cliente.'.');
 
            return $this->redirectToRoute('cliente_index');
        }

        return $this->render('cliente/edit.html.twig', [
            'cliente' => $cliente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="cliente_delete")
     */
    public function delete(Request $request, Cliente $cliente): Response
    {
       try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cliente);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Eliminado satisfactoriamente el cliente '.$cliente.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('cliente_index');
    }
    
    /**
     * Deletes all Clientes.
     *
     * @Route("/eliminar/todos/", name="clientes_delete_all")
     */
     public function deleteAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $clientesId = $request->request->get("clientes");
        try{
        if(!$clientesId){
           $this->get('session')->getFlashBag()->add('error', 'Seleccione un cliente.');
 }
        else{
            foreach($clienteId as $id)
        {
            $cliente = $em->getRepository("App:Cliente")->find($id);
            $em->remove($cliente);
            $em->flush(); 
            }
              }
             $this->get('session')->getFlashBag()->add('success', 'Cliente(s) eliminados satisfactoriamente.');

        }catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
       return $this->redirectToRoute('cliente_index');
    }

}
