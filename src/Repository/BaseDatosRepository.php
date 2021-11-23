<?php

namespace App\Repository;

use App\Entity\BaseDatos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BaseDatos|null find($id, $lockMode = null, $lockVersion = null)
 * @method BaseDatos|null findOneBy(array $criteria, array $orderBy = null)
 * @method BaseDatos[]    findAll()
 * @method BaseDatos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BaseDatosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BaseDatos::class);
    }

    // /**
    //  * @return BaseDatos[] Returns an array of BaseDatos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BaseDatos
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
