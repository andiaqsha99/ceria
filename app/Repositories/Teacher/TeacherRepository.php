<?php
namespace App\Repositories\Teacher;

use App\Models\Teacher;
use App\Repositories\Teacher\TeacherRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface {
    
    public function getAllTeachers()
    {
        return Teacher::all();
    }

    public function getTeacherById($id)
    {
        return Teacher::find($id);
    }

    public function createTeacher($data)
    {
        return Teacher::create([
			'nomor_pegawai' => $data->nomor_pegawai,
			'username' => $data->username,
			'password' => Hash::make($data->password),
			'nama' => $data->nama
		]);
    }

    public function updateTeacher($data)
    {
        return Teacher::find($data->nomor_pegawai)->update([
			'nomor_pegawai' => $data->nomor_pegawai,
			'username' => $data->username,
			'password' => Hash::make($data->password),
			'nama' => $data->nama
		]);
    }

    public function deleteTeacherById($id)
    {
        $teacher = Teacher::find($id);
        $teacher->delete();
        return $teacher;
    }

    public function getTeacherByUsername($username)
    {
        return Teacher::where('username', $username)->first();
    }

    public function updateToken($data)
    {
        return Teacher::where('nomor_pegawai', $data->nomor_pegawai)->update([
            'notification_token' => $data->notification_token,
        ]);
    }
}