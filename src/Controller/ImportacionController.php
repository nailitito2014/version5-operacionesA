<?php

namespace App\Controller;

use App\Entity\Importacion;
use App\Form\ImportacionType;
use App\Repository\ImportacionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;

/**
 * @Route("/importacion")
 */
class ImportacionController extends AbstractController
{
    
    /**
     * DESACTIVAR  IMPORTACION
     * 
     * @Route("/desactivar/importacion/{id}/", name="desactivar_importacion")
     * @Method("GET")
     */
    public function desactivarImportacionAction(Request $request, $id )
    {
        $em = $this->getDoctrine()->getManager();
         
        $importacion = $em->getRepository("App:Importacion")->find($id);
        
        $importacion->setFechaDesactivacion(new \DateTime('now'));
     
        $importacion->setImportacionActiva(false);
        $em->persist($importacion);
        $em->flush();
        
        $this->get('session')->getFlashBag()->add('success', 'La importación ' . $importacion . " fue desactivada satisfactoriamente". '.');
        
        return $this->redirectToRoute('importacion_index');
    } 
    
    
    
    /**
     * @Route("/", name="importacion_index", methods={"GET"})
     */
    public function index(ImportacionRepository $importacionRepository): Response
    {
        return $this->render('importacion/index.html.twig', [
            'importacions' => $importacionRepository->importacionesOrdenadasDESC(),
        ]);
    }

    /**
     * @Route("/new", name="importacion_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $importacion = new Importacion();
        $form = $this->createForm(ImportacionType::class, $importacion);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $importaciones = $entityManager->getRepository("App:Importacion")->findAll();
            $importacion->setNumeroImportacion('i_' . "" . sprintf('%02d', count($importaciones) + 1) ."_". date('Y'));
             
            $importacion->setFecha(new \DateTime('now'));
            $importacion->setFechaInsercion(new \DateTime('now'));
            
            $costoOrigen = $importacion->getCostoOrigen();
            $flete = $importacion->getFlete();
            $destino = $importacion->getDestino();
            $recargo = $importacion->getRecargo();
            $rx = $importacion->getRx();
            
            $presupuesto = $costoOrigen + $flete + $destino + $recargo + $rx;
           
            $importacion->setPresupuesto($presupuesto);
            
            $entityManager->persist($importacion);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Insertada satisfactoriamente la importación '.$importacion.'.');


            return $this->redirectToRoute('importacion_index');
        }

        return $this->render('importacion/new.html.twig', [
            'importacion' => $importacion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="importacion_show", methods={"GET"})
     */
    public function show(Importacion $importacion): Response
    {
        return $this->render('importacion/show.html.twig', [
            'importacion' => $importacion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="importacion_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Importacion $importacion): Response
    {
        $form = $this->createForm(ImportacionType::class, $importacion);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
      
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $costoOrigen = $importacion->getCostoOrigen();
            $flete = $importacion->getFlete();
            $destino = $importacion->getDestino();
            $recargo = $importacion->getRecargo();
            $rx = $importacion->getRx();
            
            $presupuesto = $costoOrigen + $flete + $destino + $recargo + $rx;
            
            //print_r($presupuesto);
            //exit();
           
            $importacion->setPresupuesto($presupuesto);
         
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success' , 'Modificada satisfactoriamente la importación '.$importacion.'.');


            return $this->redirectToRoute('importacion_index');
        }

        return $this->render('importacion/edit.html.twig', [
            'importacion' => $importacion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="importacion_delete")
     */
    public function delete(Request $request, Importacion $importacion): Response
    {
      try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($importacion);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Eliminada satisfactoriamente la importación '.$importacion.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('importacion_index');
    }
     /**
     * Deletes all Importaciones.
     *
     * @Route("/eliminar/todos/", name="importaciones_delete_all")
     */
     public function deleteAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $importacionesId = $request->request->get("importaciones");
        try{
        if(!$importacionesId){
           $this->get('session')->getFlashBag()->add('error', 'Seleccione una importación.');
 }
        else{
            foreach($importacionesId as $id)
        {
            $importacion = $em->getRepository("App:Importacion")->find($id);
            $em->remove($importacion);
            $em->flush(); 
            }
            }
              $this->get('session')->getFlashBag()->add('success', 'Importacion(es) eliminadas satisfactoriamente.');  
      
        }catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
       return $this->redirectToRoute('importacion_index');
    }  
    
}
