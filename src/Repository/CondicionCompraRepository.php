<?php

namespace App\Repository;

use App\Entity\CondicionCompra;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CondicionCompra|null find($id, $lockMode = null, $lockVersion = null)
 * @method CondicionCompra|null findOneBy(array $criteria, array $orderBy = null)
 * @method CondicionCompra[]    findAll()
 * @method CondicionCompra[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CondicionCompraRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CondicionCompra::class);
    }
        public function condicionesCompraOrdenadosDESC()
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
    //  * @return CondicionCompra[] Returns an array of CondicionCompra objects
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

    /*
    public function findOneBySomeField($value): ?CondicionCompra
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
