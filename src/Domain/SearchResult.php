<?php

declare(strict_types=1);

namespace App\Domain;

class SearchResult
{
    private $categories;
    private $created_at;
    private $icon_url;
    private $id;
    private $updated_at;
    private $url;
    private $value;

    public function __construct(
        $categories, $created_at, $icon_url, $id, $updated_at, $url, $value)
    {
        $this->categories = $categories;
        $this->created_at = $created_at;
        $this->icon_url = $icon_url;
        $this->id = $id;
        $this->updated_at = $updated_at;
        $this->url = $url;
        $this->value = $value;
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
    public function getIconUrl()
    {
        return $this->icon_url;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}