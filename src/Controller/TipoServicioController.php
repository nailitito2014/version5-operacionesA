<?php

namespace App\Controller;

use App\Entity\TipoServicio;
use App\Form\TipoServicioType;
use App\Repository\TipoServicioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;


/**
 * @Route("/tipo/servicio")
 */
class TipoServicioController extends AbstractController
{
    /**
     * @Route("/", name="tipo_servicio_index", methods={"GET"})
     */
    public function index(TipoServicioRepository $tipoServicioRepository): Response
    {
        return $this->render('tipo_servicio/index.html.twig', [
            'tipo_servicios' => $tipoServicioRepository-> tiposServicioOrdenadosDESC(),
        ]);
    }

    /**
     * @Route("/new", name="tipo_servicio_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tipoServicio = new TipoServicio();
        $form = $this->createForm(TipoServicioType::class, $tipoServicio);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
            
          
                if ($form->isSubmitted())        
        {       
            $existeTipoServicio = $entityManager->getRepository("App:TipoServicio")->findByNombre($tipoServicio->getNombre());
            
            if(count($existeTipoServicio) > 0)
                $form->get('nombre')->addError(new FormError("Ya existe un tipo de servicio con este nombre."));
        }

        if ($form->isSubmitted() && $form->isValid()) {
          
            $tipoServicio->setFecha(new \DateTime('now'));
            $tipoServicio->setFechaInsercion(new \DateTime('now'));
         
            
            $entityManager->persist($tipoServicio);
            $entityManager->flush();

            $this->addFlash('success' , 'Insertado satisfactoriamente el tipo de servicio '.$tipoServicio.'.');

            return $this->redirectToRoute('tipo_servicio_index');
        }

        return $this->render('tipo_servicio/new.html.twig', [
            'tipo_servicio' => $tipoServicio,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tipo_servicio_show", methods={"GET"})
     */
    public function show(TipoServicio $tipoServicio): Response
    {
        return $this->render('tipo_servicio/show.html.twig', [
            'tipo_servicio' => $tipoServicio,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tipo_servicio_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TipoServicio $tipoServicio): Response
    {
        $form = $this->createForm(TipoServicioType::class, $tipoServicio);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success' , 'Insertado satisfactoriamente el tipo de servicio '.$tipoServicio.'.');


            return $this->redirectToRoute('tipo_servicio_index');
        }

        return $this->render('tipo_servicio/edit.html.twig', [
            'tipo_servicio' => $tipoServicio,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("eliminar/{id}", name="tipo_servicio_delete")
     */
    public function delete(Request $request, TipoServicio $tipoServicio): Response
    {
       try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tipoServicio);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Eliminado satisfactoriamente el tipo de servicio '.$tipoServicio.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('tipo_servicio_index');
    }
    /**
     * Deletes all Tipos de servicio.
     *
     * @Route("/eliminar/todos/", name="tipos_servicio_delete_all", methods={"GET","POST"})
     */
     public function deleteAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $tiposServicioId = $request->request->get("tiposServicio");
        
        try{
        if(!$tiposServicioId){
           $this->get('session')->getFlashBag()->add('error', 'Seleccione un tipo de servicio.');
 }
        else{
            foreach($tiposServicioId as $id)
        {
            $tipoServicio = $em->getRepository("App:TipoServicio")->find($id);
            $em->remove($tipoServicio);
            $em->flush();    
        }
          
            }
              $this->addFlash('success' , 'Tipo(s) de servicio eliminados satisfactoriamente.');
   
        }catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
       return $this->redirectToRoute('tipo_servicio_index');
    }
}
