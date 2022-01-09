<?php

declare(strict_types=1);

namespace App\Controller;

use App\Application\CategoryGet\CategoryGetQuery;
use App\Application\CategorySearch\CategorySearchQuery;
use App\Application\RandomSearch\RandomSearchQuery;
use App\Application\SearchGetResults\SearchGetResultsQuery;
use App\Application\WordSearch\WordSearchQuery;
use App\Domain\ApiResponse;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Mime\Address;

class SearchController extends ApiController
{

    private MessageBusInterface $queryBus;
    private ApiResponse $apiResponse;

    public function __construct(
        MessageBusInterface $queryBus,
        ApiResponse $apiResponse
    )
    {
        parent::__construct();
        $this->queryBus = $queryBus;
        $this->apiResponse = $apiResponse;
    }

    public function getCategories(): Response
    {
        $query = new CategoryGetQuery();

        $result = $this->queryBus->dispatch($query);
        return $this->apiResponse->handleResponse($result);
    }

    public function categorySearch(string $category): Response
    {
        $query = new CategorySearchQuery($category);

        $result = $this->queryBus->dispatch($query);
        return $this->apiResponse->handleResponse($result);
    }

    public function randomSearch(): Response
    {
        $query = new RandomSearchQuery();

        $result = $this->queryBus->dispatch($query);
        return $this->apiResponse->handleResponse($result);
    }

    public function wordSearch(string $word): Response
    {
        $query = new WordSearchQuery($word);

        $result = $this->queryBus->dispatch($query);
        return $this->apiResponse->handleResponse($result);
    }

    public function searchGetResults(Request $request): Response
    {
        $result = $this->getResults($request);
        return $this->apiResponse->handleResponse($result);
    }

    public function mailPage(MailerInterface $mailer, Request $request): Response
    {
        $mailAddress = $request->get('address');
        $messageList = $this->apiResponse->handleResponse($this->getResults($request));

        $result = $this->sendMail($mailer, json_decode($messageList->getContent(), true), $mailAddress);

        return new Response(json_encode($result));
    }

    public function getResults(Request $request): Envelope {
        $offset = $request->query->getInt('offset');
        $limit = $request->query->getInt('limit');
        $searchId = $request->get('searchId');
        $query = new SearchGetResultsQuery($offset, $limit, $searchId);

        return $this->queryBus->dispatch($query);
    }

    public function sendMail(MailerInterface $mailer, array $messageList, string $mailAddress): array
    {
       if (filter_var($mailAddress, FILTER_VALIDATE_EMAIL)) {
           $email = (new TemplatedEmail())
               ->from('dev@mail.com')
               ->to(new Address($mailAddress))
               ->subject('Chuck Norris Facts!')
               ->htmlTemplate('views/email.html.twig')
               ->context([
                   'messageList' => $messageList
               ])
           ;
           try {
               $mailer->send($email);
           } catch (\Exception $e) {
               return ['error' => 'Error sending mail'];
           }

           return ['success' => 'Done'];
       };

       return ['error' => 'Wrong mail address'];
    }
}