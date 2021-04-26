<?php
namespace App\Repositories\Folder;

use App\Models\Folder;
use App\Repositories\Folder\FolderRepositoryInterface;

class FolderRepository implements FolderRepositoryInterface {

    public function getAllFolder()
    {
        return Folder::all();
    }

    public function getFolderById($id)
    {
        return Folder::find($id);
    }

    public function createFolder($data)
    {
        return Folder::create([
            'name' => $data->name,
            'description' => $data->description,
            'date_create' => $data->date_create,
            'user_create' => $data->user_create
        ]);
    }

    public function updateFolder($data)
    {
        return Folder::find($data->id)->update([
            'name' => $data->name,
            'description' => $data->description,
            'date_create' => $data->date_create,
            'user_create' => $data->user_create
        ]);
    }

    public function deleteFolderById($id)
    {
        return Folder::find($id)->delete();
    }
}
