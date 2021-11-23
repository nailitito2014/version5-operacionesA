<?php

namespace App\Controller;

use App\Entity\DesgloseManifiesto;
use App\Form\DesgloseManifiestoType;
use App\Repository\DesgloseManifiestoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;

/**
 * @Route("/desglose/manifiesto")
 */
class DesgloseManifiestoController extends AbstractController
{
    /**
     * @Route("/", name="desglose_manifiesto_index", methods={"GET"})
     */
    public function index(DesgloseManifiestoRepository $desgloseManifiestoRepository): Response
    {
        return $this->render('desglose_manifiesto/index.html.twig', [
            'desglose_manifiestos' => $desgloseManifiestoRepository->desglosesManifiestoOrdenadosDESC(),
        ]);
    }

    /**
     * @Route("/new", name="desglose_manifiesto_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $desgloseManifiesto = new DesgloseManifiesto();
        $form = $this->createForm(DesgloseManifiestoType::class, $desgloseManifiesto);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
           
         if ($form->isSubmitted())        
        {       
            $existeDesgloseManifiesto = $entityManager->getRepository("App:DesgloseManifiesto")->findByNumeroDesgloseManifiesto($desgloseManifiesto->getNumeroDesgloseManifiesto());
            if(count($existeDesgloseManifiesto) > 0)
               $form->get('numeroDesgloseManifiesto')->addError(new FormError("Ya existe un desglose de manifiesto con este número."));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            
            $desgloseManifiesto->setFecha(new \DateTime('now'));
            $desgloseManifiesto->setFechaInsercion(new \DateTime('now'));
            
            $desglosesManifiesto = $entityManager->getRepository("App:DesgloseManifiesto")->findAll();
            $desgloseManifiesto->setNumeroDesgloseManifiesto('dmfto_' . "" . sprintf('%02d', count($desglosesManifiesto) + 1) ."_". date('Y'));   
            
            $entityManager->persist($desgloseManifiesto);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Insertado satisfactoriamente el desglose de manifiesto '.$desgloseManifiesto.'.');

        return $this->redirectToRoute('desglose_manifiesto_index');
        }

        return $this->render('desglose_manifiesto/new.html.twig', [
            'desglose_manifiesto' => $desgloseManifiesto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="desglose_manifiesto_show", methods={"GET"})
     */
    public function show(DesgloseManifiesto $desgloseManifiesto): Response
    {
        return $this->render('desglose_manifiesto/show.html.twig', [
            'desglose_manifiesto' => $desgloseManifiesto,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="desglose_manifiesto_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DesgloseManifiesto $desgloseManifiesto): Response
    {
        $form = $this->createForm(DesgloseManifiestoType::class, $desgloseManifiesto);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
    
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success' , 'Modificado satisfactoriamente el desglose de manifiesto '.$desgloseManifiesto.'.');

            return $this->redirectToRoute('desglose_manifiesto_index');
        }

        return $this->render('desglose_manifiesto/edit.html.twig', [
            'desglose_manifiesto' => $desgloseManifiesto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="desglose_manifiesto_delete")
     */
    public function delete(Request $request, DesgloseManifiesto $desgloseManifiesto): Response
    {
         try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($desgloseManifiesto);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Eliminado satisfactoriamente el desglose de manifiesto '.$desgloseManifiesto.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('desglose_manifiesto_index');
    }
    
    
     /**
     * Deletes all Desgloses de manifiesto.
     *
     * @Route("/eliminar/todos/", name="desgloses_manifiesto_delete_all")
     */
     public function deleteAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $desglosesManifiestoId = $request->request->get("desglosesManifiesto");
        try{
        if(!$desglosesManifiestoId){
           $this->get('session')->getFlashBag()->add('error', 'Seleccione un desglose de manifiesto.');
 }
        else{
            foreach($desglosesManifiestoId as $id)
        {
            $desgloseManifiesto = $em->getRepository("App:DesgloseManifiesto")->find($id);
            $em->remove($desgloseManifiesto);
            $em->flush(); 
            }
              }
             $this->get('session')->getFlashBag()->add('success', 'Desglose(s) de manifiesto eliminados satisfactoriamente.');  
        }catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
       return $this->redirectToRoute('desglose_manifiesto_index');
    }
}
