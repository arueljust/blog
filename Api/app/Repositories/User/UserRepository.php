<?php

namespace App\Repositories\User;

interface UserRepository
{
    public function getUserId($id);

    public function getListUser();
}
