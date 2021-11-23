<?php

namespace App\Controller;

use App\Entity\ViaRecepcion;
use App\Form\ViaRecepcionType;
use App\Repository\ViaRecepcionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/via/recepcion")
 */
class ViaRecepcionController extends AbstractController
{
    /**
     * @Route("/", name="via_recepcion_index", methods={"GET"})
     */
    public function index(ViaRecepcionRepository $viaRecepcionRepository): Response
    {
        return $this->render('via_recepcion/index.html.twig', [
            'via_recepcions' => $viaRecepcionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="via_recepcion_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $viaRecepcion = new ViaRecepcion();
        $form = $this->createForm(ViaRecepcionType::class, $viaRecepcion);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
              
            $viaRecepcion->setFecha(new \DateTime('now'));
            $viaRecepcion->setFechaInsercion(new \DateTime('now'));
         
            
            $entityManager->persist($viaRecepcion);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Insertada satisfactoriamente la vía de recepción '.$viaRecepcion.'.');


            return $this->redirectToRoute('via_recepcion_index');
        }

        return $this->render('via_recepcion/new.html.twig', [
            'via_recepcion' => $viaRecepcion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="via_recepcion_show", methods={"GET"})
     */
    public function show(ViaRecepcion $viaRecepcion): Response
    {
        return $this->render('via_recepcion/show.html.twig', [
            'via_recepcion' => $viaRecepcion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="via_recepcion_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ViaRecepcion $viaRecepcion): Response
    {
        $form = $this->createForm(ViaRecepcionType::class, $viaRecepcion);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            
           $this->addFlash('success' , 'Modificada satisfactoriamente la vía de recepción '.$viaRecepcion.'.');

            return $this->redirectToRoute('via_recepcion_index');
        }

        return $this->render('via_recepcion/edit.html.twig', [
            'via_recepcion' => $viaRecepcion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="via_recepcion_delete")
     */
    public function delete(Request $request, ViaRecepcion $viaRecepcion): Response
    {
       try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($viaRecepcion);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Eliminada satisfactoriamente la vía de recepción '.$viaRecepcion.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('via_recepcion_index');
        
        
        
        
    }
}
