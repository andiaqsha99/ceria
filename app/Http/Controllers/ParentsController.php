<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ParentsService;

class ParentsController extends Controller
{

	protected $parentsService;

	public function __construct(ParentsService $parentsService)
	{
		$this->parentsService = $parentsService;
	}

    public function index() {
		$parents = $this->parentsService->getAllParents();
		return response([
			'success' => true,
			'message' => 'List parents',
			'data' => $parents
		],200);
	}

    public function store(Request $request) {
		$parents = $this->parentsService->createParent($request);

		if ($parents) {
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
    	$parent = $this->parentsService->getParentById($id);

    	if($parent) {
    		return response()->json([
    			'success' => true,
    			'message' => 'Detail Parent',
    			'data' => $parent
    		], 200);
    	} else {
    		return response()->json([
    			'success' => false,
    			'message' => 'Parent with nik '.$id.' not found',
    			'data' => ''
    		], 401);
    	}
    }

    public function update(Request $request) {
		$parent = $this->parentsService->updateParent($request);

		if ($parent) {
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
    	$parent = $this->parentsService->deleteParentById($id);

    	if ($parent) {
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
	
	public function login(Request $request) {
		$status = $this->parentsService->loginParents($request);

		return response()->json([
			'success' => $status["success"],
			'message' => $status["message"],
			'data' => $status["data"],
		], 200);
	}

	public function getByUsername($username) {
    	$parent = $this->parentsService->getParentByUsername($username);

    	if($parent) {
    		return response()->json([
    			'success' => true,
    			'message' => 'Detail Parent',
    			'data' => $parent
    		], 200);
    	} else {
    		return response()->json([
    			'success' => false,
    			'message' => 'Parent with username '.$username.' not found',
    			'data' => ''
    		], 401);
    	}
    }
}
