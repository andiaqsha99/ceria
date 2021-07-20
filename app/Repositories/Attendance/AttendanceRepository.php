<?php
namespace App\Repositories\Attendance;

use App\Models\Attendance;
use App\Repositories\Attendance\AttendanceRepositoryInterface;

class AttendanceRepository implements AttendanceRepositoryInterface {
    
    public function getAllAttendance()
    {
        return Attendance::all();
    }

    public function getAttendanceById($id)
    {
        return Attendance::find($id);
    }

    public function createAttendance($data)
    {
        return Attendance::create([
            'id_class' => $data->id_class,
            'nomor_induk' => $data->nomor_induk,
            'tanggal' => $data->tanggal,
            'status_kehadiran' => $data->status_kehadiran,
            'deskripsi' => $data->deskripsi
        ]);
    }

    public function updateAttendance($data)
    {
        return Attendance::find($data->id)->update([
            'id_class' => $data->id_class,
            'nomor_induk' => $data->nomor_induk,
            'tanggal' => $data->tanggal,
            'status_kehadiran' => $data->status_kehadiran,
            'deskripsi' => $data->deskripsi
        ]);
    }

    public function deleteAttendanceById($id)
    {
        $attendance = Attendance::find($id);
        $attendance->delete();
        return $attendance;
    }

    public function getAttendanceByParent($nip, $classId)
    {
        return Attendance::where('nomor_induk', $nip)->where('id_class', $classId)->get();
    }
}