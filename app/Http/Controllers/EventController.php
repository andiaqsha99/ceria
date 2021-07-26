<?php

namespace App\Http\Controllers;

use App\Services\ChildService;
use Illuminate\Http\Request;
use App\Services\EventService;
use GuzzleHttp\Client;

class EventController extends Controller
{
    protected $eventService;
	protected $childService;

    public function __construct(EventService $eventService, ChildService $childService)
    {
        $this->eventService = $eventService;
		$this->childService = $childService;
    }

    public function index() {
		$events = $this->eventService->getAllEvents();
		return response([
			'success' => true,
			'message' => 'List events',
			'data' => $events
		],200);
	}

    public function store(Request $request) {
		$event = $this->eventService->createEvent($request);
		$childs = $this->childService->getChildByClassId($request->id_class);
		$client = new Client();
		$notificationResult = [];

		foreach ($childs as  $child) {
			$token = "";
			if($child->notification_token != NULL){
				$token = $child->notification_token;
			}
			$notificationBody = [
				'notification'=>[
					'title' => $request->name,
					'body'=> $request->description,
				],
				'data'=> [
					'date'=>$request->date,
					'location'=>$request->location
				],
				'to'=> $token
			];

			$result = $client->request('POST', 'https://fcm.googleapis.com/fcm/send', [
				'headers' => [
					'Accept' => 'application/json',
					'Authorization' => 'key=AAAARFI6TRs:APA91bF80dEn_hp0z5MNLveaEGfA04T3Jp0KkiJmj0yjqVn2pqFyBwYbIK8PIRqGdC4THiY-atFr_VwKO4fbwZuG5Jh7uF7riAAImut9d9yhSZO9_EDeLWzLjZZNurbwPA7rfKoeCJDY'
				],
				'json' => $notificationBody
			]);
			$notificationResult[]=$result->getStatusCode();
		}

		if ($event) {
			return response()->json([
				'success' => true,
				'message' => 'Item berhasil disimpan',
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'message' => 'Item gagal disimpan',
			], 401);
		}
    }

    public function show($id) {
    	$event = $this->eventService->getEventById($id);

    	if($event) {
    		return response()->json([
    			'success' => true,
    			'message' => 'Detail Event',
    			'data' => $event
    		], 200);
    	} else {
    		return response()->json([
    			'success' => false,
    			'message' => 'Event with id '.$id.' not found',
    			'data' => ''
    		], 401);
    	}
    }

	public function getEventsClassId($id) {
    	$events = $this->eventService->getEventsClassId($id);

    	if($events) {
    		return response()->json([
    			'success' => true,
    			'message' => 'List Event',
    			'data' => $events
    		], 200);
    	} else {
    		return response()->json([
    			'success' => false,
    			'message' => 'Event with class id '.$id.' not found',
    			'data' => ''
    		], 401);
    	}
    }

    public function update(Request $request) {
		$event = $this->eventService->updateEvent($request);

		if ($event) {
			return response()->json([
				'success' => true,
				'message' => 'Berhasil diupdate',
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'message' => 'Gagal diupdate',
			], 401);
		}
    }

    public function destroy($id) {
		$event = $this->eventService->deleteEventById($id);
		
    	if ($event) {
    		return response()->json([
    			'success' => true,
    			'message' => 'Item berhasil dihapus',
    		], 200);
    	} else {
    		return response()->json([
    			'success' => false,
    			'message' => 'Item gagal dihapus',
    		], 401);
    	}
    }
}
