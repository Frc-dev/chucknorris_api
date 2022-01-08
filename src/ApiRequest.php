<?php

declare(strict_types=1);

namespace App;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiRequest
{
    private $client;

    public function __construct(
        HttpClientInterface $client
    )
    {
        $this->client = $client;
    }

    public function randomApiCall(): string
    {
        $url = 'https://api.chucknorris.io/jokes/random';

        return $this->callApi($url);
    }

    public function categoryListCall(): string
    {
        $url = 'https://api.chucknorris.io/jokes/categories';

        return $this->callApi($url);
    }

    public function callApi(string $url , string $method = 'GET'): string
    {
        $response = $this->client->request(
            $method,
            $url
        );

        return $response->getContent();
    }
}