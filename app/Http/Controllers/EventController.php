<?php

namespace App\Http\Controllers;

use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $eventService;

    // Inyección de dependencias del servicio en el constructor
    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }
    public function create()
    {
        return view("events.create", ['eventService' => $this->eventService]);
    }
}
