<?php

namespace App\Repository;

use App\Entity\Users2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Users2|null find($id, $lockMode = null, $lockVersion = null)
 * @method Users2|null findOneBy(array $criteria, array $orderBy = null)
 * @method Users2[]    findAll()
 * @method Users2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Users2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Users2::class);
    }

    // /**
    //  * @return Users2[] Returns an array of Users2 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Users2
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
