<?php

namespace App\Repository;

use App\Entity\TipoContenedor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoContenedor|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoContenedor|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoContenedor[]    findAll()
 * @method TipoContenedor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoContenedorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoContenedor::class);
    }
     public function tiposContenedoresOrdenadosDESC()
    {
        return $this->createQueryBuilder('tc')
            //->andWhere('c.exampleField = :val')
            //->setParameter('val', $value)
            ->orderBy('tc.fecha', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult();     
    }

    // /**
    //  * @return TipoContenedor[] Returns an array of TipoContenedor objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TipoContenedor
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
