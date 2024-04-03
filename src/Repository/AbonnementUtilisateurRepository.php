<?php

namespace App\Repository;

use App\Entity\AbonnementUtilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AbonnementUtilisateur>
 *
 * @method AbonnementUtilisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method AbonnementUtilisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method AbonnementUtilisateur[]    findAll()
 * @method AbonnementUtilisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AbonnementUtilisateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AbonnementUtilisateur::class);
    }

//    /**
//     * @return AbonnementUtilisateur[] Returns an array of AbonnementUtilisateur objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AbonnementUtilisateur
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
