<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\Tag\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    private $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function getAllDataTag()
    {
        $data = $this->tagService->getListTag();

        return response()->json([
            'status' => 200,
            'message' => 'data berhasil didapat',
            'data' => $data
        ]);
    }

    public function getTagId($id)
    {
        $result = $this->tagService->getId($id);

        return response()->json([
            'status' => 200,
            'message' => 'data berhasil didapat',
            'data' => $result
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'keywords',
            'meta_desc',
        ]);
        $res = ['status' => 201];
        try {
            $result['data'] = $this->tagService->saveData($data);
        } catch (\Throwable $th) {
            $result = [
                'status' => 500,
                'message' => $th->getMessage()
            ];
        }

        return response()->json($result);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only([
            'name',
            'keywords',
            'meta_desc',
        ]);
        $res = ['status' => 201];
        try {
            $result['data'] = $this->tagService->updateData($data, $id);
        } catch (\Throwable $th) {
            $result = [
                'status' => 500,
                'message' => $th->getMessage()
            ];
        }

        return response()->json($result);
    }

    public function destroy($id)
    {
        try {
            $result['data'] = $this->tagService->deleteDataById($id);
        } catch (\Throwable $th) {
            $result = [
                'status' => 500,
                'message' => $th->getMessage()
            ];
        }

        return response()->json($result);
    }
}
