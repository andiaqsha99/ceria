<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FileService;

class FileController extends Controller
{
    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function index() {
		$files = $this->fileService->getAllFile();
		return response([
			'success' => true,
			'message' => 'List files',
			'data' => $files
		],200);
	}

    public function store(Request $request) {
		$file = $this->fileService->createFile($request);

		if ($file) {
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
    	$file = $this->fileService->getFileById($id);

    	if($file) {
    		return response()->json([
    			'success' => true,
    			'message' => 'Detail file',
    			'data' => $file
    		], 200);
    	} else {
    		return response()->json([
    			'success' => false,
    			'message' => 'file with id '.$id.' not found',
    			'data' => ''
    		], 401);
    	}
    }

    public function update(Request $request) {
		$file = $this->fileService->updateFile($request);

		if ($file) {
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
		$file = $this->fileService->deleteFileById($id);

    	if ($file) {
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

    public function deleteMultiple(Request $request) {
        $file = $this->fileService->deleteMultipleFileById($request->id);

    	if ($file) {
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

    public function getFileByFolderId($id) {
        $files = $this->fileService->getFileByFolderId($id);
		return response([
			'success' => true,
			'message' => 'List files by folder'. $id,
			'data' => $files
		],200);
    }
}
