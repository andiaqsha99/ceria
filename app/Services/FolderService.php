<?php
namespace App\Services;

use App\Repositories\Folder\FolderRepositoryInterface;
use Illuminate\Http\Request;

class FolderService {

    protected $folderRepository;

    public function __construct(FolderRepositoryInterface $folderRepository)
    {
        $this->folderRepository = $folderRepository;
    }

    public function getAllFolder() {
        return $this->folderRepository->getAllFolder();
    }

    public function getFolderById($id) {
        return $this->folderRepository->getFolderById($id);
    }

    public function createFolder(Request $request) {
        return $this->folderRepository->createFolder($request);
    }

    public function updateFolder(Request $request) {
        return $this->folderRepository->updateFolder($request);
    }

    public function deleteFolderById($id) {
        return $this->folderRepository->deleteFolderById($id);
    }
}
