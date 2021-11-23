<?php

namespace App\Repository;

use App\Entity\Expediente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Expediente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Expediente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Expediente[]    findAll()
 * @method Expediente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExpedienteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Expediente::class);
    }
       public function expedientesOrdenadosDESC()
    {
        return $this->createQueryBuilder('e')
            //->andWhere('c.exampleField = :val')
            //->setParameter('val', $value)
            ->orderBy('e.fecha', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult();     
    }
         public function busquedaPorExpediente($nombre, $primerApellido, $segundoApellido, $numeroExpediente, $pies, $numeroMBL)
    {
        return $this->createQueryBuilder('e')
                
             //->join('c.pais', 'p')
             //->join('c.estadoCliente', 'ec')
                
             //->andWhere('p = :pais')
             //->orWhere('ec = :estadoCliente')
            
             ->andWhere('e.nombre LIKE :nombre')
             ->andWhere('e.primerApellido LIKE :primerApellido')
             ->andWhere('e.segundoApellido LIKE :segundoApellido')
             ->andWhere('e.bultos LIKE :bultos')
             ->andWhere('e.pesoKg LIKE :pesoKg')
             ->andWhere('e.pies LIKE :pies')
             ->andWhere('e.numeroMBL LIKE :numeroMBL')
           
                
                
             ->setParameter('nombre', '%' . $nombre . '%')
             ->setParameter('primerApellido', '%' . $primerApellido . '%')
             ->setParameter('segundoApellido', '%' . $segundoApellido . '%')
             ->setParameter('numeroExpediente', '%' . $numeroExpediente . '%')
             ->setParameter('pies', '%' . $pies . '%')
             ->setParameter('numeroMBL', '%' . $numeroMBL . '%')
                 
             //->setParameter('pais', $pais)
             //->setParameter('estadoCliente', $estadoCliente)
         
             //->orderBy('c.id', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Expediente[] Returns an array of Expediente objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Expediente
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
