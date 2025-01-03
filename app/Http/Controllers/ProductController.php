<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;


class ProductController extends Controller
{
    public function __construct(private ProductService $productService){}
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

        $this->productService->create($data);

        return response()->json(['message' => 'Product created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            return response()->json([
                'data' => $this->productService->getByUuid($id)
            ]);
        } catch (Exception $e) {
            //throw $th;
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $data = $request->validated();
        try{
            $this->productService->update($data, $id);
            return response()->json(['title' => 'Good Job','text' => 'Product updated successfully', 'icon' => 'success']);

        } catch (Exception $e) {
            return response()->json(['title' => 'Error','text' => $e->getMessage(), 'icon' => 'error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $this->productService->delete($id);
        return response()->json(['message' => 'Product deleted successfully']);

    }

    public function serversideTable(): JsonResponse
    {
        return $this->productService->getDatatable();
    }
}
