<?php

namespace App\Controller;

use App\Entity\Transitario;
use App\Form\TransitarioType;
use App\Repository\TransitarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;

/**
 * @Route("/transitario")
 */
class TransitarioController extends AbstractController
{
    /**
     * @Route("/", name="transitario_index", methods={"GET"})
     */
    public function index(TransitarioRepository $transitarioRepository): Response
    {
        return $this->render('transitario/index.html.twig', [
            'transitarios' => $transitarioRepository->transitariosOrdenadosDESC(),
        ]);
    }

    /**
     * @Route("/new", name="transitario_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $transitario = new Transitario();
        $form = $this->createForm(TransitarioType::class, $transitario);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
       
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
           
        if ($form->isSubmitted())        
        {       
            $existeTransitario = $entityManager->getRepository("App:Transitario")->findByNombre($transitario->getNombre());
            
            if(count($existeTransitario) > 0)
                $form->get('nombre')->addError(new FormError("Ya existe un transitario con este nombre."));
        }

        if ($form->isSubmitted() && $form->isValid()) {
             
            $transitario->setFecha(new \DateTime('now'));
            $transitario->setFechaInsercion(new \DateTime('now'));
            
            $entityManager->persist($transitario);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Insertado satisfactoriamente el transitario '.$transitario.'.'); 

            return $this->redirectToRoute('transitario_index');
        }

        return $this->render('transitario/new.html.twig', [
            'transitario' => $transitario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="transitario_show", methods={"GET"})
     */
    public function show(Transitario $transitario): Response
    {
        return $this->render('transitario/show.html.twig', [
            'transitario' => $transitario,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="transitario_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Transitario $transitario): Response
    {
        $form = $this->createForm(TransitarioType::class, $transitario);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
       
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success' , 'Modificado satisfactoriamente el transitario '.$transitario.'.');
  
            return $this->redirectToRoute('transitario_index');
        }

        return $this->render('transitario/edit.html.twig', [
            'transitario' => $transitario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="transitario_delete")
     */
    public function delete(Request $request, Transitario $transitario): Response
    {
       try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($transitario);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Eliminado satisfactoriamente el transitario '.$transitario.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('transitario_index');
    }
    
    /**
     * Deletes all Transitarios.
     *
     * @Route("/eliminar/todos/", name="transitarios_delete_all")
     */
     public function deleteAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $transitariosId = $request->request->get("transitarios");
        try{
        if(!$transitariosId){
           $this->get('session')->getFlashBag()->add('error', 'Seleccione un transitario.');
 }
        else{
            foreach($transitariosId as $id)
        {
            $transitario = $em->getRepository("App:Transitario")->find($id);
            $em->remove($transitario);
            $em->flush(); 
            }
           
            }
            $this->addFlash('success' , 'Transitario(s) eliminados satisfactoriamente.');
             
        }catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
       return $this->redirectToRoute('transitario_index');
    } 
}
