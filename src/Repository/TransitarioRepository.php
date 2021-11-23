<?php

namespace App\Repository;

use App\Entity\Transitario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Transitario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transitario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transitario[]    findAll()
 * @method Transitario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransitarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transitario::class);
    }

    // /**
    //  * @return Transitario[] Returns an array of Transitario objects
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
    public function findOneBySomeField($value): ?Transitario
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
          public function transitariosOrdenadosDESC()
    {
        return $this->createQueryBuilder('c')
            //->andWhere('c.exampleField = :val')
            //->setParameter('val', $value)
            ->orderBy('c.fecha', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult();     
    }
}
