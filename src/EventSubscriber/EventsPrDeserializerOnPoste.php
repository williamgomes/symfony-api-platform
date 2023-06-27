<?php

namespace App\EventSubscriber;

use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Entity\Events;
use App\Handler\EventDataHandler;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class EventsPrDeserializerOnPoste implements EventSubscriberInterface
{
    public function __construct(
        private readonly EventDataHandler $eventDataHandler
    )
    {}

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => [
                'deserialize', EventPriorities::PRE_DESERIALIZE,
            ]
        ];
    }

    public function deserialize(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $method = $request->getMethod();

        $resource = $request->attributes->get('_api_resource_class');

        if (
            !$event->isMainRequest() ||
            Request::METHOD_POST !== $method ||
            $resource !== Events::class
        ) {
            return;
        }

        $data = $this->eventDataHandler->handlePostData($request->toArray());

        $format = $request->getPreferredFormat();

        $request->initialize(
            $request->query->all(),
            $request->request->all(),
            $request->attributes->all(),
            $request->cookies->all(),
            $request->files->all(),
            $request->server->all(),
            json_encode($data)
        );

        $request->setRequestFormat($format);
    }
}