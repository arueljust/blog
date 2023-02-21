<?php

namespace App\Services\Post;

interface PostService
{
    public function getListPost();
    public function getId($id);
    public function saveData($data);
}
