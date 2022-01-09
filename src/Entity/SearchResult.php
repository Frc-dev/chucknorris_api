<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="search_results", indexes={@ORM\Index(name="search_idx",columns={"search_id"}, options={"length": 255})})
 */
class SearchResult
{
    /** @ORM\Id @ORM\Column(type="string") */
    private $resultId;
    /** @ORM\Column(type="string", name="search_id") */
    private $searchId;
    /** @ORM\Column(type="array") */
    private $categories;
    /** @ORM\Column(type="datetime") */
    private $created_at;
    /** @ORM\Column(type="string") */
    private $value;

    public function __construct(
        $resultId,
        $searchId,
        $categories,
        $created_at,
        $value
    )
    {
        $this->resultId = $resultId;
        $this->searchId = $searchId;
        $this->categories = $categories;
        $this->created_at = $created_at;
        $this->value = $value;
    }

    public static function fromRawResult(
        array $result,
        string $searchId
    ): SearchResult
    {
        return new self(
            $result['id'],
            $searchId,
            $result['categories'],
            $result['created_at'],
            $result['value']
        );
    }

    /**
     * @return mixed
     */
    public function getResultId()
    {
        return $this->resultId;
    }

    /**
     * @return mixed
     */
    public function getSearchId()
    {
        return $this->searchId;
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}