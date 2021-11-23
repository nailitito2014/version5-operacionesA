<?php

namespace App\Controller;

use App\Entity\Programacion;
use App\Form\ProgramacionType;
use App\Repository\ProgramacionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;

/**
 * @Route("/programacion")
 */
class ProgramacionController extends AbstractController
{
    /**
     * @Route("/", name="programacion_index", methods={"GET"})
     */
    public function index(ProgramacionRepository $programacionRepository): Response
    {
        return $this->render('programacion/index.html.twig', [
            'programaciones' => $programacionRepository->programacionesOrdenadasDESC(),
        ]);
    }

    /**
     * @Route("/new", name="programacion_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $programacion = new Programacion();
        $form = $this->createForm(ProgramacionType::class, $programacion);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
      
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $programacion->setFecha(new \DateTime('now'));
            $programacion->setFechaInsercion(new \DateTime('now'));
         
            
            $entityManager->persist($programacion);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Insertada satisfactoriamente la programación '.$programacion.'.');


            return $this->redirectToRoute('programacion_index');
        }

        return $this->render('programacion/new.html.twig', [
            'programacion' => $programacion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="programacion_show", methods={"GET"})
     */
    public function show(Programacion $programacion): Response
    {
        return $this->render('programacion/show.html.twig', [
            'programacion' => $programacion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="programacion_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Programacion $programacion): Response
    {
        $form = $this->createForm(ProgramacionType::class, $programacion);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
      
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success' , 'Modificada satisfactoriamente la programación '.$programacion.'.');


            return $this->redirectToRoute('programacion_index');
        }

        return $this->render('programacion/edit.html.twig', [
            'programacion' => $programacion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="programacion_delete")
     */
    public function delete(Request $request, Programacion $programacion): Response
    {
          try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($programacion);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Eliminada satisfactoriamente la programación '.$programacion.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('programacion_index');
    }
     
    /**
     * Deletes all Programaciones.
     *
     * @Route("/eliminar/todos/", name="programaciones_delete_all")
     */
     public function deleteAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $programacionesId = $request->request->get("programaciones");
        try{
        if(!$programacionesId){
           $this->get('session')->getFlashBag()->add('error', 'Seleccione una programación.');
 }
        else{
            foreach($programacionesId as $id)
        {
            $programacion = $em->getRepository("App:Programacion")->find($id);
            $em->remove($programacion);
            $em->flush(); 
            }
            }
            $this->addFlash('success' , 'Programacion(es) eliminadas satisfactoriamente.');
             
        }catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
       return $this->redirectToRoute('programacion_index');
    } 
}
