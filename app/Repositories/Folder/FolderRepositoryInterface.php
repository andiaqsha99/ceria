<?php

namespace App\Repositories\Folder;

interface FolderRepositoryInterface {
    public function getAllFolder();
    public function getFolderById($id);
    public function createFolder($data);
    public function updateFolder($data);
    public function deleteFolderById($id);
}
