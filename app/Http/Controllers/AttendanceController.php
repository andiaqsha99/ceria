<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AttendanceService;
use App\Services\KelasService;

class AttendanceController extends Controller
{
    protected $attendanceService;
	protected $kelasService;

    public function __construct(AttendanceService $attendanceService, KelasService $kelasService)
    {
        $this->attendanceService = $attendanceService;
		$this->kelasService = $kelasService;
    }

    public function index() {
		$attendances = $this->attendanceService->getAllAttendance();
		return response([
			'success' => true,
			'message' => 'List attendances',
			'data' => $attendances
		],200);
	}

    public function store(Request $request) {
		$attendance = $this->attendanceService->createAttendance($request);

		if ($attendance) {
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
    	$attendance = $this->attendanceService->getAttendanceById($id);

    	if($attendance) {
    		return response()->json([
    			'success' => true,
    			'message' => 'Detail Attendance',
    			'data' => $attendance
    		], 200);
    	} else {
    		return response()->json([
    			'success' => false,
    			'message' => 'Attendance with id '.$id.' not found',
    			'data' => ''
    		], 401);
    	}
    }

    public function update(Request $request) {
		$attendance = $this->attendanceService->updateAttendance($request);

		if ($attendance) {
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
		$attendance = $this->attendanceService->deleteAttendanceById($id);
		
    	if ($attendance) {
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

	public function getParentAttendance($nip, $id_class, $date){
		$kelasStartDate = $this->kelasService->getKelasById($id_class)->periode_awal;
		$attendance = $this->attendanceService->getAttendanceByParent($nip, $id_class);
		$periode_awal = strtotime($kelasStartDate);
		$requestedDate = strtotime($date);
		$diffDays = 1;
		if($requestedDate > $periode_awal){
			$diffDays = ($requestedDate - $periode_awal)/86400;
		}

		function beforeDays($var)
		{
			return strtotime($var->tanggal) < strtotime($var->date);
		}

		function notPresent($var)
		{
			return strtolower($var->status_kehadiran) != "hadir";
		}

		$currentAttendance = array_filter($attendance,"beforeDays");
		$countNotPresentAttendance = count(array_filter($currentAttendance, "notPresent"));
		
		$notPresentPersentage = 0;
		$presentPersentage = 100;
		if($countNotPresentAttendance > 0 && $countNotPresentAttendance < $diffDays){
			$notPresentPersentage = ($countNotPresentAttendance / $diffDays)*100;
			$presentPersentage = ($diffDays - $countNotPresentAttendance)/$diffDays*100;
		}


		if ($attendance && $kelasStartDate) {
    		return response()->json([
    			'success' => true,
    			'message' => 'Detail Kehadiran',
				'data' => [
					'total_hari' =>$diffDays,
					'hadir'=>$presentPersentage,
					'tidak_hadir'=>$notPresentPersentage
				]
    		], 200);
    	} else {
    		return response()->json([
    			'success' => false,
    			'message' => 'Data tidak ada',
				'data' => ''
    		], 401);
    	}

	}
}
