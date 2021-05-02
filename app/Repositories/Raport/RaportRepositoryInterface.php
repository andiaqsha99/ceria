<?php

namespace App\Repositories\Raport;

interface RaportRepositoryInterface {
    public function getAllRaport();
    public function getRaportById($id);
    public function createRaport($data);
    public function updateRaport($data);
    public function deleteRaportById($id);
    public function getRaportByNis($nis);
    public function getRaportDateByNis($nis);
    public function getRaportByNisAndDate($nis, $date);
}
