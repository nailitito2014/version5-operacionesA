<?php

namespace App\Controller;

use App\Entity\EstadoServicio;
use App\Form\EstadoServicioType;
use App\Repository\EstadoServicioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;

/**
 * @Route("/estado/servicio")
 */
class EstadoServicioController extends AbstractController
{
    /**
     * @Route("/", name="estado_servicio_index", methods={"GET"})
     */
    public function index(EstadoServicioRepository $estadoServicioRepository): Response
    {
        return $this->render('estado_servicio/index.html.twig', [
            'estado_servicios' => $estadoServicioRepository->estadosServicioOrdenadosDESC(),
        ]);
    }

    /**
     * @Route("/new", name="estado_servicio_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $estadoServicio = new EstadoServicio();
        $form = $this->createForm(EstadoServicioType::class, $estadoServicio);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
      
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
            
         if ($form->isSubmitted())        
        {       
            $existeEstadoServicio = $entityManager->getRepository("App:EstadoServicio")->findByNombre($estadoServicio->getNombre());
            
            if(count($existeEstadoServicio) > 0)
                $form->get('nombre')->addError(new FormError("Ya existe un estado de servicio con este nombre."));
        }
        if ($form->isSubmitted() && $form->isValid()) {
            
            
            $estadoServicio->setFecha(new \DateTime('now'));
            $estadoServicio->setFechaInsercion(new \DateTime('now'));
             
            $entityManager->persist($estadoServicio);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Insertado satisfactoriamente el estado de servicio '.$estadoServicio.'.');


            return $this->redirectToRoute('estado_servicio_index');
        }

        return $this->render('estado_servicio/new.html.twig', [
            'estado_servicio' => $estadoServicio,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="estado_servicio_show", methods={"GET"})
     */
    public function show(EstadoServicio $estadoServicio): Response
    {
        return $this->render('estado_servicio/show.html.twig', [
            'estado_servicio' => $estadoServicio,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="estado_servicio_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EstadoServicio $estadoServicio): Response
    {
        $form = $this->createForm(EstadoServicioType::class, $estadoServicio);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success' , ',Modificado satisfactoriamente el estado de servicio '.$estadoServicio.'.');


            return $this->redirectToRoute('estado_servicio_index');
        }

        return $this->render('estado_servicio/edit.html.twig', [
            'estado_servicio' => $estadoServicio,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="estado_servicio_delete")
     */
    public function delete(Request $request, EstadoServicio $estadoServicio): Response
    { 
        try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($estadoServicio);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Eliminado satisfactoriamente el estado de servicio '.$estadoServicio.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('estado_servicio_index');
    }
    /**
     * Deletes all Estados de servicio.
     *
     * @Route("/eliminar/todos/", name="estados_servicio_delete_all")
     */
     public function deleteAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $estadosServicioId = $request->request->get("estadosServicio");
        try{
        if(!$estadosServicioId){
           $this->get('session')->getFlashBag()->add('error', 'Seleccione un estado de servicio.');
 }
        else{
            foreach($estadosServicioId as $id)
        {
            $estadoServicio = $em->getRepository("App:EstadoServicio")->find($id);
            $em->remove($estadoServicio);
            $em->flush(); 
            }
            }
             $this->addFlash('success' , 'Estado(s) de servicio eliminados satisfactoriamente.');
          
        }catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
       return $this->redirectToRoute('estado_servicio_index');
    }
}
