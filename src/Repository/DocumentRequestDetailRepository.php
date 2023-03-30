<?php

namespace App\Repository;

use App\Entity\DocumentRequestDetail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DocumentRequestDetail>
 *
 * @method DocumentRequestDetail|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocumentRequestDetail|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocumentRequestDetail[]    findAll()
 * @method DocumentRequestDetail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentRequestDetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocumentRequestDetail::class);
    }

    public function save(DocumentRequestDetail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DocumentRequestDetail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return DocumentRequestDetail[] Returns an array of DocumentRequestDetail objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DocumentRequestDetail
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
