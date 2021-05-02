<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RaportService;

class RaportController extends Controller
{
    protected $raportService;

    public function __construct(RaportService $raportService)
    {
        $this->raportService = $raportService;
    }

    public function index() {
		$raport = $this->raportService->getAllRaports();
		return response([
			'success' => true,
			'message' => 'List raport',
			'data' => $raport
		],200);
	}

    public function store(Request $request) {
		$raport = $this->raportService->createRaport($request);

		if ($raport) {
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
    	$raport = $this->raportService->getRaportById($id);

    	if($raport) {
    		return response()->json([
    			'success' => true,
    			'message' => 'Detail raport',
    			'data' => $raport
    		], 200);
    	} else {
    		return response()->json([
    			'success' => false,
    			'message' => 'raport with id '.$id.' not found',
    			'data' => ''
    		], 401);
    	}
    }

    public function update(Request $request) {
		$raport = $this->raportService->updateRaport($request);

		if ($raport) {
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
		$raport = $this->raportService->deleteRaportById($id);

    	if ($raport) {
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

    public function getRaportByNis($nis) {
        $raport = $this->raportService->getRaportByNis($nis);

    	if($raport) {
    		return response()->json([
    			'success' => true,
    			'message' => 'List raport '. $nis,
    			'data' => $raport
    		], 200);
    	} else {
    		return response()->json([
    			'success' => false,
    			'message' => 'raport with nis '.$nis.' not found',
    			'data' => ''
    		], 401);
    	}
    }

    public function getDateRaportByNis($nis) {
        $raport = $this->raportService->getRaportDateByNis($nis);

    	if($raport) {
    		return response()->json([
    			'success' => true,
    			'message' => 'List date from '. $nis,
    			'data' => $raport
    		], 200);
    	} else {
    		return response()->json([
    			'success' => false,
    			'message' => 'raport with nis '.$nis.' not found',
    			'data' => ''
    		], 401);
    	}
    }

    public function getRaportByNisAndDate($nis, $date) {
        $raport = $this->raportService->getRaportByNisAndDate($nis, $date);

    	if($raport) {
    		return response()->json([
    			'success' => true,
    			'message' => 'List raport '. $nis. ' in '. $date,
    			'data' => $raport
    		], 200);
    	} else {
    		return response()->json([
    			'success' => false,
    			'message' => 'raport with nis '.$nis.' not found',
    			'data' => ''
    		], 401);
    	}
    }
}
