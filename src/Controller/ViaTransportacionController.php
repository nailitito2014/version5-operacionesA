<?php

namespace App\Controller;

use App\Entity\ViaTransportacion;
use App\Form\ViaTransportacionType;
use App\Repository\ViaTransportacionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/via/transportacion")
 */
class ViaTransportacionController extends AbstractController
{
    /**
     * @Route("/", name="via_transportacion_index", methods={"GET"})
     */
    public function index(ViaTransportacionRepository $viaTransportacionRepository): Response
    {
        return $this->render('via_transportacion/index.html.twig', [
            'via_transportacions' => $viaTransportacionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="via_transportacion_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $viaTransportacion = new ViaTransportacion();
        $form = $this->createForm(ViaTransportacionType::class, $viaTransportacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($viaTransportacion);
            $entityManager->flush();

            return $this->redirectToRoute('via_transportacion_index');
        }

        return $this->render('via_transportacion/new.html.twig', [
            'via_transportacion' => $viaTransportacion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="via_transportacion_show", methods={"GET"})
     */
    public function show(ViaTransportacion $viaTransportacion): Response
    {
        return $this->render('via_transportacion/show.html.twig', [
            'via_transportacion' => $viaTransportacion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="via_transportacion_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ViaTransportacion $viaTransportacion): Response
    {
        $form = $this->createForm(ViaTransportacionType::class, $viaTransportacion);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('via_transportacion_index');
        }

        return $this->render('via_transportacion/edit.html.twig', [
            'via_transportacion' => $viaTransportacion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="via_transportacion_delete")
     */
    public function delete(Request $request, ViaTransportacion $viaTransportacion): Response
    {
         try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($viaTransportacion);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Eliminada satisfactoriamente la vía de transportación '.$viaTransportacion.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('via_transportacion_index');
    }
}
