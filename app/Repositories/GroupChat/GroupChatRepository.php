<?php
namespace App\Repositories\GroupChat;
use App\Repositories\GroupChat\GroupChatRepositoryInterface;
use App\Models\GroupChat;

class GroupChatRepository implements GroupChatRepositoryInterface {
    
    public function index(){
        return GroupChat::all();
    }

    public function show($id){
        return GroupChat::find($id);
    }
    public function store($data){
        return GroupChat::create([
            'name' => $data->name,
            'id_class'=>$data->id_class,
            'date' => $data->date,
            'text' => $data->text,
            'id_sender' => $data->id_sender
        ]);
    }
    public function update($data){
        return GroupChat::find($data->id)->update([
            'name' => $data->name,
            'id_class'=>$data->id_class,
            'date' => $data->date,
            'text' => $data->text,
            'id_sender' => $data->id_sender
        ]);
    }
    public function destroy($id){
        return $event = GroupChat::find($id)->delete();

    }
    public function  getGroupChatByClassId($id){
        return GroupChat::where('id_class', $id)->get();
    }
}