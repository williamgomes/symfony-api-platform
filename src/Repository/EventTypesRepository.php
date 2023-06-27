<?php

namespace App\Repository;

use App\Entity\EventTypes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EventTypes>
 *
 * @method EventTypes|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventTypes|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventTypes[]    findAll()
 * @method EventTypes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventTypesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EventTypes::class);
    }

    public function save(EventTypes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(EventTypes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getOrCreateByTitle(string $title): ?EventTypes
    {
        if (empty($title)) {
            return null;
        }

        $eventType = $this->findOneBy(['title' => $title]);

        if (empty($eventType)) {
            $eventType = new EventTypes();
            $eventType->setTitle($title);
            $this->save($eventType, true);
        }

        return $eventType;
    }

//    /**
//     * @return EventTypes[] Returns an array of EventTypes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EventTypes
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
