<?php

namespace UrlShortener\Event;

use UrlShortener\Service\ResponseFactory;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class SymfonyKernelEventListener
{
    private $env;
    private $responseFactory;

    public function __construct(string $env, ResponseFactory $factory)
    {
        $this->env = $env;
        $this->responseFactory = $factory;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        // log and process exception

        if ('prod' === $this->env) {
            $event->setResponse($this->responseFactory->jsonError('Server error', 500));
        } else {
            $event->setResponse($this->responseFactory->jsonError($exception->getMessage()), 500);
        }
    }
}
