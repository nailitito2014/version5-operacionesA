<?php

namespace App\Controller;

use App\Entity\RectificacionDesgloseManifiesto;
use App\Form\RectificacionDesgloseManifiestoType;
use App\Repository\RectificacionDesgloseManifiestoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rectificacion/desglose/manifiesto")
 */
class RectificacionDesgloseManifiestoController extends AbstractController
{
    /**
     * @Route("/", name="rectificacion_desglose_manifiesto_index", methods={"GET"})
     */
    public function index(RectificacionDesgloseManifiestoRepository $rectificacionDesgloseManifiestoRepository): Response
    {
        return $this->render('rectificacion_desglose_manifiesto/index.html.twig', [
            'rectificacion_desglose_manifiestos' => $rectificacionDesgloseManifiestoRepository->rectificacionesDesgloseManifiestoOrdenadasDESC(),
        ]);
    }

    /**
     * @Route("/new", name="rectificacion_desglose_manifiesto_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $rectificacionDesgloseManifiesto = new RectificacionDesgloseManifiesto();
        $form = $this->createForm(RectificacionDesgloseManifiestoType::class, $rectificacionDesgloseManifiesto);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
      
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $rectificacionDesgloseManifiesto->setFecha(new \DateTime('now'));
            $rectificacionDesgloseManifiesto->setFechaInsercion(new \DateTime('now'));
           
            $rectificacionesDesglosesManifiesto = $entityManager->getRepository("App:RectificacionDesgloseManifiesto")->findAll();
            $rectificacionDesgloseManifiesto->setNumeroRectificacionDesglose('rdmfto_' . "" . sprintf('%02d', count($rectificacionesDesglosesManifiesto) + 1) ."_". date('Y'));   
            
            
            
            $rectificacionDesgloseManifiesto->setFechaCreacionRectificacion(new \DateTime('now'));
                    
            $entityManager->persist($rectificacionDesgloseManifiesto);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Insertada satisfactoriamente la rectificación de desglose de manifiesto '.$rectificacionDesgloseManifiesto.'.');

            return $this->redirectToRoute('rectificacion_desglose_manifiesto_index');
        }

        return $this->render('rectificacion_desglose_manifiesto/new.html.twig', [
            'rectificacion_desglose_manifiesto' => $rectificacionDesgloseManifiesto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rectificacion_desglose_manifiesto_show", methods={"GET"})
     */
    public function show(RectificacionDesgloseManifiesto $rectificacionDesgloseManifiesto): Response
    {
        return $this->render('rectificacion_desglose_manifiesto/show.html.twig', [
            'rectificacionDesgloseManifiesto' => $rectificacionDesgloseManifiesto,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rectificacion_desglose_manifiesto_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RectificacionDesgloseManifiesto $rectificacionDesgloseManifiesto): Response
    {
        $form = $this->createForm(RectificacionDesgloseManifiestoType::class, $rectificacionDesgloseManifiesto);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
      
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success' , 'Modificada satisfactoriamente la rectificación de desglose de manifiesto '.$rectificacionDesgloseManifiesto.'.');

            return $this->redirectToRoute('rectificacion_desglose_manifiesto_index');
        }

        return $this->render('rectificacion_desglose_manifiesto/edit.html.twig', [
            'rectificacion_desglose_manifiesto' => $rectificacionDesgloseManifiesto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rectificacion_desglose_manifiesto_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RectificacionDesgloseManifiesto $rectificacionDesgloseManifiesto): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rectificacionDesgloseManifiesto->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rectificacionDesgloseManifiesto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rectificacion_desglose_manifiesto_index');
    }
}
