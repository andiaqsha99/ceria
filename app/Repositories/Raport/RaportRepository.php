<?php
namespace App\Repositories\Raport;

use App\Repositories\Raport\RaportRepositoryInterface;
use App\Models\Raport;

class RaportRepository implements RaportRepositoryInterface {
    public function getAllRaport()
    {
        return Raport::all();
    }

    public function getRaportById($id)
    {
        return Raport::find($id);
    }

    public function createRaport($data)
    {
        return Raport::create([
            'nilai' => $data->nilai,
            'date_created' => $data->date_created,
            'nis' => $data->nis,
            'id_tema' => $data->id_tema,
            'id_subtema' => $data->id_subtema,
            'id_indicator' => $data->id_indicator
        ]);
    }

    public function updateRaport($data)
    {
        return Raport::find($data->id)->update([
            'nilai' => $data->nilai,
            'date_created' => $data->date_created,
            'nis' => $data->nis,
            'id_tema' => $data->id_tema,
            'id_subtema' => $data->id_subtema,
            'id_indicator' => $data->id_indicator
        ]);
    }

    public function deleteRaportById($id)
    {
        return Raport::find($id)->delete();
    }

    public function getRaportByNis($nis)
    {
        return Raport::where('nis', $nis)->get();
    }

    public function getRaportDateByNis($nis)
    {
        return Raport::select('date_created')->where('nis', $nis)->distinct()->get();
    }

    public function getRaportByNisAndDate($nis, $date)
    {
        return Raport::where('nis', $nis)->where('date_created', $date)->get();
    }
}
