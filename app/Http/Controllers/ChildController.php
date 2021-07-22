<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ChildService;

class ChildController extends Controller
{
    protected $childService;

    public function __construct(ChildService $childService)
    {
        $this->childService = $childService;
    }

    public function index() {
		$childs = $this->childService->getAllChild();
		return response([
			'success' => true,
			'message' => 'List child',
			'data' => $childs
		],200);
	}

    public function store(Request $request) {
		$child = $this->childService->createChild($request);

		if ($child) {
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
    	$child = $this->childService->getChildById($id);

    	if($child) {
    		return response()->json([
    			'success' => true,
    			'message' => 'Detail Child',
    			'data' => $child
    		], 200);
    	} else {
    		return response()->json([
    			'success' => false,
    			'message' => 'Child with id '.$id.' not found',
    			'data' => ''
    		], 401);
    	}
    }

    public function update(Request $request) {
		$child = $this->childService->updateChild($request);

		if ($child) {
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

	public function updateToken(Request $request) {
		$child = $this->childService->updateToken($request);
		if ($child) {
			return response()->json([
				'success' => true,
				'message' => 'Token berhasil diupdate',
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'message' => 'Token gagal diupdate',
			], 401);
		}
    }

    public function destroy($id) {
		$child = $this->childService->deleteChildById($id);
		
    	if ($child) {
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
	
	public function getChildByParentId($id) {
		$child = $this->childService->getChildByParentId($id);
		
		if ($child) {
    		return response()->json([
    			'success' => true,
				'message' => 'Child from parent '. $id,
				'data' => $child
    		], 200);
    	}
	}
}
