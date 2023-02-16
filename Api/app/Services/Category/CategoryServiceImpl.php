<?php

namespace App\Services\Category;

use App\Repositories\Category\CategoryRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

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
        $validateData = Validator::make($data,[
            'name' => 'required',
            'slug' => 'required',
            'keywords' => 'required',
            'meta_desc' => 'required',
        ]);

        if ($validateData->fails()) {
            throw new InvalidArgumentException($validateData->errors()->first());
        }

        $result = $this->categoryRepository->save($data);

        return $result;
    }
}
