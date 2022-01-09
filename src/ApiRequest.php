<?php

declare(strict_types=1);

namespace App;

use App\Domain\DomainError\WrongCategoryException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiRequest
{
    private HttpClientInterface $client;

    public function __construct(
        HttpClientInterface $client
    )
    {
        $this->client = $client;
    }

    public function randomApiCall(): array
    {
        $url = 'https://api.chucknorris.io/jokes/random';

        return $this->callApi($url);
    }

    public function categoryListCall(): array
    {
        $url = 'https://api.chucknorris.io/jokes/categories';
        return $this->callApi($url);
    }

    public function categorySearchCall(string $category): array
    {
        $url = 'https://api.chucknorris.io/jokes/random?category='. $category;

        if (!filter_var($url, FILTER_VALIDATE_URL))
        {
            throw new WrongCategoryException($category);
        }

        return $this->callApi($url);
    }

    public function wordSearchCall(string $word): array
    {
        $url = 'https://api.chucknorris.io/jokes/search?query=' . $word;
        return $this->callApi($url);
    }

    public function callApi(string $url , string $method = 'GET'): array
    {
        try{
            $response = $this->client->request(
                $method,
                $url
            )->getContent();
        } catch (\Exception $e) {
            if ($e->getCode() === 404) {
                throw new NotFoundHttpException();
            }

            if($e->getCode() === 400) {
                throw new BadRequestHttpException();
            }
        }

        return json_decode($response, true);
    }
}