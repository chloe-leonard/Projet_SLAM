<?php

namespace App\Repository;

use App\Entity\SignalementCompte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SignalementCompte>
 *
 * @method SignalementCompte|null find($id, $lockMode = null, $lockVersion = null)
 * @method SignalementCompte|null findOneBy(array $criteria, array $orderBy = null)
 * @method SignalementCompte[]    findAll()
 * @method SignalementCompte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SignalementCompteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SignalementCompte::class);
    }

//    /**
//     * @return SignalementCompte[] Returns an array of SignalementCompte objects
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

//    public function findOneBySomeField($value): ?SignalementCompte
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
