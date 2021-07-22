<?php
namespace App\Services;

use App\Repositories\Child\ChildRepositoryInterface;
use Illuminate\Http\Request;

class ChildService {
    protected $childRepository;

    public function __construct(ChildRepositoryInterface $childRepository)
    {
        $this->childRepository = $childRepository;
    }

    public function getAllChild() {
        return $this->childRepository->getAllChild();
    }

    public function getChildById($id) {
        return $this->childRepository->getChildById($id);
    }

    public function createChild(Request $request) {
        return $this->childRepository->createChild($request);
    }

    public function updateChild(Request $request) {
        return $this->childRepository->updateChild($request);
    }

    public function deleteChildById($id) {
        return $this->childRepository->deleteChildById($id);
    }

    public function getChildByParentId($id) {
        return $this->childRepository->getChildByParentId($id);
    }

    public function getChildByClassId($id) {
        return $this->childRepository->getChildByClassId($id);
    }

    public function updateToken(Request $request){
        return $this->childRepository->updateToken($request);
    }
}