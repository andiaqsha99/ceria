<?php
namespace App\Repositories\Event;

use App\Models\Event;
use App\Repositories\Event\EventRepositoryInterface;
use GuzzleHttp\Client;

class EventRepository implements EventRepositoryInterface {

    public function index()
    {
        return Event::all();
    }

    public function show($id)
    {
        return Event::find($id);
    }

    public function store($data)
    {
        return Event::create([
            'name' => $data->name,
            'id_class'=>$data->id_class,
            'description' => $data->description,
            'location' => $data->location,
            'date' => $data->date
        ]);
    }

    public function update($data)
    {
        return Event::find($data->id)->update([
            'name' => $data->name,
            'id_class'=>$data->id_class,
            'description' => $data->description,
            'location' => $data->location,
            'date' => $data->date
        ]);
    }

    public function destroy($id)
    {
        return $event = Event::find($id)->delete();
    }

    public function getEventsByClassId($id)
    {
        return Event::where('id_class', $id)->get();
    }
}