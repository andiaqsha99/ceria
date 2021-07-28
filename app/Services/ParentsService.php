<?php
namespace App\Services;

use App\Repositories\Parents\ParentsRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ParentsService {
    
    protected $parentsRepository;

    public function __construct(ParentsRepositoryInterface $parentsRepository)
    {
        $this->parentsRepository = $parentsRepository;
    }

    public function getAllParents() {
        return $this->parentsRepository->getAllParents();
    }

    public function getParentById($id) {
        return $this->parentsRepository->getParentById($id);
    }

    public function getParentByUsername($username) {
        return $this->parentsRepository->getParentByUsername($username);
    }

    public function createParent(Request $request) {
        return $this->parentsRepository->createParent($request);
    }

    public function updateParent(Request $request) {
        return $this->parentsRepository->updateParent($request);
    }

    public function deleteParentById($id) {
        return $this->parentsRepository->deleteParentById($id);
    }

    public function loginParents(Request $request) {
        $status=array("success" => false, "message" => "", "data" => []);
        $parent = $this->parentsRepository->getParentByUsername($request->username);
        if($parent) {
            if(Hash::check($request->password, $parent->password)) {
                $status["message"] = "Login Berhasil";
                $status["success"] = true;
                $parent->role = "parent";
                unset($parent->password);
                $status["data"] = $parent;
            } else {
                $status["message"] = "Password Salah";
            }
        } else {
            $status["message"] = "Username tidak ditemukan";
        }
        return $status;
    }
}