<?php

namespace App\Controller;

use App\Entity\TipoContenedor;
use App\Form\TipoContenedorType;
use App\Repository\TipoContenedorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;

/**
 * @Route("/tipo/contenedor")
 */
class TipoContenedorController extends AbstractController
{
    /**
     * @Route("/", name="tipo_contenedor_index", methods={"GET"})
     */
    public function index(TipoContenedorRepository $tipoContenedorRepository): Response
    {
        return $this->render('tipo_contenedor/index.html.twig', [
            'tipo_contenedors' => $tipoContenedorRepository->tiposContenedoresOrdenadosDESC(),
        ]);
    }

    /**
     * @Route("/new", name="tipo_contenedor_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tipoContenedor = new TipoContenedor();
        $form = $this->createForm(TipoContenedorType::class, $tipoContenedor);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
              
                if ($form->isSubmitted())        
        {       
            $existeTipoContenedor = $entityManager->getRepository("App:TipoContenedor")->findByNombre($tipoContenedor->getNombre());
            
            if(count($existeTipoContenedor) > 0)
                $form->get('nombre')->addError(new FormError("Ya existe un tipo de contenedor con este nombre."));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            
            $tipoContenedor->setFecha(new \DateTime('now'));
            $tipoContenedor->setFechaInsercion(new \DateTime('now'));
         
            
            $entityManager->persist($tipoContenedor);
            $entityManager->flush();
            
            $this->addFlash('notice' , 'Insertado satisfactoriamente el tamaño de contenedor '.$tipoContenedor.'.');

            return $this->redirectToRoute('tipo_contenedor_index');
        }

        return $this->render('tipo_contenedor/new.html.twig', [
            'tipo_contenedor' => $tipoContenedor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tipo_contenedor_show", methods={"GET"})
     */
    public function show(TipoContenedor $tipoContenedor): Response
    {
        return $this->render('tipo_contenedor/show.html.twig', [
            'tipo_contenedor' => $tipoContenedor,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tipo_contenedor_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TipoContenedor $tipoContenedor): Response
    {
        $form = $this->createForm(TipoContenedorType::class, $tipoContenedor);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('notice' , 'Modificado satisfactoriamente el tamaño de contenedor '.$tipoContenedor.'.');

            return $this->redirectToRoute('tipo_contenedor_index');
        }

        return $this->render('tipo_contenedor/edit.html.twig', [
            'tipo_contenedor' => $tipoContenedor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("eliminar/{id}", name="tipo_contenedor_delete")
     */
    public function delete(Request $request, TipoContenedor $tipoContenedor): Response
    {
        try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tipoContenedor);
            $entityManager->flush();
            
            $this->addFlash('notice' , 'Eliminado satisfactoriamente el tamaño de contenedor '.$tipoContenedor.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('tipo_contenedor_index');
    }
    
    /**
     * Deletes all Tamaños de contenedor.
     *
     * @Route("/eliminar/todos/", name="tipos_contenedor_delete_all", methods={"GET","POST"})
     */
     public function deleteAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $tiposContenedorId = $request->request->get("tiposContenedor");
        try{
        if(!$tiposContenedorId){
           $this->get('session')->getFlashBag()->add('error', 'Seleccione un tamaño de contenedor.');
 }
        else{
            foreach($tiposContenedorId as $id)
        {
            $tipoContenedor = $em->getRepository("App:TipoContenedor")->find($id);
            $em->remove($tipoContenedor);
            $em->flush(); 
        }
              }
             $this->addFlash('success' , 'Tamaño(s) de contenedor eliminados satisfactoriamente.');
   
        }catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
       return $this->redirectToRoute('tipo_contenedor_index');
    }
}
