<?php

namespace App\Repository;

use App\Entity\rendez_vous;
use App\Entity\Veterinaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<rendez_vous>
 *
 * @method rendez_vous|null find($id, $lockMode = null, $lockVersion = null)
 * @method rendez_vous|null findOneBy(array $criteria, array $orderBy = null)
 * @method rendez_vous[]    findAll()
 * @method rendez_vous[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RendezVousRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, rendez_vous::class);
    }

    public function save(rendez_vous $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(rendez_vous $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return rendez_vous[] Returns an array of rendezvous objects
     */
    public function findBySemaineAndVeterinaire(\DateTimeInterface $dateDebut, Veterinaire $veto): array
    {
        $dateFin = (new \DateTime('today'))->modify('+6 day');

        return $this->createQueryBuilder('r')
            // ->select('count(r)')
            ->andWhere('r.dateRdv BETWEEN :from AND :to')
            ->andWhere('r.veterinaire = :veto')
            ->setParameter('from', $dateDebut)
            ->setParameter('to', $dateFin)
            ->setParameter('veto', $veto)
            ->orderBy('r.dateRdv', 'ASC')
            ->addOrderBy('r.horaire', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

//    /**
//     * @return rendezvous[] Returns an array of rendezvous objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?rendezvous
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
