<?php
namespace App\Repositories\Teacher;

interface TeacherRepositoryInterface {
    public function getAllTeachers();
    public function getTeacherById($id);
    public function createTeacher($data);
    public function updateTeacher($data);
    public function deleteTeacherById($id);
    public function getTeacherByUsername($username);
    public function updateToken($data);
}