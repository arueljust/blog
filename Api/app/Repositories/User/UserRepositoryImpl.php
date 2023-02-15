<?php
namespace App\Repositories\User;

use App\Models\User;

class UserRepositoryImpl implements UserRepository
{
    private $model;

     public function __construct (User $model)
     {
        $this->model=$model;
     }

    public function getUserId($id)
    {
        return $this->model->where('id',$id)->first();
    }

    public function getListUser()
    {
        return $this->model->all();
    }

}
