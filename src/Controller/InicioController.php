<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;
use App\Entity\SolicitudServicio;
use App\Entity\Importacion;
use App\Entity\Exportacion;
use App\Entity\ImportaCubano;



use Knp\Snappy\Pdf;

/**
 * @Route("/inicio")
 */
class InicioController extends AbstractController
{
 
    /**
     * @Route("/", name="inicio_index", methods={"GET"})
     */
    public function inicio(): Response
    {
      
        $entityManager = $this->getDoctrine()->getManager();
       
        $solicitudesServicio = count($entityManager->getRepository("App:SolicitudServicio")->findAll());
        $serviciosImportacionExtranjera = count($entityManager->getRepository("App:Exportacion")->findAll());
        $serviciosImportacionCubanos = count($entityManager->getRepository("App:ImportaCubano")->findAll());
        $serviciosImportacion = count($entityManager->getRepository("App:Importacion")->findAll());
           
        
        
        
        
        return $this->render('inicio/index.html.twig', [
            'solicitudesServicio' => $solicitudesServicio,
            'serviciosImportacionExtranjera' => $serviciosImportacionExtranjera,
            'serviciosImportacionCubanos' => $serviciosImportacionCubanos,
            'serviciosImportacion' => $serviciosImportacion
        ]);
    }   
    
}
