<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FolderService;

class FolderController extends Controller
{
    protected $folderService;

    public function __construct(FolderService $folderService)
    {
        $this->folderService = $folderService;
    }

    public function index() {
		$folders = $this->folderService->getAllFolder();
		return response([
			'success' => true,
			'message' => 'List folders',
			'data' => $folders
		],200);
	}

    public function store(Request $request) {
		$folder = $this->folderService->createFolder($request);

		if ($folder) {
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
    	$folder = $this->folderService->getFolderById($id);

    	if($folder) {
    		return response()->json([
    			'success' => true,
    			'message' => 'Detail folder',
    			'data' => $folder
    		], 200);
    	} else {
    		return response()->json([
    			'success' => false,
    			'message' => 'folder with id '.$id.' not found',
    			'data' => ''
    		], 401);
    	}
    }

    public function update(Request $request) {
		$folder = $this->folderService->updateFolder($request);

		if ($folder) {
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
		$folder = $this->folderService->deleteFolderById($id);

    	if ($folder) {
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
