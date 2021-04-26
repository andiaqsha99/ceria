<?php

namespace App\Repositories\File;

interface FileRepositoryInterface {
    public function getAllFile();
    public function getFileById($id);
    public function createFile($data);
    public function updateFile($data);
    public function deleteFileById($id);
    public function getFileByFolderId($id);
}
