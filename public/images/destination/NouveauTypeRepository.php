<?php

namespace App\Repository;

use App\Entity\NouveauType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NouveauType|null find($id, $lockMode = null, $lockVersion = null)
 * @method NouveauType|null findOneBy(array $criteria, array $orderBy = null)
 * @method NouveauType[]    findAll()
 * @method NouveauType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NouveauTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NouveauType::class);
    }

    // /**
    //  * @return NouveauType[] Returns an array of NouveauType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NouveauType
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
