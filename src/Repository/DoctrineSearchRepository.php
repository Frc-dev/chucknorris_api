<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\SearchRepository;
use App\Entity\SearchResult;

class DoctrineSearchRepository extends DoctrineRepository implements SearchRepository
{
    public function save(array $searchCollection): void
    {
        $batchSize = 20;
        $em = $this->entityManager;
        $i = 0;
        foreach ($searchCollection as $search) {
            $em->persist($search);
            if (($i % $batchSize) === 0) {
                $em->flush();
                $em->clear();
                $i = 0;
            }
            $i++;
        }
        $em->flush();
        $em->clear();
    }

    public function getSearch(string $searchId, ?int $limit = 10, ?int $offset = 0): ?array
    {
        return $this->repository(SearchResult::class)->findBy(
            ['searchId' => $searchId],
            null,
            $limit,
            $offset
        );
    }
}