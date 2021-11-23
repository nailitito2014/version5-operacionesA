<?php

namespace App\Controller;

use App\Entity\SolicitudServicio;
use App\Form\SolicitudServicioType;
use App\Repository\SolicitudServicioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/solicitud/servicio")
 */
class SolicitudServicioController extends AbstractController
{
    
    /**
     * DESACTIVAR SOLICITUD DE SERVICIO
     * 
     * @Route("/desactivar/SolicitudServicio/{id}/", name="desactivar_solicitud_servicio")
     * @Method("GET")
     */
    public function desactivarSolicitudServicioAction(Request $request, $id )
    {
        $em = $this->getDoctrine()->getManager();
         
        $solicitudServicio = $em->getRepository("App:SolicitudServicio")->find($id);
        
        $solicitudServicio->setFechaDesactivacion(new \DateTime('now'));
     
        $solicitudServicio->setSolicitudActiva(false);
        $em->persist($solicitudServicio);
        $em->flush();
        
        $this->get('session')->getFlashBag()->add('success', 'La solicitud de servicio ' . $solicitudServicio . " fue desactivada satisfactoriamente". '.');
        
        return $this->redirectToRoute('solicitud_servicio_index');
    }    
    
    /**
     * @Route("/", name="solicitud_servicio_index", methods={"GET"})
     */
    public function index(SolicitudServicioRepository $solicitudServicioRepository): Response
    {
        return $this->render('solicitud_servicio/index.html.twig', [
            'solicitud_servicios' => $solicitudServicioRepository->solicitudesServicioOrdenadasDESC(),
        ]);
    }

    /**
     * @Route("/new", name="solicitud_servicio_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $solicitudServicio = new SolicitudServicio();
        $form = $this->createForm(SolicitudServicioType::class, $solicitudServicio);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
      
         
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
           
           if ($form->isSubmitted())        
        {       
            $existeSolicitudServicio = $entityManager->getRepository("App:SolicitudServicio")->findByNumeroSolicitud($solicitudServicio->getNumeroSolicitud());
            if(count($existeSolicitudServicio) > 0)
               $form->get('numeroSolicitud')->addError(new FormError("Ya existe una solicitud de servicio con este número."));
        }
        if ($form->isSubmitted() && $form->isValid()) {
            
            $solicitudServicio->setFecha(new \DateTime('now'));
            $solicitudServicio->setFechaInsercion(new \DateTime('now'));   
            $solicitudServicio->setFechaSolicitud(new \DateTime('now'));
         
            $solicitudesServicio = $entityManager->getRepository("App:SolicitudServicio")->findAll();
            $solicitudServicio->setNumeroSolicitud('sctd_' . "" . sprintf('%02d', count($solicitudesServicio) + 1) ."_". date('Y'));
           
            
            $entityManager->persist($solicitudServicio);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Insertada satisfactoriamente la solicitud de servicio '.$solicitudServicio.'.');


            return $this->redirectToRoute('solicitud_servicio_index');
        }

        return $this->render('solicitud_servicio/new.html.twig', [
            'solicitud_servicio' => $solicitudServicio,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="solicitud_servicio_show", methods={"GET"})
     */
    public function show(SolicitudServicio $solicitudServicio): Response
    {
        return $this->render('solicitud_servicio/show.html.twig', [
            'solicitudServicio' => $solicitudServicio,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="solicitud_servicio_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SolicitudServicio $solicitudServicio): Response
    {
        $form = $this->createForm(SolicitudServicioType::class, $solicitudServicio);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
       
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success' , 'Modificada satisfactoriamente la solicitud de servicio '.$solicitudServicio.'.');

      
            return $this->redirectToRoute('solicitud_servicio_index');
        }

        return $this->render('solicitud_servicio/edit.html.twig', [
            'solicitud_servicio' => $solicitudServicio,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="solicitud_servicio_delete")
     */
    public function delete(Request $request, SolicitudServicio $solicitudServicio): Response
    {
        try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($solicitudServicio);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Eliminada satisfactoriamente la solicitud de servicio '.$solicitudServicio.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('solicitud_servicio_index');
    }
    /**
     * Desactivar all Solicitudes de servicio.
     *
     * @Route("/desactivar/solicitudesServicio/", name="solicitudes_servicio_desactivar_todas")
     */
     public function deleteAllAction(Request $request, SolicitudServicio $solicitudServicio)
    {
        $em = $this->getDoctrine()->getManager();
        
        $solicitudesServicioId = $request->request->get("solicitudesServicio");
        try{
        if(!$solicitudesServicioId){
           $this->get('session')->getFlashBag()->add('error', 'Seleccione una solicitud de servicio.');
 }
        else{
            foreach($solicitudesServicioId as $id)
        {
            $solicitudServicio = $em->getRepository("App:SolicitudServicio")->find($id);
             $em->remove($solicitudServicio);
            $em->flush();
            //$solicitudServicio->setSolicitudActiva(true);
            //$solicitudServicio->setFechaDesactivacion(new \DateTime('now'));
            
            //$em->remove($solicitudServicio);
            $em->flush(); 
            }
            }
           $this->get('session')->getFlashBag()->add('success', 'Solicitud(es) eliminadas satisfactoriamente.');  
        }catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
       return $this->redirectToRoute('solicitud_servicio_index');
    }  
    
    
    
    
    
    
    
}
