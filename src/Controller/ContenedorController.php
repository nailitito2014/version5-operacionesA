<?php

namespace App\Controller;

use App\Entity\Contenedor;
use App\Form\ContenedorType;
use App\Repository\ContenedorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;

/**
 * @Route("/contenedor")
 */
class ContenedorController extends AbstractController
{
    /**
     * @Route("/", name="contenedor_index", methods={"GET"})
     */
    public function index(ContenedorRepository $contenedorRepository): Response
    {
        return $this->render('contenedor/index.html.twig', [
            'contenedors' => $contenedorRepository->contenedoresOrdenadosDESC(),
        ]);
    }

    /**
     * @Route("/new", name="contenedor_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $contenedor = new Contenedor();
        $form = $this->createForm(ContenedorType::class, $contenedor);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
            
          if ($form->isSubmitted())        
        {       
            $existeContenedor = $entityManager->getRepository("App:Contenedor")->findByNumeroContenedor($contenedor->getNumeroContenedor());
            if(count($existeContenedor) > 0)
               $form->get('numeroContenedor')->addError(new FormError("Ya existe un contenedor con este número."));
        }

        if ($form->isSubmitted() && $form->isValid()) {
             
            $contenedor->setFecha(new \DateTime('now'));
            $contenedor->setFechaInsercion(new \DateTime('now'));
            
            $entityManager->persist($contenedor);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Insertado satisfactoriamente el contenedor '.$contenedor.'.');


            return $this->redirectToRoute('contenedor_index');
        }

        return $this->render('contenedor/new.html.twig', [
            'contenedor' => $contenedor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contenedor_show", methods={"GET"})
     */
    public function show(Contenedor $contenedor): Response
    {
        return $this->render('contenedor/show.html.twig', [
            'contenedor' => $contenedor,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="contenedor_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Contenedor $contenedor): Response
    {
        $form = $this->createForm(ContenedorType::class, $contenedor);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
           
            $this->addFlash('success' , 'Modificado satisfactoriamente el contenedor '.$contenedor.'.');


            return $this->redirectToRoute('contenedor_index');
        }

        return $this->render('contenedor/edit.html.twig', [
            'contenedor' => $contenedor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="contenedor_delete")
     */
    public function delete(Request $request, Contenedor $contenedor): Response
    {
          try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contenedor);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Eliminado satisfactoriamente el contenedor '.$contenedor.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('contenedor_index');
    }                
    
     /**
     * Deletes all Contenedores.
     *
     * @Route("/eliminar/todos/", name="contenedores_delete_all")
     */
     public function deleteAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $contenedoresId = $request->request->get("contenedores");
        try{
        if(!$contenedoresId){
           $this->get('session')->getFlashBag()->add('error', 'Seleccione un contenedor.');
 }
        else{
            foreach($contenedoresId as $id)
        {
            $contenedor = $em->getRepository("App:Contenedor")->find($id);
            $em->remove($contenedor);
            $em->flush(); 
            }
              }
            $this->get('session')->getFlashBag()->add('success', 'Contrato(s) eliminados satisfactoriamente.');
        }catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
       return $this->redirectToRoute('contenedor_index');
    }
    
    

}
