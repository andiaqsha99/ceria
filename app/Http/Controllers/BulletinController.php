<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BulletinService;
use App\Services\DocumentService;

class BulletinController extends Controller
{
    protected $bulletinService;
    protected $documentService;

    public function __construct(BulletinService $bulletinService, DocumentService $documentService)
    {
        $this->bulletinService = $bulletinService;
        $this->documentService = $documentService;
    }

    public function index() {
        $data = array();
		$bulletins = $this->bulletinService->getAllBulletin();

        foreach($bulletins as $bulletin)
        {
            $data[] = array(
                'id' => $bulletin->id,
                'title' => $bulletin->title,
                'thumbnail' => $bulletin->thumbnail,
                'isApproved' => $bulletin->isApproved,
                'content' => $bulletin->content,
                'user_update' => $bulletin->user_update,
                'submit_date' => $bulletin->update_date
            );
        }

		return response([
			'success' => true,
			'message' => 'List bulletin',
			'data' => $data
		],200);
	}

    public function store(Request $request) {
		$bulletin = $this->bulletinService->createBulletin($request);

		if ($bulletin) {
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
    	$bulletin = $this->bulletinService->getBulletinById($id);
        $document = $this->documentService->getDocumentBulletin($id);

        if($document) {
            $bulletin['lampiran'] = $document;
        }

    	if($bulletin) {
    		return response()->json([
    			'success' => true,
    			'message' => 'Detail Bulletin',
    			'data' => $bulletin
    		], 200);
    	} else {
    		return response()->json([
    			'success' => false,
    			'message' => 'Bulletin with id '.$id.' not found',
    			'data' => ''
    		], 401);
    	}
    }

    public function update(Request $request) {
		$bulletin = $this->bulletinService->updateBulletin($request);

		if ($bulletin) {
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
		$bulletin = $this->bulletinService->deleteBulletinById($id);

    	if ($bulletin) {
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

    public function notApproved() {
        $data = array();
        $bulletins = $this->bulletinService->getNotAprovedBulletin();

        foreach($bulletins as $bulletin)
        {
            $data[] = array(
                'id' => $bulletin->id,
                'title' => $bulletin->title,
                'thumbnail' => $bulletin->thumbnail,
                'username' => $bulletin->user_update,
                'update_date' => $bulletin->update_date,
                'isApproved' => $bulletin->isApproved
            );
        }

		return response([
			'success' => true,
			'message' => 'List bulletin',
			'data' => $data
		],200);
    }

    public function approval(Request $request) {
		$bulletin = $this->bulletinService->updateBulletin($request);

		if ($bulletin) {
			return response()->json([
				'success' => true,
				'message' => 'Berhasil diapprove',
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'message' => 'Gagal diapprove',
			], 401);
		}
    }

    public function notifApproved($user_update) {
        $data = array();
        $bulletins = $this->bulletinService->getBulletinByUsername($user_update);

        foreach($bulletins as $bulletin)
        {
            $data[] = array(
                'id' => $bulletin->id,
                'title' => $bulletin->title,
                'thumbnail' => $bulletin->thumbnail,
                'username' => $bulletin->user_update,
                'update_date' => $bulletin->update_date,
                'isApproved' => $bulletin->isApproved
            );
        }

		return response([
			'success' => true,
			'message' => 'Notif bulletin',
			'data' => $data
		],200);
    }
}
