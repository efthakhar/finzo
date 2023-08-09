<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryDropdownResource;
use App\Models\Category;

class IncomeCategoryController extends Controller {
	public function getIncomeCategoryList() {
		return CategoryDropdownResource::collection(Category::where('category_type', 'income')->get());
	}
}
