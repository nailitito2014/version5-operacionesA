<?php

namespace App\Controller;

use App\Entity\Contrato;
use App\Form\ContratoType;
use App\Repository\ContratoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;

/**
 * @Route("/contrato")
 */
class ContratoController extends AbstractController
{
    /**
     * @Route("/", name="contrato_index", methods={"GET"})
     */
    public function index(ContratoRepository $contratoRepository): Response
    {
        return $this->render('contrato/index.html.twig', [
            'contratos' => $contratoRepository->contratosOrdenadosDESC(),
        ]);
    }

    /**
     * @Route("/new", name="contrato_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $contrato = new Contrato();
        $form = $this->createForm(ContratoType::class, $contrato);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        
        
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
           
            if ($form->isSubmitted())        
        {       
            $existeContrato = $entityManager->getRepository("App:Contrato")->findByNumeroContrato($contrato->getNumeroContrato());
            if(count($existeContrato) > 0)
                $form->get('numeroContrato')->addError(new FormError("Ya existe un contrato con este número de contrato."));
        }

        if ($form->isSubmitted() && $form->isValid()) {
          
            $contrato->setFecha(new \DateTime('now'));
            $contrato->setFechaInsercion(new \DateTime('now'));
             
            
            $entityManager->persist($contrato);
            $entityManager->flush();
            
           $this->addFlash('success' , 'Insertado satisfactoriamente el contrato '.$contrato.'.');


            return $this->redirectToRoute('contrato_index');
        }

        return $this->render('contrato/new.html.twig', [
            'contrato' => $contrato,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contrato_show", methods={"GET"})
     */
    public function show(Contrato $contrato): Response
    {
        return $this->render('contrato/show.html.twig', [
            'contrato' => $contrato,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="contrato_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Contrato $contrato): Response
    {
        $form = $this->createForm(ContratoType::class, $contrato);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success' , ',Modificado satisfactoriamente el contrato '.$contrato.'.');


            return $this->redirectToRoute('contrato_index');
        }

        return $this->render('contrato/edit.html.twig', [
            'contrato' => $contrato,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="contrato_delete")
     */
    public function delete(Request $request, Contrato $contrato): Response
    {
      try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contrato);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Eliminado satisfactoriamente el contrato '.$contrato.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('contrato_index');
    }

    /**
     * Deletes all Contratos
     *
     * @Route("/eliminar/todos/", name="contratos_delete_all")
     */
     public function deleteAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $contratosId = $request->request->get("contratos");
        
        try{
        if(!$contratosId){
           $this->get('session')->getFlashBag()->add('error', 'Seleccione un contrato.');
 }
        else{
            foreach($contratosId as $id)
        {
            $contrato = $em->getRepository("App:Contrato")->find($id);
            $em->remove($contrato);
            $em->flush(); 
        }
              }
             $this->get('session')->getFlashBag()->add('success', 'Contrato(s) eliminados satisfactoriamente.');

        }catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
       return $this->redirectToRoute('contrato_index');
    }
}
