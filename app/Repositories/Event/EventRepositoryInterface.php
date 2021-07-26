<?php

namespace App\Repositories\Event;

interface EventRepositoryInterface {
    public function index();
    public function show($id);
    public function store($data);
    public function update($data);
    public function destroy($id);
    public function  getEventsByClassId($id);
}