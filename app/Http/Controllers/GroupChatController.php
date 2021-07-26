<?php

namespace App\Http\Controllers;

use App\Services\ChildService;
use Illuminate\Http\Request;
use App\Services\GroupChatService;
use App\Services\KelasService;
use App\Services\TeacherService;
use GuzzleHttp\Client;

class GroupChatController extends Controller
{
    protected $groupChatService;
	protected $childService;
    protected $teacherService;
    protected $classService;

    public function __construct(GroupChatService $groupChatService, ChildService $childService, TeacherService $teacherService, KelasService $classService)
    {
        $this->groupChatService = $groupChatService;
		$this->childService = $childService;
        $this->teacherService = $teacherService;
        $this->classService = $classService;
    }

    public function index() {
		$groupChats = $this->groupChatService->getAllGroupChat();
		return response([
			'success' => true,
			'message' => 'List groupChats',
			'data' => $groupChats
		],200);
	}

    public function store(Request $request) {
		$groupChat = $this->groupChatService->createGroupChat($request);
		$childs = $this->childService->getChildByClassId($request->id_class);
        $teacherClass = $this->classService->getKelasById($request->id_class);
        $teacher = $this->teacherService->getTeacherById($teacherClass->nomor_pegawai);

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
                    'body'=> $request->text,
                ],
                'data'=> [
                    'id_sender'=>$request->id_sender,
                    'date'=>$request->date
                ],
                'to'=> $token
            ];

            if($request->id_sender != $child->id){
                $result = $client->request('POST', 'https://fcm.googleapis.com/fcm/send', [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'key=AAAARFI6TRs:APA91bF80dEn_hp0z5MNLveaEGfA04T3Jp0KkiJmj0yjqVn2pqFyBwYbIK8PIRqGdC4THiY-atFr_VwKO4fbwZuG5Jh7uF7riAAImut9d9yhSZO9_EDeLWzLjZZNurbwPA7rfKoeCJDY'
                    ],
                    'json' => $notificationBody
                ]);
                $notificationResult[]=$result->getStatusCode();
            }
			
		}

        if($teacher){
            $teacherToken = $teacher->notification_token;
            if($teacherToken){
                $notificationBody = [
                    'notification'=>[
                        'title' => $request->name,
                        'body'=> $request->text,
                    ],
                    'data'=> [
                        'id_sender'=>$request->id_sender,
                        'date'=>$request->date
                    ],
                    'to'=> $teacherToken
                ];
                if($request->id_sender != $teacher->nomor_pegawai){
                    $resultTeacher = $client->request('POST', 'https://fcm.googleapis.com/fcm/send', [
                        'headers' => [
                            'Accept' => 'application/json',
                            'Authorization' => 'key=AAAARFI6TRs:APA91bF80dEn_hp0z5MNLveaEGfA04T3Jp0KkiJmj0yjqVn2pqFyBwYbIK8PIRqGdC4THiY-atFr_VwKO4fbwZuG5Jh7uF7riAAImut9d9yhSZO9_EDeLWzLjZZNurbwPA7rfKoeCJDY'
                        ],
                        'json' => $notificationBody
                    ]);
                }
                
            }   
        }

		if ($groupChat) {
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
    	$groupChat = $this->groupChatService->getGroupChatById($id);

    	if($groupChat) {
    		return response()->json([
    			'success' => true,
    			'message' => 'Detail GroupChat',
    			'data' => $groupChat
    		], 200);
    	} else {
    		return response()->json([
    			'success' => false,
    			'message' => 'GroupChat with id '.$id.' not found',
    			'data' => ''
    		], 401);
    	}
    }

	public function getGroupChatByClassId($id) {
    	$groupChats = $this->groupChatService->getGroupChatByClassId($id);

    	if($groupChats) {
    		return response()->json([
    			'success' => true,
    			'message' => 'List GroupChat',
    			'data' => $groupChats
    		], 200);
    	} else {
    		return response()->json([
    			'success' => false,
    			'message' => 'GroupChat with class id '.$id.' not found',
    			'data' => ''
    		], 401);
    	}
    }

    public function update(Request $request) {
		$groupChat = $this->groupChatService->updateGroupChat($request);

		if ($groupChat) {
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
		$groupChat = $this->groupChatService->deleteGroupChatById($id);
		
    	if ($groupChat) {
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
