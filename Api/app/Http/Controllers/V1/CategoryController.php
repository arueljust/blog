<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Category\CategoryService;

class CategoryController extends Controller
{

    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function getAllDataCategories()
    {
        $data = $this->categoryService->getListCategory();

        return response()->json([
            'status' => 200,
            'message' => 'data berhasil didapat',
            'data' => $data
        ]);
    }

    public function getCategoryId($id)
    {
        $result = $this->categoryService->getId($id);

        return response()->json([
            'status' => 200,
            'message' => "data berhasil didapat",
            'data' => $result
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'slug',
            'keywords',
            'meta_desc',
        ]);

        $res = ['status' => 201];

        try {
            $result['data'] = $this->categoryService->saveData($data);
        } catch (\Throwable $th) {
            $result = [
                'status' => 500,
                'error' => $th->getMessage()
            ];
        }

        return response()->json($result, $res['status']);
    }
}
