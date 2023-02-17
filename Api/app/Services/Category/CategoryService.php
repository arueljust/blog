<?php

namespace App\Services\Category;

interface CategoryService
{
    public function getListCategory();
    public function getId($id);
    public function saveData($data);
    public function updateData($data, $id);
    public function deleteDataById($id);
}
