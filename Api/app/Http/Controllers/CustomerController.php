<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Repositories\Customer\CustomerRepository;
use App\Services\Customer\CustomerService;

class CustomerController extends Controller
{
    private $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }


    public function getAllDataCustomer()
    {
        $result = $this->customerService->getListCustomer();

        return response()->json([
            'message' => 'data berhasil didapat!',
            'status' => 200,
            'data' => $result,
        ]);
    }


    public function getCustomerId($id)
    {
        $result = $this->customerService->getId($id);

        return response()->json([
            'message' => 'data berhasil didapat!',
            'status' => 200,
            'data' => $result,
        ]);
    }


    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'address',
            'no_telp',
        ]);

        $res = ['status' => 201];

        try {

            $result['data'] = $this->customerService->saveData($data);
        } catch (\Throwable $th) {
            $result = [
                'status' => 500,
                'error' => $th->getMessage(),
            ];
        }
        return response()->json($result, $res['status']);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only([
            'name',
            'address',
            'no_telp',
            'active',
        ]);

        $res = ['status' => 201];

        try {

            $result['data'] = $this->customerService->updateData($data, $id);
        } catch (\Throwable $th) {
            $result = [
                'status' => 500,
                'error' => $th->getMessage(),
            ];
        }
        return response()->json($result, $res['status']);
    }

    public function destroy($id)
    {
        try {
            $result['data'] = $this->customerService->deleteById($id);
        } catch (\Throwable $th) {
            $result = [
                'status' => 500,
                'error' => $th->getMessage(),
            ];
        }

        return response()->json([
            'status' => 200,
            'message' => 'data berhasil dihapus!',
            'cache' => $result
        ]);
    }
}
