<?php

namespace App\Repositories\Category;


interface CategoryRepository
{
    public function getAllData();
    public function findId($id);
    public function save($data);
    public function update($data, $id);
    public function delete($id);
}
