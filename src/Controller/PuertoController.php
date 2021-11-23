<?php

namespace App\Controller;

use App\Entity\Puerto;
use App\Form\PuertoType;
use App\Repository\PuertoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;

/**
 * @Route("/puerto")
 */
class PuertoController extends AbstractController
{
    /**
     * @Route("/", name="puerto_index", methods={"GET"})
     */
    public function index(PuertoRepository $puertoRepository): Response
    {
        return $this->render('puerto/index.html.twig', [
            'puertos' => $puertoRepository->puertosOrdenadosDESC(),
        ]);
    }

    /**
     * @Route("/new", name="puerto_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $puerto = new Puerto();
        $form = $this->createForm(PuertoType::class, $puerto);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
      
        
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
              
          if ($form->isSubmitted())        
        {       
            $existePuerto = $entityManager->getRepository("App:Puerto")->findByNombre($puerto->getNombre());
            
            if(count($existePuerto) > 0)
                $form->get('nombre')->addError(new FormError("Ya existe un puerto con este nombre."));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            
            $puerto->setFecha(new \DateTime('now'));
            $puerto->setFechaInsercion(new \DateTime('now'));   
        
            $entityManager->persist($puerto);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Insertado satisfactoriamente el puerto '.$puerto.'.');


            return $this->redirectToRoute('puerto_index');
        }

        return $this->render('puerto/new.html.twig', [
            'puerto' => $puerto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="puerto_show", methods={"GET"})
     */
    public function show(Puerto $puerto): Response
    {
        return $this->render('puerto/show.html.twig', [
            'puerto' => $puerto,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="puerto_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Puerto $puerto): Response
    {
        $form = $this->createForm(PuertoType::class, $puerto);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
      
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success' , 'Modificado satisfactoriamente el puerto '.$puerto.'.');


            return $this->redirectToRoute('puerto_index');
        }

        return $this->render('puerto/edit.html.twig', [
            'puerto' => $puerto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="puerto_delete")
     */
    public function delete(Request $request, Puerto $puerto): Response
    {
        try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($puerto);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Eliminado satisfactoriamente el puerto '.$puerto.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('puerto_index');
    }
    
    /**
     * Deletes all Puertos.
     *
     * @Route("/eliminar/todos/", name="puertos_delete_all")
     */
     public function deleteAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $puertosId = $request->request->get("puertos");
        try{
        if(!$puertosId){
           $this->get('session')->getFlashBag()->add('error', 'Seleccione un puerto.');
 }
        else{
            foreach($puertosId as $id)
        {
            $puerto = $em->getRepository("App:Puerto")->find($id);
            $em->remove($puerto);
            $em->flush(); 
            }
            }
              $this->addFlash('success' , 'Puerto(s) eliminados satisfactoriamente.');
          
        }catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
       return $this->redirectToRoute('puerto_index');
    }  
    
    
}
