<?php

namespace App\Controller;

use App\Entity\Expediente;
use App\Form\ExpedienteType;
use App\Repository\ExpedienteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;

/**
 * @Route("/expediente")
 */
class ExpedienteController extends AbstractController
{
    
        private function getUploadsDirCertificosInmigracion() {             
        return __DIR__.'/../../public/uploads/documentosExpedientes/certificosInmigracion';
    }
    
       private function getUploadsDirFranquiciasDiplomaticas() {             
        return __DIR__.'/../../public/uploads/documentosExpedientes/franquiciasDiplomaticas';
    }
    
       private function getUploadsDirCartasOriginales() {             
        return __DIR__.'/../../public/uploads/documentosExpedientes/cartasOriginales';
    }
      private function getUploadsDirDesglose() {             
        return __DIR__.'/../../public/uploads/documentosExpedientes/desgloses';
    }
    private function getUploadsDirManifiesto() {             
        return __DIR__.'/../../public/uploads/documentosExpedientes/manifiestos';
    }
    
    /**
     * @Route("/", name="expediente_index", methods={"GET"})
     */
    public function index(ExpedienteRepository $expedienteRepository): Response
    {
        return $this->render('expediente/index.html.twig', [
            'expedientes' => $expedienteRepository->expedientesOrdenadosDESC(),
        ]);
    }

    /**
     * @Route("/new", name="expediente_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $expediente = new Expediente();
        $form = $this->createForm(ExpedienteType::class, $expediente);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
            
         if ($form->isSubmitted())        
        {       
            $existeExpediente = $entityManager->getRepository("App:Expediente")->findByNumeroExpediente($expediente->getNumeroExpediente());
            if(count($existeExpediente) > 0)
               $form->get('numeroExpediente')->addError(new FormError("Ya existe un expediente con este número."));
        }

        if ($form->isSubmitted() && $form->isValid()) {
           
           $expedientes = $entityManager->getRepository("App:Expediente")->findAll();
           $expediente->setNumeroExpediente('exp_' . "" . sprintf('%02d', count($expedientes) + 1) ."_". date('Y'));
               
            $expediente->setFecha(new \DateTime('now'));
            $expediente->setFechaInsercion(new \DateTime('now'));
            $expediente->setFechaCreacionExpediente(new \DateTime('now'));
          
           
           $nameCertificoInmigracion =  $expediente->getNumeroExpediente() . '_CertificoInmigracion' . '.' . $expediente->getCertificoInmigracionFile()->getClientOriginalExtension();                
           $nameFranquiciaDiplomatica =  $expediente->getNumeroExpediente() . '_FranquiciaDiplomatica' .  '.' . $expediente->getFranquiciaDiplomaticaFile()->getClientOriginalExtension();                
           $nameDesglose =  $expediente->getNumeroExpediente() . '_Desglose' . '.' . $expediente->getDesgloseFile()->getClientOriginalExtension();                
           $nameManifiesto =  $expediente->getNumeroExpediente() . '_Manifiesto'. '.' . $expediente->getManifiestoFile()->getClientOriginalExtension();                
           $nameCartaOriginal =  $expediente->getNumeroExpediente() . '_CartaOriginal'. '.' . $expediente->getCartaOriginalFile()->getClientOriginalExtension();                
          
           $expediente->setCertificoInmigracion($nameCertificoInmigracion);  
           $expediente->setFranquiciaDiplomatica($nameFranquiciaDiplomatica);  
           $expediente->setDesglose($nameDesglose);  
           $expediente->setManifiesto($nameManifiesto);  
           $expediente->setCartaOriginal($nameCartaOriginal);  
          
           
           $expediente->getCertificoInmigracionFile()->move($this->getUploadsDirCertificosInmigracion(), $nameCertificoInmigracion);
           $expediente->getFranquiciaDiplomaticaFile()->move($this->getUploadsDirFranquiciasDiplomaticas(), $nameFranquiciaDiplomatica);
           $expediente->getDesgloseFile()->move($this->getUploadsDirDesglose(), $nameDesglose);
           $expediente->getManifiestoFile()->move($this->getUploadsDirManifiesto(), $nameManifiesto);
           $expediente->getCartaOriginalFile()->move($this->getUploadsDirCartasOriginales(), $nameCartaOriginal);
       
            //$importacion = $expediente->setImportacionCubano($expediente->getImportacionCubano());  
            //$problemaInvestigacion->setNumeroProblemaInvestigacion(date('y') . "" . sprintf('%02d', count($problemasInvestigacion) + 1));
              
            $entityManager->persist($expediente);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Insertado satisfactoriamente el expediente '.$expediente.'.');


            return $this->redirectToRoute('expediente_index');
        }

        return $this->render('expediente/new.html.twig', [
            'expediente' => $expediente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="expediente_show", methods={"GET"})
     */
    public function show(Expediente $expediente): Response
    {
        return $this->render('expediente/show.html.twig', [
            'expediente' => $expediente,
        ]);
    }
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
     * @Route("/{id}/edit", name="expediente_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Expediente $expediente): Response
    {
        $form = $this->createForm(ExpedienteType::class, $expediente);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
      
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
                if (!is_null($expediente->getCertificoInmigracionFile())) {
                @unlink($this->getUploadsDirCertificosInmigracion() . "/" . $expediente->getCertificoInmigracion());
                $nameCertificoInmigracion =  $expediente->getNumeroExpediente() . '_CertificoInmigracion' . '.' . $expediente->getCertificoInmigracionFile()->getClientOriginalExtension();                
         
                
                $expediente->setCertificoInmigracion($nameCertificoInmigracion);
                $expediente->getCertificoInmigracionFile()->move($this->getUploadsDirCertificosInmigracion(), $nameCertificoInmigracion);                
            }
            
            
            
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success' , 'Modificado satisfactoriamente el expediente '.$expediente.'.');
 

            return $this->redirectToRoute('expediente_index');
        }

        return $this->render('expediente/edit.html.twig', [
            'expediente' => $expediente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="expediente_delete")
     */
    public function delete(Request $request, Expediente $expediente): Response
    {
       try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($expediente);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Eliminado satisfactoriamente el expediente '.$expediente.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('expediente_index');
    }
    
    /**
     * Deletes all Expedientes.
     *
     * @Route("/eliminar/todos/", name="expedientes_delete_all")
     */
     public function deleteAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $expedientesId = $request->request->get("expedientes");
        try{
        if(!$expedientesId){
           $this->get('session')->getFlashBag()->add('error', 'Seleccione un expediente.');
 }
        else{
            foreach($expedienteId as $id)
        {
            $expediente = $em->getRepository("App:Expediente")->find($id);
            $em->remove($expediente);
            $em->flush(); 
            }
            }
             $this->get('session')->getFlashBag()->add('success', 'Expediente(s) eliminados satisfactoriamente.');
        }catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
       return $this->redirectToRoute('expediente_index');
    }
    
    
    
    
    
}
