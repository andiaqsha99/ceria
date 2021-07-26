<?php
namespace App\Services;

use App\Repositories\Event\EventRepositoryInterface;
use Illuminate\Http\Request;

class EventService {

    protected $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function getAllEvents() {
        return $this->eventRepository->index();
    }

    public function getEventById($id) {
        return $this->eventRepository->show($id);
    }

    public function getEventsClassId($id) {
        return $this->eventRepository->getEventsByClassId($id);
    }

    public function createEvent(Request $request) {
        return $this->eventRepository->store($request);
    }

    public function updateEvent(Request $request) {
        return $this->eventRepository->update($request);
    }

    public function deleteEventById($id) {
        return $this->eventRepository->destroy($id);
    }
}