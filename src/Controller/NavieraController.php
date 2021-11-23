<?php

namespace App\Controller;

use App\Entity\Naviera;
use App\Form\NavieraType;
use App\Repository\NavieraRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;

/**
 * @Route("/naviera")
 */
class NavieraController extends AbstractController
{
    /**
     * @Route("/", name="naviera_index", methods={"GET"})
     */
    public function index(NavieraRepository $navieraRepository): Response
    {
        return $this->render('naviera/index.html.twig', [
            'navieras' => $navieraRepository->navierasOrdenadasDESC(),
        ]);
    }

    /**
     * @Route("/new", name="naviera_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $naviera = new Naviera();
        $form = $this->createForm(NavieraType::class, $naviera);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
           
          if ($form->isSubmitted())        
        {       
            $existeNaviera = $entityManager->getRepository("App:Naviera")->findByNombre($naviera->getNombre());
            
            if(count($existeNaviera) > 0)
                $form->get('nombre')->addError(new FormError("Ya existe una naviera con este nombre."));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            
            $naviera->setFecha(new \DateTime('now'));
            $naviera->setFechaInsercion(new \DateTime('now'));
         
            
            $entityManager->persist($naviera);
            $entityManager->flush();
               
            $this->addFlash('success' , 'Insertada satisfactoriamente la naviera '.$naviera.'.');


            return $this->redirectToRoute('naviera_index');
        }

        return $this->render('naviera/new.html.twig', [
            'naviera' => $naviera,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="naviera_show", methods={"GET"})
     */
    public function show(Naviera $naviera): Response
    {
        return $this->render('naviera/show.html.twig', [
            'naviera' => $naviera,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="naviera_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Naviera $naviera): Response
    {
        $form = $this->createForm(NavieraType::class, $naviera);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success' , 'Modificada satisfactoriamente la naviera '.$naviera.'.');


            return $this->redirectToRoute('naviera_index');
        }

        return $this->render('naviera/edit.html.twig', [
            'naviera' => $naviera,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="naviera_delete")
     */
    public function delete(Request $request, Naviera $naviera): Response
    {
        try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($naviera);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Eliminada satisfactoriamente la naviera '.$naviera.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('naviera_index');
    }
    
    /**
     * Deletes all Navieras.
     *
     * @Route("/eliminar/todos/", name="navieras_delete_all")
     */
     public function deleteAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $navierasId = $request->request->get("navieras");
        try{
        if(!$navierasIId){
           $this->get('session')->getFlashBag()->add('error', 'Seleccione una naviera.');
 }
        else{
            foreach($navierasIId as $id)
        {
            $naviera = $em->getRepository("App:Naviera")->find($id);
            $em->remove($naviera);
            $em->flush(); 
            }
            }
             $this->addFlash('success' , 'Naviera(s) eliminadas satisfactoriamente.');
          
        }catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
       return $this->redirectToRoute('naviera_index');
    }  
    
}
