<?php
namespace App\Services;

use App\Repositories\GroupChat\GroupChatRepositoryInterface;
use Illuminate\Http\Request;

class GroupChatService {

    protected $groupChatRepository;

    public function __construct(GroupChatRepositoryInterface $groupChatRepository)
    {
        $this->groupChatRepository = $groupChatRepository;
    }

    public function getAllGroupChat() {
        return $this->groupChatRepository->index();
    }

    public function getGroupChatById($id) {
        return $this->groupChatRepository->show($id);
    }

    public function getGroupChatByClassId($id) {
        return $this->groupChatRepository->getGroupChatByClassId($id);
    }

    public function createGroupChat(Request $request) {
        return $this->groupChatRepository->store($request);
    }

    public function updateGroupChat(Request $request) {
        return $this->groupChatRepository->update($request);
    }

    public function deleteGroupChatById($id) {
        return $this->groupChatRepository->destroy($id);
    }
}