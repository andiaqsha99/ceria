<?php
namespace App\Services;

use App\Repositories\Attendance\AttendanceRepositoryInterface;
use Illuminate\Http\Request;

class AttendanceService {

    protected $attendanceRepository;

    public function __construct(AttendanceRepositoryInterface $attendanceRepository)
    {
        $this->attendanceRepository = $attendanceRepository;
    }

    public function getAllAttendance() {
        return $this->attendanceRepository->getAllAttendance();
    }

    public function getAttendanceById($id) {
        return $this->attendanceRepository->getAttendanceById($id);
    }

    public function getAttendanceByParent($nip, $classId) {
        return $this->attendanceRepository->getAttendanceByParent($nip, $classId);
    }

    public function createAttendance(Request $request) {
        return $this->attendanceRepository->createAttendance($request);
    }

    public function updateAttendance(Request $request) {
        return $this->attendanceRepository->updateAttendance($request);
    }

    public function deleteAttendanceById($id) {
        return $this->attendanceRepository->deleteAttendanceById($id);
    }
}