<?php
namespace App\Repositories\Child;

use App\Models\Child;
use App\Repositories\Child\ChildRepositoryInterface;

class ChildRepository implements ChildRepositoryInterface {

    public function getAllChild()
    {
        return Child::all();
    }

    public function getChildById($id)
    {
        return Child::find($id);
    }

    public function createChild($data)
    {
        return Child::create([
            'nomor_induk' => $data->nomor_induk,
            'nik_parent' => $data->nik_parent,
            'id_kelas' => $data->id_kelas,
            'nama' => $data->nama
        ]);
    }

    public function updateChild($data)
    {
        return Child::find($data->nomor_induk)->update([
            'nomor_induk' => $data->nomor_induk,
            'nik_parent' => $data->nik_parent,
            'id_kelas' => $data->id_kelas,
            'nama' => $data->nama,
            'notification_token'=>$data->notification_token
        ]);
    }

    public function updateToken($data)
    {
        return Child::where('nik_parent', $data->nik_parent)->update([
            'notification_token' => $data->notification_token,
        ]);
    }

    public function deleteChildById($id)
    {
        $child = Child::find($id);
        $child->delete();
        return $child;
    }

    public function getChildByParentId($id)
    {
        return Child::where('nik_parent', $id)->first();
    }

    public function getChildByClassId($id)
    {
        return Child::where('id_kelas', $id)->get();
    }
}