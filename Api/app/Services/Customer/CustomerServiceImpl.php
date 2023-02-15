<?php

namespace App\Services\Customer;

use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Customer\CustomerRepository;

class CustomerServiceImpl implements CustomerService
{
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }


    public function getListCustomer()
    {
        $result = $this->customerRepository->getAllData();
        return $result;
    }


    public function getId($id)
    {

        $result = $this->customerRepository->findId($id);

        if ($result == null) {
            return "data tidak ditemukan !";
        }

        return $result;
    }

    public function saveData($data)
    {
        $validateData = Validator::make($data, [
            'name' => 'required',
            'address' => 'required',
            'no_telp' => 'required',
        ]);

        if ($validateData->fails()) {
            throw new InvalidArgumentException($validateData->errors()->first());
        }

        $result = $this->customerRepository->save($data);

        return $result;
    }

    public function updateData($data, $id)
    {
        $validateData = Validator::make($data, [
            'name' => 'required',
            'address' => 'required',
            'no_telp' => 'required',
        ]);

        if ($validateData->fails()) {
            throw new InvalidArgumentException($validateData->errors()->first());
        }

        DB::beginTransaction();

        try {
            $result = $this->customerRepository->update($data, $id);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::info($th->getMessage());
            throw new InvalidArgumentException('gagal update data!');
        }

        DB::commit();

        return $result;
    }

    public function deleteById($id)
    {
        DB::beginTransaction();

        try {
            $result=$this->customerRepository->delete($id);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::info($th->getMessage());
            throw new InvalidArgumentException('gagal hapus data!');
        }

        DB::commit();

        return $result;
    }
}
