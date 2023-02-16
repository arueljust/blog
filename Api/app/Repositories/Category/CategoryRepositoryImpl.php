<?php

namespace App\Repositories\Category;

use App\Models\Categories;

class CategoryRepositoryImpl implements CategoryRepository
{
    private $categories;

    public function __construct(Categories $categories)
    {
        $this->categories = $categories;
    }

    public function getAllData()
    {
        $data = $this->categories->orderBy('name')->get();

        return $data;
    }

    public function findId($id)
    {
        $result = $this->categories->where('_id', $id)->first();

        if ($result == null) {
            return null;
        }
        return $result;
    }

    public function save($data)
    {
        $category = new $this->categories;

        $category->name = $data['name'];
        $category->slug = $data['slug'];
        $category->keywords = $data['keywords'];
        $category->meta_desc = $data['meta_desc'];

        $category->save();

        return $data;
    }
}
