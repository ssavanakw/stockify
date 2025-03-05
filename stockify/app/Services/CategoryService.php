<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function createCategory(array $data)
    {
        return Category::create($data);
    }

    public function getAllCategories()
    {
        return Category::all();
    }
}
