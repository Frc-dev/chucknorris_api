<?php

declare(strict_types=1);

namespace App\Domain;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Serializer\SerializerInterface;

class ApiResponse
{
    private SerializerInterface $serializer;

    public function __construct(
        SerializerInterface $serializer
    )
    {
        $this->serializer = $serializer;
    }

    public function handleResponse(Envelope $envelope): Response
    {
        return new Response(
            $this->serializer->serialize($envelope->last(HandledStamp::class)->getResult(), 'json'),
            Response::HTTP_OK
        );
    }
}