<?php

namespace App\Repository;

use App\Entity\Team;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends ServiceEntityRepository<Team>
 *
 * @method Team|null find($id, $lockMode = null, $lockVersion = null)
 * @method Team|null findOneBy(array $criteria, array $orderBy = null)
 * @method Team[]    findAll()
 * @method Team[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Team::class);
    }

    public function add(Team $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Team $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    #[ArrayShape(['teams' => "array"])]
    public function getAllTeamsWithRelatedAccounts(): array
    {
        $result = ['teams' => []];

        $teamsWithAccounts = $this->createQueryBuilder('t')
            ->leftJoin('t.accounts', 'a')
            ->addSelect('a')
            ->getQuery()
            ->getArrayResult();

        if (count($teamsWithAccounts)) {
            $result['teams'] = array_map(function ($team) {
                $team['size'] = count($team['accounts'] ?? 0);

                return $team;
            }, $teamsWithAccounts);
        }

        return $result;
    }
}
