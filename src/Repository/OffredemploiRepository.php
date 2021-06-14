<?php

namespace App\Repository;

use App\Entity\Offredemploi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Offredemploi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offredemploi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offredemploi[]    findAll()
 * @method Offredemploi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffredemploiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offredemploi::class);
    }

    // /**
    //  * @return Offredemploi[] Returns an array of Offredemploi objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Offredemploi
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
