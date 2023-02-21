<?php

namespace App\Repositories\Post;

interface PostRepository
{
    public function getAllData();
    public function findId($id);
    public function save($data);
}
