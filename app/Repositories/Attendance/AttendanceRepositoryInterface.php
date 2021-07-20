<?php

namespace App\Repositories\Attendance;

interface AttendanceRepositoryInterface {
    public function getAllAttendance();
    public function getAttendanceById($id);
    public function createAttendance($data);
    public function updateAttendance($data);
    public function deleteAttendanceById($id);
    public function getAttendanceByParent($nip, $classId);
}