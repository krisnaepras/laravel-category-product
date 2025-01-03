<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('products.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request):JsonResponse
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($data['name']);
        Product::create($data);

        return response()->json(['message' => 'Product created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'data' => Product::find($id)
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        Product::destroy($id);

        return response()->json(['message' => 'Product deleted successfully']);

    }

    public function serversideTable(Request $request)
    {
        $product = Product::get();

        return DataTables::of($product)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            return '<div class="text-center">
                        <button class="btn btn-sm btn-success" onclick="editModal(this)" data-id="' . $row->id . '">Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="deleteModal(this)" data-id="' . $row->id . '">Delete</button>
                    </div>';
        })
        ->make();
    }
}
