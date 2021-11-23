<?php

namespace App\Controller;

use App\Entity\CondicionCompra;
use App\Form\CondicionCompraType;
use App\Repository\CondicionCompraRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/condicion/compra")
 */
class CondicionCompraController extends AbstractController
{
    /**
     * @Route("/", name="condicion_compra_index", methods={"GET"})
     */
    public function index(CondicionCompraRepository $condicionCompraRepository): Response
    {
        return $this->render('condicion_compra/index.html.twig', [
            'condicion_compras' => $condicionCompraRepository->condicionesCompraOrdenadosDESC(),
        ]);
    }

    /**
     * @Route("/new", name="condicion_compra_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $condicionCompra = new CondicionCompra();
        $form = $this->createForm(CondicionCompraType::class, $condicionCompra);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
            
                 if ($form->isSubmitted())        
        {       
            $existeCondicionCompra = $entityManager->getRepository("App:CondicionCompra")->findByNombre($condicionCompra->getNombre());
            
            if(count($existeCondicionCompra) > 0)
                $form->get('nombre')->addError(new FormError("Ya existe una condición  de compra con este nombre."));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            
            $condicionCompra->setFecha(new \DateTime('now'));
            $condicionCompra->setFechaInsercion(new \DateTime('now'));
           
            $entityManager->persist($condicionCompra);
            $entityManager->flush();
            
            
            $this->addFlash('success' , 'Insertada satisfactoriamente la condición de compra '.$condicionCompra.'.');


            return $this->redirectToRoute('condicion_compra_index');
        }

        return $this->render('condicion_compra/new.html.twig', [
            'condicion_compra' => $condicionCompra,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="condicion_compra_show", methods={"GET"})
     */
    public function show(CondicionCompra $condicionCompra): Response
    {
        return $this->render('condicion_compra/show.html.twig', [
            'condicion_compra' => $condicionCompra,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="condicion_compra_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CondicionCompra $condicionCompra): Response
    {
        $form = $this->createForm(CondicionCompraType::class, $condicionCompra);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
           $this->addFlash('success' , 'Modificada satisfactoriamente la condición de compra '.$condicionCompra.'.');

            return $this->redirectToRoute('condicion_compra_index');
        }

        return $this->render('condicion_compra/edit.html.twig', [
            'condicion_compra' => $condicionCompra,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("eliminar/{id}", name="condicion_compra_delete")
     */
    public function delete(Request $request, CondicionCompra $condicionCompra): Response
    {
        try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($condicionCompra);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Eliminada satisfactoriamente la condición de compra '.$condicionCompra.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('condicion_compra_index');
    }
    /**
     * Deletes all Condiciones de compra.
     * @Route("/eliminar/todos/", name="condiciones_compra_delete_all", methods={"GET","POST"})
     */
     public function deleteAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $condicionesCompraId = $request->request->get("condicionesCompra");
        try{
        if(!$condicionesCompraId){
           $this->get('session')->getFlashBag()->add('error', 'Seleccione una condición de compra.');
 }
        else{
            foreach($condicionesCompraId as $id)
        {
            $condicionCompra = $em->getRepository("App:CondicionCompra")->find($id);
            $em->remove($condicionCompra);
            $em->flush(); 
            }
             $this->get('session')->getFlashBag()->add('notice', 'Condicion(es) de compra eliminadas satisfactoriamente.');

            }
        }catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
       return $this->redirectToRoute('condicion_compra_index');
    }
}
