<?php

declare(strict_types=1);

namespace App\Domain;

use App\Entity\SearchResult;
use Ramsey\Uuid\Uuid;
use function Lambdish\Phunctional\map;

class SearchResultMapper
{
    public function __invoke(array $result, string $searchType): array
    {
        $searchId = Uuid::uuid4()->toString();
        $mapper = static function (array $result) use ($searchType, $searchId) {
            return SearchResult::fromRawResult($result, $searchId, $searchType);
        };

        return map($mapper, $result);
    }
}