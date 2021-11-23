<?php

namespace App\Controller;

use App\Entity\Pais;
use App\Form\PaisType;
use App\Repository\PaisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;

/**
 * @Route("/pais")
 */
class PaisController extends AbstractController
{
    /**
     * @Route("/", name="pais_index", methods={"GET"})
     */
    public function index(PaisRepository $paisRepository): Response
    {
        return $this->render('pais/index.html.twig', [
            'pais' => $paisRepository->paisesOrdenadosDESC(),
        ]);
    }

    /**
     * @Route("/new", name="pais_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pai = new Pais();
        $form = $this->createForm(PaisType::class, $pai);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
                  
          if ($form->isSubmitted())        
        {       
            $existePais = $entityManager->getRepository("App:Pais")->findByNombre($pai->getNombre());
            
            if(count($existePais) > 0)
                $form->get('nombre')->addError(new FormError("Ya existe un país con este nombre."));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            
            $pai->setFecha(new \DateTime('now'));
            $pai->setFechaInsercion(new \DateTime('now'));
         
            $entityManager->persist($pai);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Insertado satisfactoriamente el país '.$pai.'.');


            return $this->redirectToRoute('pais_index');
        }

        return $this->render('pais/new.html.twig', [
            'pai' => $pai,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pais_show", methods={"GET"})
     */
    public function show(Pais $pai): Response
    {
        return $this->render('pais/show.html.twig', [
            'pai' => $pai,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pais_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pais $pai): Response
    {
        $form = $this->createForm(PaisType::class, $pai);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success' , 'Modificado satisfactoriamente el país '.$pai.'.');



            return $this->redirectToRoute('pais_index');
        }

        return $this->render('pais/edit.html.twig', [
            'pai' => $pai,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="pais_delete")
     */
    public function delete(Request $request, Pais $pai): Response
    {
       
        try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pai);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Eliminado satisfactoriamente el país '.$pai.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('pais_index');
    }
    
     /**
     * Deletes all Paises.
     *
     * @Route("/eliminar/todos/", name="paises_delete_all")
     */
     public function deleteAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $paisesId = $request->request->get("paises");
        try{
        if(!$paisesId){
           $this->get('session')->getFlashBag()->add('error', 'Seleccione un país.');
 }
        else{
            foreach($paisesId as $id)
        {
            $pais = $em->getRepository("App:Pais")->find($id);
            $em->remove($pais);
            $em->flush(); 
            }
          
            }
               $this->get('session')->getFlashBag()->add('notice', 'Pais(es) eliminados satisfactoriamente.');

        }catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
       return $this->redirectToRoute('pais_index');
    } 
    
    
}
