<?php

namespace App\Services\Category;

use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Category\CategoryRepository;

class CategoryServiceImpl implements CategoryService
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getListCategory()
    {
        $result = $this->categoryRepository->getAllData();
        return $result;
    }

    public function getId($id)
    {
        $result = $this->categoryRepository->findId($id);

        if ($result == null) {
            return "data tidak ditemukan!";
        }

        return $result;
    }

    public function saveData($data)
    {
        $validateData = Validator::make($data, [
            'name' => 'required',
            'keywords' => 'required',
            'meta_desc' => 'required',
        ]);

        if ($validateData->fails()) {
            throw new InvalidArgumentException($validateData->errors()->first());
        }

        $result = $this->categoryRepository->save($data);

        return $result;
    }

    public function updateData($data, $id)
    {
        $validateData = Validator::make($data, [
            'name' => 'required',
            'keywords' => 'required',
            'meta_desc' => 'required',
        ]);

        if ($validateData->fails()) {
            throw new InvalidArgumentException($validateData->errors()->first());
        }

        DB::beginTransaction();

        try {
            $result = $this->categoryRepository->update($data, $id);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::info($th->getMessage());
            throw new InvalidArgumentException('gagal update data!');
        }
        DB::commit();

        return $result;
    }

    public function deleteDataById($id)
    {
        DB::beginTransaction();

        try {
            $result = $this->categoryRepository->delete($id);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::info($th->getMessage());
            throw new InvalidArgumentException('gagal hapus data!');
        }

        DB::commit();

        return $result;
    }
}


