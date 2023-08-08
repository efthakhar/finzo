<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;

class IncomeCategoryController extends Controller
{
    public function getIncomeCategoryList()
    {
        return CategoryResource::collection(Category::where('category_type', 'income')->get());
    }
}
