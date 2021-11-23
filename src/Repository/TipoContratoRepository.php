<?php

namespace App\Repository;

use App\Entity\TipoContrato;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoContrato|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoContrato|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoContrato[]    findAll()
 * @method TipoContrato[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoContratoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoContrato::class);
    }
       public function tiposContratoOrdenadosDESC()
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
    //  * @return TipoContrato[] Returns an array of TipoContrato objects
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
    public function findOneBySomeField($value): ?TipoContrato
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
