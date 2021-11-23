<?php

namespace App\Controller;

use App\Entity\Buque;
use App\Form\BuqueType;
use App\Repository\BuqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;
use Knp\Snappy\Pdf;

/**
 * @Route("/buque")
 */
class BuqueController extends AbstractController
{
    
    /**
     * DESACTIVAR  BUQUE
     * 
     * @Route("/desactivar/buque/{id}/", name="desactivar_buque")
     * @Method("GET")
     */
    public function desactivarBuqueAction(Request $request, $id )
    {
        $em = $this->getDoctrine()->getManager();
         
        $buque = $em->getRepository("App:Buque")->find($id);
        
        $buque->setFechaDesactivacion(new \DateTime('now'));
     
        $buque->setBuqueActivo(false);
        $em->persist($buque);
        $em->flush();
        
        $this->get('session')->getFlashBag()->add('success', 'El buque ' . $buque . " fue desactivado satisfactoriamente". '.');
        
        return $this->redirectToRoute('buque_index');
    } 
    
    /**
     * @Route("/exportarPdf/{id}", name="buque_pdf")
     * @Method("GET")
     */
    public function detalleBuqueAction(Request $request, Buque $buque)
    {
        $em = $this->getDoctrine()->getManager();
        
        $exportarPdf = $request->query->get('pdf');
  
           if($exportarPdf)
        {
            $snappy = new Pdf($this->container->getParameter('operacionesaduana.pathWkhtmltopdf'));
            
            $html =  $this->renderView('pdf/detalleBuquePDF.html.twig', array('buque' => $buque));
            
            return new Response(
                    $snappy->getOutputFromHtml($html, array('lowquality' => true,)),
                        200,  array(
                            'Content-Type'          => 'application/pdf',
                            'Content-Disposition'   => 'attachment; filename="BuqueDetalle.pdf"')
                );
        }
        return $this->render('buque/show.html.twig', array(
            'buque' => $buque,
        ));
    }

    /**
     * @Route("/", name="buque_index", methods={"GET"})
     */
    public function index(BuqueRepository $buqueRepository): Response
    {
        return $this->render('buque/index.html.twig', [
            'buques' => $buqueRepository->buquesOrdenadosDESC(),
        ]);
    }

    /**
     * @Route("/new", name="buque_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $buque = new Buque();
        $form = $this->createForm(BuqueType::class, $buque);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        
        
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
                 
         if ($form->isSubmitted())        
        {       
            $existeBuque = $entityManager->getRepository("App:Buque")->findByNombre($buque->getNombre());
            
            if(count($existeBuque) > 0)
                $form->get('nombre')->addError(new FormError("Ya existe un buque con este nombre."));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            
            $buque->setFecha(new \DateTime('now'));
            $buque->setFechaInsercion(new \DateTime('now'));
          
            
            $entityManager->persist($buque);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Insertado satisfactoriamente el buque '.$buque.'.');


            return $this->redirectToRoute('buque_index');
        }

        return $this->render('buque/new.html.twig', [
            'buque' => $buque,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="buque_show", methods={"GET"})
     */
    public function show(Buque $buque): Response
    {
        return $this->render('buque/show.html.twig', [
            'buque' => $buque,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="buque_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Buque $buque): Response
    {
        $form = $this->createForm(BuqueType::class, $buque);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success' , 'Modificado satisfactoriamente el buque '.$buque.'.');


            return $this->redirectToRoute('buque_index');
        }

        return $this->render('buque/edit.html.twig', [
            'buque' => $buque,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="buque_delete")
     */
    public function delete(Request $request, Buque $buque): Response
    {
        try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($buque);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Eliminado satisfactoriamente el buque '.$buque.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('buque_index');
    }
    
    /**
     * Deletes all Buques.
     *
     * @Route("/eliminar/todos/", name="buques_delete_all")
     */
     public function deleteAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $buquesId = $request->request->get("buques");
        try{
        if(!$buquesId){
           $this->get('session')->getFlashBag()->add('error', 'Seleccione un buque.');
 }
        else{
            foreach($buquesId as $id)
        {
            $buque = $em->getRepository("App:Buque")->find($id);
            $em->remove($buque);
            $em->flush(); 
            }
           
            }
             $this->get('session')->getFlashBag()->add('success', 'Buque(s) eliminados satisfactoriamente.');

        }catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
       return $this->redirectToRoute('buque_index');
    }
    
    
    
    
}
