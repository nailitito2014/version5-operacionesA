<?php

namespace App\Repository;

use App\Entity\EstadoServicio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EstadoServicio|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstadoServicio|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstadoServicio[]    findAll()
 * @method EstadoServicio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadoServicioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstadoServicio::class);
    }
       public function estadosServicioOrdenadosDESC()
    {
        return $this->createQueryBuilder('c')
            //->andWhere('c.exampleField = :val')
            //->setParameter('val', $value)
            ->orderBy('c.fecha', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult();     
    }

    // /**
    //  * @return EstadoServicio[] Returns an array of EstadoServicio objects
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
    public function findOneBySomeField($value): ?EstadoServicio
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
