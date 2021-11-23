<?php

namespace App\Repository;

use App\Entity\RectificacionDesgloseManifiesto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RectificacionDesgloseManifiesto|null find($id, $lockMode = null, $lockVersion = null)
 * @method RectificacionDesgloseManifiesto|null findOneBy(array $criteria, array $orderBy = null)
 * @method RectificacionDesgloseManifiesto[]    findAll()
 * @method RectificacionDesgloseManifiesto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RectificacionDesgloseManifiestoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RectificacionDesgloseManifiesto::class);
    }
       public function rectificacionesDesgloseManifiestoOrdenadasDESC()
    {
        return $this->createQueryBuilder('r')
            //->andWhere('c.exampleField = :val')
            //->setParameter('val', $value)
            ->orderBy('r.fecha', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult();     
    }
    

    // /**
    //  * @return RectificacionDesgloseManifiesto[] Returns an array of RectificacionDesgloseManifiesto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RectificacionDesgloseManifiesto
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
