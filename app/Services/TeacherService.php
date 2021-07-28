<?php
namespace App\Services;

use App\Repositories\Teacher\TeacherRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherService {
    protected $teacherRepository;

    public function __construct(TeacherRepositoryInterface $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
    }

    public function getAllTeachers() {
        return $this->teacherRepository->getAllTeachers();
    }

    public function getTeacherById($id) {
        return $this->teacherRepository->getTeacherById($id);
    }

    public function getTeacherByUsername($username) {
        return $this->teacherRepository->getTeacherByUsername($username);
    }

    public function createTeacher(Request $request) {
        return $this->teacherRepository->createTeacher($request);
    }

    public function updateTeacher(Request $request) {
        return $this->teacherRepository->updateTeacher($request);
    }

    public function deleteTeacherById($id) {
        return $this->teacherRepository->deleteTeacherById($id);
    }

    public function loginTeacher(Request $request) {
        $status=array("success" => false, "message" => "", "data" => []);
        $teacher = $this->teacherRepository->getTeacherByUsername($request->username);
        if($teacher) {
            if(Hash::check($request->password, $teacher->password)) {
                $status["message"] = "Login Berhasil";
                $status["success"] = true;
                $teacher->role = "teacher";
                unset($teacher->password);
                $status["data"] = $teacher;
            } else {
                $status["message"] = "Password Salah";
            }
        } else {
            $status["message"] = "Username tidak ditemukan";
        }
        return $status;
    }

    public function updateToken(Request $request){
        return $this->teacherRepository->updateToken($request);
    }
}