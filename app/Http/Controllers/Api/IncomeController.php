<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Income\IncomeResource;
use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->query('limit') && $request->query('limit') < 100 ? $request->query('limit') : 10;

        $sort_column = $request->query('sort_column', 'id');
        $sort_order = $request->query('sort_order', 'desc');

        $title = $request->query('title');

        $date_start = $request->query('date_start');
        $date_end = $request->query('date_end');

        $amount_start = $request->query('amount_start');
        $amount_end = $request->query('amount_end');

        $category_id = $request->query('category');

        $incomes = Income::query();

        $incomes->when($title, function ($query, $title) {
            $query->where('title', 'LIKE', '%'.$title.'%');
        })
            ->when($date_start, function ($query, $date_start) {
                $query->whereDate('date', '>=', $date_start);
            })
            ->when($date_end, function ($query, $date_end) {
                $query->whereDate('date', '>=', $date_end);
            })
            ->when($amount_start, function ($query, $amount_start) {
                $query->where('amount', '>=', $amount_start);
            })
            ->when($amount_end, function ($query, $amount_end) {
                $query->where('amount', '>=', $amount_end);
            })
            ->when($category_id, function ($query, $category_id) {
                $query->whereHas('categories', function ($query) use ($category_id) {
                    $query->where('category_id', $category_id)
                        ->where('category_type', 'income');
                });
            });

        $incomes = $incomes->orderBy($sort_column, $sort_order)->with('categories')->paginate($limit);

        return IncomeResource::collection($incomes);
    }

    // public function show($brand_id)
    // {
    //     $this->authorize('view_brand');

    //     $brand = Brand::where('id', $brand_id)->withMedia(['logo'])->first();

    //     return new BrandResource($brand);
    // }

    // public function store(CreateBrandRequest $request)
    // {
    //     try {
    //         Brand::create($request->validated())
    //             ->attachMedia($request->logo, 'logo');
    //     } catch (Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'failed to create brand',
    //         ], 500);
    //     }

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'brand created succesfully',
    //     ], 201);
    // }

    // public function update(UpdateBrandRequest $request, $brand_id)
    // {

    //     try {

    //         $brand = Brand::find($brand_id);
    //         $brand->update($request->validated());
    //         $brand->detachMediaTags('logo');
    //         $brand->attachMedia($request->logo, 'logo');

    //     } catch (Exception $e) {

    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'failed to update brand',
    //         ], 500);

    //     }

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'brand updated succesfully',
    //     ], 200);
    // }

    // public function delete($ids)
    // {
    //     $this->authorize('delete_brand');

    //     $ids = explode(',', $ids);

    //     try {
    //         Brand::destroy($ids);
    //     } catch (Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'failed to delete brand',
    //         ], 500);
    //     }

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'brand deleted succesfully',
    //     ], 204);
    // }
}
