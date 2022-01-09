<?php

declare(strict_types=1);

namespace App\Domain;

use App\Entity\SearchResult;
use Ramsey\Uuid\Uuid;
use function Lambdish\Phunctional\map;

class SearchResultMapper
{
    public function __invoke(array $result): array
    {
        $searchId = Uuid::uuid4()->toString();
        $mapper = static function (array $result) use ($searchId) {
            return SearchResult::fromRawResult($result, $searchId);
        };

        return map($mapper, $result);
    }
}