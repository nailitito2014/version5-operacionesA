<?php

namespace App\Controller;

use App\Entity\Provincia;
use App\Form\ProvinciaType;
use App\Repository\ProvinciaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;

/**
 * @Route("/provincia")
 */
class ProvinciaController extends AbstractController
{
    /**
     * @Route("/", name="provincia_index", methods={"GET"})
     */
    public function index(ProvinciaRepository $provinciaRepository): Response
    {
        return $this->render('provincia/index.html.twig', [
            'provincias' => $provinciaRepository->provinciasOrdenadasDESC(),
        ]);
    }

    /**
     * @Route("/new", name="provincia_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $provincium = new Provincia();
        $form = $this->createForm(ProvinciaType::class, $provincium);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
            
           if ($form->isSubmitted())        
        {       
            $existeProvincia = $entityManager->getRepository("App:Provincia")->findByNombre($provincium->getNombre());
            
            if(count($existeProvincia) > 0)
                $form->get('nombre')->addError(new FormError("Ya existe una provincia con este nombre."));
        }


        if ($form->isSubmitted() && $form->isValid()) {
            
            $provincium->setFecha(new \DateTime('now'));
            $provincium->setFechaInsercion(new \DateTime('now'));
         
            
            $entityManager->persist($provincium);
            $entityManager->flush();
          
            $this->addFlash('success' , 'Insertada satisfactoriamente la provincia '.$provincium.'.');

           return $this->redirectToRoute('provincia_index');
        }

        return $this->render('provincia/new.html.twig', [
            'provincium' => $provincium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="provincia_show", methods={"GET"})
     */
    public function show(Provincia $provincium): Response
    {
        return $this->render('provincia/show.html.twig', [
            'provincium' => $provincium,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="provincia_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Provincia $provincium): Response
    {
        $form = $this->createForm(ProvinciaType::class, $provincium);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
      
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success' , 'Modificada satisfactoriamente la provincia '.$provincium.'.');


            return $this->redirectToRoute('provincia_index');
        }

        return $this->render('provincia/edit.html.twig', [
            'provincium' => $provincium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="provincia_delete")
     */
    public function delete(Request $request, Provincia $provincium): Response
    {
       try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($provincium);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Eliminada satisfactoriamente la provincia'.$provincium.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('provincia_index');
    }
    
     /**
     * Deletes all Provincias.
     *
     * @Route("/eliminar/todos/", name="provincias_delete_all")
     */
     public function deleteAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $provinciasId = $request->request->get("provincias");
        try{
        if(!$provinciasId){
           $this->get('session')->getFlashBag()->add('error', 'Seleccione una provincia.');
 }
        else{
            foreach($provinciasId as $id)
        {
            $pais = $em->getRepository("App:Provincia")->find($id);
            $em->remove($provincia);
            $em->flush(); 
            }
             $this->get('session')->getFlashBag()->add('notice', 'Provincia(s) eliminadas satisfactoriamente.');

            }
              $this->get('session')->getFlashBag()->add('notice', 'Provincia(s) eliminadas satisfactoriamente.');

        }catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
       return $this->redirectToRoute('provincia_index');
    }  
}
