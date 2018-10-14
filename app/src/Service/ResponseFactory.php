<?php

namespace UrlShortener\Service;

use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;

class ResponseFactory
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function response($payload, int $code = 200): Response
    {
        $message = is_string($payload) ? $payload : $this->serializer->serialize($payload, 'json');

        return new Response($message, $code);
    }

    public function jsonResponse($payload, int $code = 200): Response
    {
        return $this->_json($this->response($payload, $code));
    }

    public function jsonError($error, int $code = 500): Response
    {
        $message = [
            'status' => 'failed',
            'error' => $error,
        ];

        return $this->_json($this->response($message, $code));
    }

    private function _json(Response $response): Response
    {
        $response->headers->set('Content-type', 'application/json');

        return $response;
    }
}
