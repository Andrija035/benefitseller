<?php

namespace App\Listener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function onCoreException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $request = $event->getRequest();

        if (!$request->isXmlHttpRequest()) {
            if (str_starts_with($request->getPathInfo(), '/api')) {
                $response = new JsonResponse(['success' => false, 'message' => $exception->getMessage()]);
                $event->setResponse($response);
            }
        }
    }
}
