<?php
namespace App\Repositories\Kelas;

use App\Models\Kelas;
use App\Repositories\Kelas\KelasRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class KelasRepository implements KelasRepositoryInterface {

    public function getAllKelas()
    {
        return Kelas::all();
    }

    public function getKelasById($id)
    {
        return Kelas::find($id);
    }

    public function createKelas($data)
    {
        $path = Storage::put(
            'public/file',
            $data->file('foto')
        );

        return Kelas::create([
			'kelas' => $data->kelas,
			'thn_akademik' => $data->thn_akademik,
			'status' => $data->status,
            'nomor_pegawai' => $data->nomor_pegawai,
            'foto' => $path,
            'deskripsi' => $data->deskripsi,
            'periode_awal' => $data->periode_awal,
            'periode_akhir'=> $data->periode_akhir
		]);
    }

    public function updateKelas($data)
    {
        return Kelas::find($data->id)->update([
			'kelas' => $data->kelas,
			'thn_akademik' => $data->thn_akademik,
			'status' => $data->status,
			'nomor_pegawai' => $data->nomor_pegawai
		]);
    }

    public function deleteKelasById($id)
    {
        $kelas = Kelas::find($id);
        $kelas->delete();
        return $kelas;
    }

    public function getKelasByTeacherId($id)
    {
        return Kelas::where('nomor_pegawai', $id)->get();
    }
}