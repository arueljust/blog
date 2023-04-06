<?php

namespace App\Repositories\Post;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostRepositoryImpl implements PostRepository
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getAllData()
    {
        $data = $this->post->orderBy('name')->get();

        return $data;
    }

    public function findId($id)
    {
        $result = $this->post->where('_id', $id)->first();

        if ($result == null) {
            return null;
        }

        return $result;
    }

    public function save($data)
    {
        $post = new $this->post;

        $post->title = $data['title'];
        if (isset($data['cover'])){
            $cover = $data['cover'];
            $filename = time() . '_' . $cover->getClientOriginalName();
            $cover->storeAs('public/images', $filename);
            $post->cover = $filename;
        }
        $post->desc = $data['desc'];
        $post->category = $data['category'];
        $post->user_id = Auth::user()->_id;
        $post->tags = $data['tags'];
        $post->keywords = $data['keywords'];
        $post->meta_desc = $data['meta_desc'];

        $post->save();

        return $data;
    }

}
