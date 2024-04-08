<?php

namespace App\EventSubscriber;

use App\Controller\Api\ITokenAuthenticatedController;
use App\Service\ApiService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ApiTokenSubscriber implements EventSubscriberInterface
{

    public function __construct(
        private readonly ApiService $apiService,
    ) {
    }

    public function onKernelController(ControllerEvent $event)
    {
        $controller = $event->getController();

        if (is_array($controller)) {
            $controller = $controller[0];
        }

        if ($controller instanceof ITokenAuthenticatedController) {
            $hasCredentials = $this->apiService->checkCredentials($event->getRequest());

            if (!$hasCredentials) {
                throw new \Exception('Invalid authority and token.');
            }
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}
