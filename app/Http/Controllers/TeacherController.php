<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TeacherService;

class TeacherController extends Controller
{
	protected $teacherService;

	public function __construct(TeacherService $teacherService)
	{
		$this->teacherService = $teacherService;
	}

    public function index() {
		$teachers = $this->teacherService->getAllTeachers();
		return response([
			'success' => true,
			'message' => 'List teachers',
			'data' => $teachers
		],200);
	}

    public function store(Request $request) {
		$teachers = $this->teacherService->createTeacher($request);

		if ($teachers) {
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
    	$teacher = $this->teacherService->getTeacherById($id);

    	if($teacher) {
    		return response()->json([
    			'success' => true,
    			'message' => 'Detail Teacher',
    			'data' => $teacher
    		], 200);
    	} else {
    		return response()->json([
    			'success' => false,
    			'message' => 'Teacher with nomor pegawai '.$id.' not found',
    			'data' => ''
    		], 401);
    	}
    }

    public function update(Request $request) {
		$teacher = $this->teacherService->updateTeacher($request);

		if ($teacher) {
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
		$teacher = $this->teacherService->deleteTeacherById($id);
		
    	if ($teacher) {
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
		$status = $this->teacherService->loginTeacher($request);

		return response()->json([
			'success' => $status["success"],
			'message' => $status["message"],
			'data' => $status["data"],
		], 200);
	}

	public function updateToken(Request $request) {
		$child = $this->teacherService->updateToken($request);
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

	public function getByUsername($username) {
    	$teacher = $this->teacherService->getTeacherByUsername($username);

    	if($teacher) {
    		return response()->json([
    			'success' => true,
    			'message' => 'Detail Teacher',
    			'data' => $teacher
    		], 200);
    	} else {
    		return response()->json([
    			'success' => false,
    			'message' => 'Teacher with nomor pegawai '.$username.' not found',
    			'data' => ''
    		], 401);
    	}
    }
}
