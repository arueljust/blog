<?php

namespace App\Repositories\Tag;

interface TagRepository
{
    public function getAllData();
    public function findId($id);
    public function save($data);
    public function update($data, $id);
    public function delete($id);
}
