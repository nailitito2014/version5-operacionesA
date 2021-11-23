<?php

namespace App\Controller;

use App\Entity\ImportaCubano;
use App\Form\ImportaCubanoType;
use App\Repository\ImportaCubanoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;

/**
 * @Route("/importa/cubano")
 */
class ImportaCubanoController extends AbstractController
{
    
    
   /**
     * @Route("/verExpediente/{id}", name="ver_expediente", methods={"GET"})
     */
    public function verExpediente(Expediente $expediente): Response
    {
        return $this->render('expediente/verExpediente.html.twig', [
            'expediente' => $expediente,
        ]);
    }
    
     
    /**
     * DESACTIVAR IMPORTACION CUBANA
     * 
     * @Route("/desactivar/importacionCubana/{id}/", name="desactivar_importacion_cubana")
     * @Method("GET")
     */
    public function desactivarImportacionCubanaAction(Request $request, $id )
    {
        $em = $this->getDoctrine()->getManager();
         
        $importacionCubana = $em->getRepository("App:ImportaCubano")->find($id);
        
        $importacionCubana->setFechaDesactivacion(new \DateTime('now'));
     
        $importacionCubana->setImportacionCubanaActiva(false);
        $em->persist($importacionCubana);
        $em->flush();
        
        $this->get('session')->getFlashBag()->add('success', 'La importación cubana ' . $importacionCubana . " fue desactivada satisfactoriamente". '.');
        
        return $this->redirectToRoute('importa_cubano_index');
    }    
    

   
    /**
     * @Route("/", name="importa_cubano_index", methods={"GET"})
     */
    public function index(ImportaCubanoRepository $importaCubanoRepository): Response
    {
        return $this->render('importa_cubano/index.html.twig', [
            'importa_cubanos' => $importaCubanoRepository->importacionesCubanasOrdenadasDESC(),
        ]);
    }

    /**
     * @Route("/new", name="importa_cubano_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $importaCubano = new ImportaCubano();
        $form = $this->createForm(ImportaCubanoType::class, $importaCubano);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $importacionesCubanas = $entityManager->getRepository("App:ImportaCubano")->findAll();
            $importaCubano->setNumeroImportacionCubano('ic_' . "" . sprintf('%02d', count($importacionesCubanas) + 1) ."_". date('Y'));
         
            
            $importaCubano->setFecha(new \DateTime('now'));
            $importaCubano->setFechaInsercion(new \DateTime('now'));
         
            
            $entityManager->persist($importaCubano);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Insertada satisfactoriamente la importación cubana '.$importaCubano.'.');


            return $this->redirectToRoute('importa_cubano_index');
        }

        return $this->render('importa_cubano/new.html.twig', [
            'importa_cubano' => $importaCubano,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="importa_cubano_show", methods={"GET"})
     */
    public function show(ImportaCubano $importaCubano): Response
    {
        return $this->render('importa_cubano/show.html.twig', [
            'importacionCubana' => $importaCubano,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="importa_cubano_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ImportaCubano $importaCubano): Response
    {
        $form = $this->createForm(ImportaCubanoType::class, $importaCubano);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success' , 'Modificada satisfactoriamente la importación cubana '.$importaCubano.'.');


            return $this->redirectToRoute('importa_cubano_index');
        }

        return $this->render('importa_cubano/edit.html.twig', [
            'importa_cubano' => $importaCubano,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="importa_cubano_delete")
     */
    public function delete(Request $request, ImportaCubano $importaCubano): Response
    {
         try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($importaCubano);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Eliminada satisfactoriamente la importación cubana '.$importaCubano.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('importa_cubano_index');
    }
    
    
    /**
     * Deletes all Importaciones Cubanas.
     *
     * @Route("/eliminar/todos/", name="importaciones_cubanas_delete_all")
     */
     public function deleteAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $importacionesCubanasId = $request->request->get("importacionesCubanas");
        try{
        if(!$importacionesCubanasId){
           $this->get('session')->getFlashBag()->add('error', 'Seleccione una importación cubana.');
 }
        else{
            foreach($importacionesCubanasId as $id)
        {
            $importacionCubana = $em->getRepository("App:ImportaCubano")->find($id);
            $em->remove($importacionCubana);
            $em->flush(); 
            }
            }
            $this->addFlash('success' , 'Importacion(es) eliminadas satisfactoriamente.');
             
        }catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
       return $this->redirectToRoute('importa_cubano_index');
    } 

}
