<?php

namespace App\Controller;

use App\Entity\Exportacion;
use App\Form\ExportacionType;
use App\Repository\ExportacionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;

/**
 * @Route("/exportacion")
 */
class ExportacionController extends AbstractController
{
    
    /**
     * DESACTIVAR  EXPORTACION
     * 
     * @Route("/desactivar/exportacion/{id}/", name="desactivar_exportacion")
     * @Method("GET")
     */
    public function desactivarExportacionAction(Request $request, $id )
    {
        $em = $this->getDoctrine()->getManager();
         
        $exportacion = $em->getRepository("App:Exportacion")->find($id);
        
        $exportacion->setFechaDesactivacion(new \DateTime('now'));
     
        $exportacion->setExportacionActiva(false);
        $em->persist($exportacion);
        $em->flush();
        
        $this->get('session')->getFlashBag()->add('success', 'La exportación ' . $exportacion . " fue desactivada satisfactoriamente". '.');
        
        return $this->redirectToRoute('exportacion_index');
    } 
    
    /**
     * @Route("/", name="exportacion_index", methods={"GET"})
     */
    public function index(ExportacionRepository $exportacionRepository): Response
    {
        return $this->render('exportacion/index.html.twig', [
            'exportacions' => $exportacionRepository->exportacionesOrdenadasDESC(),
        ]);
    }

    /**
     * @Route("/new", name="exportacion_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $exportacion = new Exportacion();
        $form = $this->createForm(ExportacionType::class, $exportacion);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $exportaciones = $entityManager->getRepository("App:Exportacion")->findAll();
            $exportacion->setNumeroExportacion('ex_' . "" . sprintf('%02d', count($exportaciones) + 1) ."_". date('Y'));
          
            $costoOrigen = $exportacion->getCostoOrigen();
            $flete = $exportacion->getFlete();
            $destino = $exportacion->getDestino();
            $recargo = $exportacion->getRecargo();
            $rx = $exportacion->getRx();
            
            $presupuesto = $costoOrigen + $flete + $destino + $recargo + $rx;
            $exportacion->setPresupuesto($presupuesto);
         
           
            $exportacion->setFecha(new \DateTime('now'));
            $exportacion->setFechaInsercion(new \DateTime('now'));
           
            $entityManager->persist($exportacion);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Insertada satisfactoriamente la exportación '.$exportacion.'.');


            return $this->redirectToRoute('exportacion_index');
        }

        return $this->render('exportacion/new.html.twig', [
            'exportacion' => $exportacion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="exportacion_show", methods={"GET"})
     */
    public function show(Exportacion $exportacion): Response
    {
        return $this->render('exportacion/show.html.twig', [
            'exportacion' => $exportacion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="exportacion_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Exportacion $exportacion): Response
    {
        $form = $this->createForm(ExportacionType::class, $exportacion);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $costoOrigen = $exportacion->getCostoOrigen();
            $flete = $exportacion->getFlete();
            $destino = $exportacion->getDestino();
            $recargo = $exportacion->getRecargo();
            $rx = $exportacion->getRx();
            
            $presupuesto = $costoOrigen + $flete + $destino + $recargo + $rx;
            $exportacion->setPresupuesto($presupuesto);
         
           
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success' , 'Modificada satisfactoriamente la exportación '.$exportacion.'.');


            return $this->redirectToRoute('exportacion_index');
        }

        return $this->render('exportacion/edit.html.twig', [
            'exportacion' => $exportacion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="exportacion_delete")
     */
    public function delete(Request $request, Exportacion $exportacion): Response
    {
      try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($exportacion);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Eliminada satisfactoriamente la importación '.$exportacion.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('exportacion_index');
    }
    
     /**
     * Deletes all Exportaciones.
     *
     * @Route("/eliminar/todos/", name="exportaciones_delete_all")
     */
     public function deleteAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $exportacionesId = $request->request->get("exportaciones");
        try{
        if(!$exportacionesId){
           $this->get('session')->getFlashBag()->add('error', 'Seleccione una exportación.');
 }
        else{
            foreach($exportacionesId as $id)
        {
            $exportacion = $em->getRepository("App:Exportacion")->find($id);
            $em->remove($exportacion);
            $em->flush(); 
            }
            }
              $this->addFlash('success' , 'Exportacion(es) eliminadas satisfactoriamente.');
  
        }catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
       return $this->redirectToRoute('exportacion_index');
    } 
}
