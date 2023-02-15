<?php

namespace App\Repositories\Customer;

use Illuminate\Support\Facades\Request;


interface CustomerRepository
{
    public function getAllData();
    public function findId($id);
    public function save($data);
    public function update($data,$id);
    public function delete($id);
}
