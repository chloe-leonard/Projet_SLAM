<?php

namespace App\Repository;

use App\Entity\SignalementPublication;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SignalementPublication>
 *
 * @method SignalementPublication|null find($id, $lockMode = null, $lockVersion = null)
 * @method SignalementPublication|null findOneBy(array $criteria, array $orderBy = null)
 * @method SignalementPublication[]    findAll()
 * @method SignalementPublication[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SignalementPublicationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SignalementPublication::class);
    }

//    /**
//     * @return SignalementPublication[] Returns an array of SignalementPublication objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SignalementPublication
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
