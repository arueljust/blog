<?php

namespace App\Services\Tag;

interface TagService
{
    public function getListTag();
    public function getId($id);
    public function saveData($data);
    public function updateData($data, $id);
    public function deleteDataById($id);
}
