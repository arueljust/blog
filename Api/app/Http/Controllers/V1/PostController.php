<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\Post\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function getAllDataPost()
    {
        $data = $this->postService->getListPost();

        return response()->json([
            'status' => 200,
            'message' => 'data berhasil didapat!',
            'data' => $data
        ]);
    }

    public function getPostId($id)
    {
        $data = $this->postService->getId($id);

        return response()->json([
            'status' => 200,
            'message' => 'data berhasil didapat!',
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        try {
            $result = $this->postService->saveData($data);
        } catch (\Throwable $th) {
            $result = [
                "status" => 500,
                "message" => $th->getMessage()
            ];
        }
        return $result;
    }
}
