<?php

namespace App\Services\Customer;


interface CustomerService
{
    public function getListCustomer();
    public function getId($id);
    public function saveData($data);
    public function updateData($data,$id);
    public function deleteById($id);
}
