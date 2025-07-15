<?php

namespace App\Application\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\JsonResponse;

class AccessListener
{
    const string HEADER = 'X-API-User-Name';

    public function onKernelRequest(RequestEvent $event): void
    {
        $header = $event->getRequest()->headers->has(self::HEADER);
        if (!$header) {
            $event->setResponse($this->getHttpResponse('Header ' . self::HEADER . ' is not found', Response::HTTP_FORBIDDEN));
        }

        $admin = $event->getRequest()->headers->get(self::HEADER);
        if ($admin !== 'admin') {
            $event->setResponse($this->getHttpResponse('Header ' . self::HEADER . ' is not valid', Response::HTTP_FORBIDDEN));
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }

    private function getHttpResponse($message, $code): Response
    {
        return new JsonResponse(['message' => $message], $code);
    }
}
