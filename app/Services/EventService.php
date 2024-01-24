<?php
namespace App\Services;

use App\Models\Event;

/**
 * @injectable
 */

class EventService
{
    public function createEvent(array $data)
    {
        // Lógica para crear un evento
        return Event::create($data);
    }

    public function updateEvent(Event $event, array $data)
    {
        // Lógica para actualizar un evento
        $event->update($data);
        return $event;
    }

    // Otros métodos relacionados con la gestión de eventos...
}
