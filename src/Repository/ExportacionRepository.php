<?php

namespace App\Repository;

use App\Entity\Exportacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Exportacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exportacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exportacion[]    findAll()
 * @method Exportacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExportacionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exportacion::class);
    }
     public function exportacionesOrdenadasDESC()
    {
        return $this->createQueryBuilder('e')
            //->andWhere('c.exampleField = :val')
            //->setParameter('val', $value)
            ->orderBy('e.fecha', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult();     
    }

    // /**
    //  * @return Exportacion[] Returns an array of Exportacion objects
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
    public function findOneBySomeField($value): ?Exportacion
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
