<?php
namespace App\Repositories\File;

use App\Models\File;
use App\Repositories\File\FileRepositoryInterface;

class FileRepository implements FileRepositoryInterface {

    public function getAllFile()
    {
        return File::all();
    }

    public function getFileById($id)
    {
        return File::find($id);
    }

    public function createFile($data)
    {
        return File::create([
            'name' => $data->name,
            'path' => $data->path,
            'date_upload' => $data->date_upload,
            'user_upload' => $data->user_upload,
            'id_folder' => $data->id_folder
        ]);
    }

    public function updateFile($data)
    {
        return File::find($data->id)->update([
            'name' => $data->name,
            'path' => $data->path,
            'date_upload' => $data->date_upload,
            'user_upload' => $data->user_upload,
            'id_folder' => $data->id_folder
        ]);
    }

    public function deleteFileById($id)
    {
        return File::find($id)->delete();
    }

    public function getFileByFolderId($id)
    {
        return File::where('id_folder', $id)->get();
    }
}
