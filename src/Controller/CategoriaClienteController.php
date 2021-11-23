<?php

namespace App\Controller;

use App\Entity\CategoriaCliente;
use App\Form\CategoriaClienteType;
use App\Repository\CategoriaClienteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;
use Knp\Snappy\Pdf;

/**
 * @Route("/categoria/cliente")
 */
class CategoriaClienteController extends AbstractController
{
    /**
     * @Route("/", name="categoria_cliente_index", methods={"GET"})
     */
    public function index(CategoriaClienteRepository $categoriaClienteRepository): Response
    {
        return $this->render('categoria_cliente/index.html.twig', [
            'categoria_clientes' => $categoriaClienteRepository->categoriaClientesOrdenadosDESC(),
        ]);
    }

    /**
     * @Route("/new", name="categoria_cliente_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categoriaCliente = new CategoriaCliente();
        $form = $this->createForm(CategoriaClienteType::class, $categoriaCliente);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
        
                 if ($form->isSubmitted())        
        {       
            $existeCategoriaCliente = $entityManager->getRepository("App:CategoriaCliente")->findByNombre($categoriaCliente->getNombre());
            
            if(count($existeCategoriaCliente) > 0)
                $form->get('nombre')->addError(new FormError("Ya existe una categoría de cliente con este nombre."));
        }
          
        if ($form->isSubmitted() && $form->isValid()) {
     
            $categoriaCliente->setFecha(new \DateTime('now'));
            $categoriaCliente->setFechaInsercion(new \DateTime('now'));
          
            $entityManager->persist($categoriaCliente);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Insertada satisfactoriamente la categoría de cliente '.$categoriaCliente.'.');
 

            return $this->redirectToRoute('categoria_cliente_index');
        }

        return $this->render('categoria_cliente/new.html.twig', [
            'categoria_cliente' => $categoriaCliente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="categoria_cliente_show", methods={"GET"})
     */
    public function show(CategoriaCliente $categoriaCliente): Response
    {
        return $this->render('categoria_cliente/show.html.twig', [
            'categoria_cliente' => $categoriaCliente,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="categoria_cliente_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CategoriaCliente $categoriaCliente): Response
    {
        $form = $this->createForm(CategoriaClienteType::class, $categoriaCliente);
        $form->add('Guardar', 'Symfony\Component\Form\Extension\Core\Type\SubmitType', array('attr' => ['class'  => 'btn btn-primary']));
     
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $categoriaCliente->setFecha(new \DateTime('now'));
            $categoriaCliente->setFechaInsercion(new \DateTime('now'));
          
            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash('success' , 'Modificada satisfactoriamente la categoría de cliente '.$categoriaCliente.'.');


            return $this->redirectToRoute('categoria_cliente_index');
        }

        return $this->render('categoria_cliente/edit.html.twig', [
            'categoria_cliente' => $categoriaCliente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="categoria_cliente_delete")
     */
    public function delete(Request $request, CategoriaCliente $categoriaCliente): Response
    {
     try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categoriaCliente);
            $entityManager->flush();
            
            $this->addFlash('success' , 'Eliminada satisfactoriamente la categoría de cliente '.$categoriaCliente.'.');
  
        }
    catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
             return $this->redirectToRoute('categoria_cliente_index');
    }
     /**
     * Deletes all Categorias Clientes.
     *
     * @Route("/eliminar/todos/", name="categorias_cliente_delete_all")
     */
     public function deleteAllAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $categoriasClienteId = $request->request->get("categoriasClientes");
        try{
        if(!$categoriasClienteId){
           $this->get('session')->getFlashBag()->add('error', 'Seleccione una categoría de cliente.');
 }
        else{
            foreach($categoriasClienteId as $id)
        {
            $categoriaCliente = $em->getRepository("App:CategoriaCliente")->find($id);
            $em->remove($categoriaCliente);
            $em->flush(); 
            }
           
            }
             $this->get('session')->getFlashBag()->add('success', 'Categoria(s) eliminadas satisfactoriamente.');

        }catch(\Exception $exc){
                
                 $this->get('session')->getFlashBag()->add('error', 'No se puede eliminar, se encuentra en uso.');
                
            }
       return $this->redirectToRoute('categoria_cliente_index');
    }
    
    
    
    
}
