<?php

namespace App\Controller;

use App\Entity\TipoMoneda;
use App\Form\TipoMonedaType;
use App\Repository\TipoMonedaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tipo/moneda")
 */
class TipoMonedaController extends AbstractController
{
    /**
     * @Route("/", name="tipo_moneda_index", methods={"GET"})
     */
    public function index(TipoMonedaRepository $tipoMonedaRepository): Response
    {
        return $this->render('tipo_moneda/index.html.twig', [
            'tipo_monedas' => $tipoMonedaRepository->tiposMonedasOrdenadasDESC(),
        ]);
    }

    /**
     * @Route("/new", name="tipo_moneda_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tipoMoneda = new TipoMoneda();
        $form = $this->createForm(TipoMonedaType::class, $tipoMoneda);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
           
        
               if ($form->isSubmitted())        
        {       
            $existeTipoMoneda = $entityManager->getRepository("App:TipoMoneda")->findByNombre($tipoMoneda->getNombre());
            
            if(count($existeTipoMoneda) > 0)
                $form->get('nombre')->addError(new FormError("Ya existe un tipo de moneda con este nombre."));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            
            $tipoMoneda->setFecha(new \DateTime('now'));
            $tipoMoneda->setFechaInsercion(new \DateTime('now'));
         
            
            $entityManager->persist($tipoMoneda);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Insertado satisfactoriamente el tipo de moneda '.$tipoMoneda.'.');


            return $this->redirectToRoute('tipo_moneda_index');
        }

        return $this->render('tipo_moneda/new.html.twig', [
            'tipo_moneda' => $tipoMoneda,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tipo_moneda_show", methods={"GET"})
     */
    public function show(TipoMoneda $tipoMoneda): Response
    {
        return $this->render('tipo_moneda/show.html.twig', [
            'tipo_moneda' => $tipoMoneda,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tipo_moneda_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TipoMoneda $tipoMoneda): Response
    {
        $form = $this->createForm(TipoMonedaType::class, $tipoMoneda);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
       $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success' , 'Modificado satisfactoriamente el tipo de moneda '.$tipoMoneda.'.');

            return $this->redirectToRoute('tipo_moneda_index');
        }

        return $this->render('tipo_moneda/edit.html.twig', [
            'tipo_moneda' => $tipoMoneda,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="tipo_moneda_delete")
     */
    public function delete(Request $request, TipoMoneda $tipoMoneda): Response
    {
          try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tipoMoneda);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Eliminado satisfactoriamente el tipo de moneda '.$tipoMoneda.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('tipo_moneda_index');
    }
    
    /**
     * Deletes all Tipos de Moneda.
     *
     * @Route("/eliminar/todos/", name="tipos_moneda_delete_all")
     */
     public function deleteAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $tiposMonedaId = $request->request->get("tiposMoneda");
        try{
        if(!$tiposMonedaId){
           $this->get('session')->getFlashBag()->add('error', 'Seleccione un tipo de moneda.');
 }
        else{
            foreach($tiposMonedaId as $id)
        {
            $tipoMoneda = $em->getRepository("App:TipoMoneda")->find($id);
            $em->remove($tipoMoneda);
            $em->flush(); 
            }
            }
             $this->addFlash('success' , 'Tipo(s) de moneda eliminadas satisfactoriamente.');
          
        }catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
       return $this->redirectToRoute('tipo_moneda_index');
    } 
    
}
