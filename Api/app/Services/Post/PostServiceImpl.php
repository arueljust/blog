<?php

namespace App\Services\Post;

use App\Repositories\Post\PostRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class PostServiceImpl implements PostService
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getListPost()
    {
        $result = $this->postRepository->getAllData();
        return $result;
    }

    public function getId($id)
    {
        $result = $this->postRepository->findId($id);

        if ($result == null) {
            return "data tidak ditemukan!";
        }
        return $result;
    }

    public function saveData($data)
    {
        $validateData = Validator::make($data, [
            'title' => 'required|unique:posts,title',
            'cover' => 'required',
            'desc' => 'required',
            'category' => 'required',
            'tags' => 'array|required',
            'keywords' => 'required',
            'meta_desc' => 'required',
        ]);

        if ($validateData->fails()) {
            throw new InvalidArgumentException($validateData->errors()->first());
        }

        $result = $this->postRepository->save($data);
        return $result;
    }
}
