<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class IncomeCategoryController extends Controller
{
    public function getIncomeCategoryList() {
        return new CategoryResource(Category::where('category_type', 'income')->get());
    }
}
