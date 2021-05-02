<?php
namespace App\Services;

use App\Repositories\Subtema\SubtemaRepositoryInterface;
use Illuminate\Http\Request;

class SubtemaService {
    protected $subtemaRepository;

    public function __construct(SubtemaRepositoryInterface $subtemaRepository)
    {
        $this->subtemaRepository = $subtemaRepository;
    }

    public function getAllSubtemas() {
        return $this->subtemaRepository->getAllSubtema();
    }

    public function getSubtemaById($id) {
        return $this->subtemaRepository->getSubtemaById($id);
    }

    public function createSubtema(Request $request) {
        return $this->subtemaRepository->createSubtema($request);
    }

    public function updateSubtema(Request $request) {
        return $this->subtemaRepository->updateSubtema($request);
    }

    public function deleteSubtemaById($id) {
        return $this->subtemaRepository->deleteSubtemaById($id);
    }

    public function getSubtemaByTema($id) {
        return $this->subtemaRepository->getSubtemaByTema($id);
    }
}
