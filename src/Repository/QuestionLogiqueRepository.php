<?php

namespace App\Repository;

use App\Entity\QuestionLogique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QuestionLogique|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionLogique|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionLogique[]    findAll()
 * @method QuestionLogique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionLogiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestionLogique::class);
    }

    // /**
    //  * @return QuestionLogique[] Returns an array of QuestionLogique objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QuestionLogique
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * 
     */
}
