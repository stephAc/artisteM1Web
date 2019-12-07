<?php

namespace App\Repository;

use App\Entity\Exhibition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Exhibition|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exhibition|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exhibition[]    findAll()
 * @method Exhibition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExhibitionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exhibition::class);
    }

    public function exhibitionCommingUp():Query {
        return $this->createQueryBuilder('exhibition')
            ->where('exhibition.exhibitionDate >= :today')
            ->setParameters(['today' => new \DateTime()])
            ->orderBy('exhibition.exhibitionDate')
            ->getQuery();
    }

    public function passedExhibition():Query {
        return $this->createQueryBuilder('exhibition')
            ->where('exhibition.exhibitionDate < :today')
            ->setParameters(['today' => new \DateTime()])
            ->orderBy('exhibition.exhibitionDate', 'DESC')
            ->getQuery();
    }
}
