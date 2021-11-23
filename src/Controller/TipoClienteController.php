<?php

namespace App\Controller;

use App\Entity\TipoCliente;
use App\Form\TipoClienteType;
use App\Repository\TipoClienteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;

/**
 * @Route("/tipo/cliente")
 */
class TipoClienteController extends AbstractController
{
    /**
     * @Route("/", name="tipo_cliente_index", methods={"GET"})
     */
    public function index(TipoClienteRepository $tipoClienteRepository): Response
    {
        return $this->render('tipo_cliente/index.html.twig', [
            'tipo_clientes' => $tipoClienteRepository->tiposClientesOrdenadosDESC(),
        ]);
    }

    /**
     * @Route("/new", name="tipo_cliente_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tipoCliente = new TipoCliente();
        $form = $this->createForm(TipoClienteType::class, $tipoCliente);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
        
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
         
                 if ($form->isSubmitted())        
        {       
            $existeTipoCliente = $entityManager->getRepository("App:TipoCliente")->findByNombre($tipoCliente->getNombre());
            
            if(count($existeTipoCliente) > 0)
                $form->get('nombre')->addError(new FormError("Ya existe un tipo de cliente con este nombre."));
        }

        if ($form->isSubmitted() && $form->isValid()) {
           
            $tipoCliente->setFecha(new \DateTime('now'));
            $tipoCliente->setFechaInsercion(new \DateTime('now'));   
            
            $entityManager->persist($tipoCliente);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Insertado satisfactoriamente el tipo de cliente '.$tipoCliente.'.');

            return $this->redirectToRoute('tipo_cliente_index');
        }

        return $this->render('tipo_cliente/new.html.twig', [
            'tipo_cliente' => $tipoCliente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tipo_cliente_show", methods={"GET"})
     */
    public function show(TipoCliente $tipoCliente): Response
    {
        return $this->render('tipo_cliente/show.html.twig', [
            'tipo_cliente' => $tipoCliente,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tipo_cliente_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TipoCliente $tipoCliente): Response
    {
        $form = $this->createForm(TipoClienteType::class, $tipoCliente);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
       
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success' , 'Modificado satisfactoriamente el tipo de cliente '.$tipoCliente.'.');
 
            return $this->redirectToRoute('tipo_cliente_index');
        }

        return $this->render('tipo_cliente/edit.html.twig', [
            'tipo_cliente' => $tipoCliente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="tipo_cliente_delete")
     */
    public function delete(Request $request, TipoCliente $tipoCliente): Response
    {
       try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tipoCliente);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Eliminado satisfactoriamente el tipo de cliente '.$tipoCliente.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('tipo_cliente_index');
    }
    /**
     * Deletes all Tipos de cliente.
     *
     * @Route("/eliminar/todos/", name="tipos_cliente_delete_all", methods={"GET","POST"})
     */
     public function deleteAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $tiposClienteId = $request->request->get("tiposCliente");
        try{
        if(!$tiposClienteId){
           $this->get('session')->getFlashBag()->add('error', 'Seleccione un tipo de cliente.');
 }
        else{
            foreach($tiposClienteId as $id)
        {
            $tipoCliente = $em->getRepository("App:TipoCliente")->find($id);
            $em->remove($tipoCliente);
            $em->flush(); 
            }
           
            }
               $this->addFlash('success' , 'Tipo(s) de cliente eliminados satisfactoriamente.');
               
          }catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
       return $this->redirectToRoute('tipo_cliente_index');
    } 
    
    
}
