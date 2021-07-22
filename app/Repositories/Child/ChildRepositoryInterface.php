<?php

namespace App\Repositories\Child;

interface ChildRepositoryInterface {
    public function getAllChild();
    public function getChildById($id);
    public function createChild($data);
    public function updateChild($data);
    public function deleteChildById($id);
    public function getChildByParentId($id);
    public function getChildByClassId($id);
    public function updateToken($data);
}