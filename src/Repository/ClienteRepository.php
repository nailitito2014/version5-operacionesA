<?php

namespace App\Repository;

use App\Entity\Cliente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cliente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cliente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cliente[]    findAll()
 * @method Cliente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClienteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cliente::class);
    }
    
         public function busquedaPorFactura($numero , $monto, $cliente, $centroCosto, $fechaInsercion)
    {
        $em = $this->getEntityManager();
        
        $centroCostoSql = $centroCosto ? ' AND cc = :centroCosto' : ' ';
        $clienteSql = $cliente ? ' AND cl = :cliente' : ' ';
        $fechaInsercionSql = $fechaInsercion ? ' AND f.fechaInsercion =:fechaInsercion' : ' ';
         
        $sql = 'SELECT f FROM GestionBundle:Factura f JOIN f.centroCosto cc JOIN f.cliente cl'.
                ' WHERE f.numero LIKE :numero AND f.monto LIKE :monto'
              . $centroCostoSql.$clienteSql.$fechaInsercionSql;
                        
        $consulta = $em->createQuery($sql);
        
        $consulta->setParameter("numero", '%' . $numero . '%');
        $consulta->setParameter("monto", '%' . $monto . '%');
       
        if($centroCosto)
        {
            $consulta->setParameter('centroCosto', $centroCosto);
        } 
        
        if($cliente)
        {
            $consulta->setParameter('cliente', $cliente);
        } 
         if($fechaInsercion)
        {
            $consulta->setParameter('fechaInsercion', $fechaInsercion);
        } 
     
        return $consulta->getResult();
    } 
     public function busquedaPorCliente($nombre, $primerApellido, $segundoApellido,$pasaporte, $carnetIdentidad)
    {
        return $this->createQueryBuilder('c')
                
             //->join('c.pais', 'p')
             //->join('c.estadoCliente', 'ec')
                
            // ->andWhere('p = :pais')
             //->orWhere('ec = :estadoCliente')
            
             ->andWhere('c.nombre LIKE :nombre')
             ->andWhere('c.primerApellido LIKE :primerApellido')
             ->andWhere('c.segundoApellido LIKE :segundoApellido')
             ->andWhere('c.pasaporte LIKE :pasaporte')
            ->andWhere('c.carnetIdentidad LIKE :carnetIdentidad')
           
             ->setParameter('nombre', '%' . $nombre . '%')
             ->setParameter('primerApellido', '%' . $primerApellido . '%')
             ->setParameter('segundoApellido', '%' . $segundoApellido . '%')
                 ->setParameter('pasaporte', '%' . $pasaporte . '%')
                 ->setParameter('carnetIdentidad', '%' . $carnetIdentidad . '%')
             //->setParameter('pais', $pais)
             //->setParameter('estadoCliente', $estadoCliente)
         
             //->orderBy('c.id', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Cliente[] Returns an array of Cliente objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
       public function clientesOrdenadosDESC()
    {
        return $this->createQueryBuilder('c')
            //->andWhere('c.exampleField = :val')
            //->setParameter('val', $value)
            ->orderBy('c.fecha', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult();     
    }

    /*
    public function findOneBySomeField($value): ?Cliente
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    
}
