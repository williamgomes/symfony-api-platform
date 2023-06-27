<?php

namespace App\Handler;

use App\Entity\EventTypes;
use App\Repository\EventTypesRepository;

class EventDataHandler
{
    public function __construct(
        private readonly EventTypesRepository $eventTypesRepository
    )
    {}

    public function handlePostData(array $data): ?array
    {
        if (empty($data) || ! isset($data['type'])) {
            return null;
        }

        $eventType = $this->eventTypesRepository->getOrCreateByTitle($data['type']);
        if ($eventType instanceof EventTypes) {
            $data['type'] = sprintf('/api/event_types/%s', $eventType->getId());
        }

        return $data;
    }
}