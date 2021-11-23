<?php

namespace App\Controller;

use App\Entity\TipoContrato;
use App\Form\TipoContratoType;
use App\Repository\TipoContratoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;

/**
 * @Route("/tipo/contrato")
 */
class TipoContratoController extends AbstractController
{
    /**
     * @Route("/", name="tipo_contrato_index", methods={"GET"})
     */
    public function index(TipoContratoRepository $tipoContratoRepository): Response
    {
        return $this->render('tipo_contrato/index.html.twig', [
            'tipo_contratos' => $tipoContratoRepository->tiposContratoOrdenadosDESC(),
        ]);
    }

    /**
     * @Route("/new", name="tipo_contrato_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tipoContrato = new TipoContrato();
        $form = $this->createForm(TipoContratoType::class, $tipoContrato);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
           
                 if ($form->isSubmitted())        
        {       
            $existeTipoContrato = $entityManager->getRepository("App:TipoContrato")->findByNombre($tipoContrato->getNombre());
            
            if(count($existeTipoContrato) > 0)
                $form->get('nombre')->addError(new FormError("Ya existe un tipo de contrato con este nombre."));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            
             $tipoContrato->setFecha(new \DateTime('now'));
            $tipoContrato->setFechaInsercion(new \DateTime('now'));   
           
            
            $entityManager->persist($tipoContrato);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Insertado satisfactoriamente el tipo de contrato '.$tipoContrato.'.');

            return $this->redirectToRoute('tipo_contrato_index');
        }

        return $this->render('tipo_contrato/new.html.twig', [
            'tipo_contrato' => $tipoContrato,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tipo_contrato_show", methods={"GET"})
     */
    public function show(TipoContrato $tipoContrato): Response
    {
        return $this->render('tipo_contrato/show.html.twig', [
            'tipo_contrato' => $tipoContrato,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tipo_contrato_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TipoContrato $tipoContrato): Response
    {
        $form = $this->createForm(TipoContratoType::class, $tipoContrato);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
           $this->addFlash('success' , 'Modificado satisfactoriamente el tipo de contrato '.$tipoContrato.'.');

            return $this->redirectToRoute('tipo_contrato_index');
        }

        return $this->render('tipo_contrato/edit.html.twig', [
            'tipo_contrato' => $tipoContrato,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="tipo_contrato_delete")
     */
    public function delete(Request $request, TipoContrato $tipoContrato): Response
    {
        try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tipoContrato);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Eliminado satisfactoriamente el tipo de contrato '.$tipoContrato.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('tipo_contrato_index');
    }
    
    /**
     * Deletes all Tipos de contrato.
     *
     * @Route("/eliminar/todos/", name="tipos_contrato_delete_all")
     */
     public function deleteAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $tiposContratoId = $request->request->get("tiposContrato");
        try{
        if(!$tiposContratoId){
           $this->get('session')->getFlashBag()->add('error', 'Seleccione un tipo de contrato.');
 }
        else{
            foreach($tiposContratoId as $id)
        {
            $tipoContrato = $em->getRepository("App:TipoContrato")->find($id);
            $em->remove($tipoContrato);
            $em->flush(); 
            }
         
            }
            $this->addFlash('success' , 'Tipo(s) de contrato eliminados satisfactoriamente.');
               
        }catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
       return $this->redirectToRoute('tipo_contrato_index');
    }  
       
    
}
