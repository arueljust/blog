<?php

namespace App\Repositories\Tag;

use App\Models\Tag;
use Illuminate\Support\Str;

class TagRepositoryImpl implements TagRepository
{
    private $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function getAllData()
    {
        $data = $this->tag->orderBy('name')->get();

        return $data;
    }

    public function findId($id)
    {
        $result = $this->tag->where('_id', $id)->first();

        if ($result == null) {
            return null;
        }

        return $result;
    }

    public function save($data)
    {
        $tag = new $this->tag;

        $tag->name = $data['name'];
        $tag->slug = Str::slug($data['name']);
        $tag->keywords = $data['keywords'];
        $tag->meta_desc = $data['meta_desc'];
        $tag->save();

        return $data;
    }

    public function update($data, $id)
    {
        $tag = $this->tag->find($id);

        $tag->name = $data['name'];
        $tag->slug = Str::slug($data['name']);
        $tag->keywords = $data['keywords'];
        $tag->meta_desc = $data['meta_desc'];
        $tag->update();

        return $data;
    }

    public function delete($id)
    {
        $tag = $this->tag->find($id);
        $tag->delete();

        return $tag;
    }
}
