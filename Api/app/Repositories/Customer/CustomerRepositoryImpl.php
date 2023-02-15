<?php


namespace App\Repositories\Customer;

use App\Models\Customer;
use Illuminate\Support\Facades\Request;

class CustomerRepositoryImpl implements CustomerRepository
{
    private $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function getAllData()
    {
        $dataCustomer = $this->customer->orderBy('name')
            ->get()
            ->map(function ($data) {
                return $this->formater($data);
            });

        return $dataCustomer;
    }

    public function findId($id)
    {
        $result = $this->customer->where('id', $id)->first();

        if ($result == null) {
            return null;
        }

        return $this->formater($result);
    }

    public function formater($data)
    {
        return
            [
                'id_customer' => $data->id,
                'nama_customer' => $data->name,
                'alamat' => $data->address,
                'nomor_telp' => $data->no_telp,
                'status' => $data->active ? 'aktif' : 'tidak aktif',
            ];
    }

    public function save($data)
    {
        $customer = new $this->customer;

        $customer->name = $data['name'];
        $customer->address = $data['address'];
        $customer->no_telp = $data['no_telp'];

        $customer->save();


        return $data;
    }

    public function update($data,$id)
    {
        $customer = $this->customer->find($id);

        $customer->name = $data['name'];
        $customer->address = $data['address'];
        $customer->no_telp = $data['no_telp'];
        $customer->active = $data['active'];

        $customer->update();


        return $data;
    }

    public function delete($id)
    {
        $customer=$this->customer->find($id);
        $customer->delete();

        return $customer;
    }
}
