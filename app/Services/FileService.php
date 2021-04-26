<?php
namespace App\Services;

use App\Repositories\File\FileRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileService {

    protected $fileRepository;

    public function __construct(FileRepositoryInterface $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    public function getAllFile() {
        return $this->fileRepository->getAllFile();
    }

    public function getFileById($id) {
        return $this->fileRepository->getFileById($id);
    }

    public function createFile(Request $request) {
        foreach($request->file('files') as $file) {
            $path = Storage::put(
                'public/file',
                $file
            );
            $request['path'] = $path;
            $request['name'] = $file->getClientOriginalName();
            $file = $this->fileRepository->createFile($request);
        }
        return $file;
    }

    public function updateFile(Request $request) {
        return $this->fileRepository->updateFile($request);
    }

    public function deleteFileById($id) {
        return $this->fileRepository->deleteFileById($id);
    }

    public function deleteMultipleFileById($ids) {
        foreach($ids as $id) {
            $file = $this->fileRepository->deleteFileById($id);
        }

        return $file;
    }

    public function getFileByFolderId($id) {
        return $this->fileRepository->getFileByFolderId($id);
    }
}
