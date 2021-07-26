<?php

namespace App\Repositories\GroupChat;

interface GroupChatRepositoryInterface {
    public function index();
    public function show($id);
    public function store($data);
    public function update($data);
    public function destroy($id);
    public function  getGroupChatByClassId($id);
}