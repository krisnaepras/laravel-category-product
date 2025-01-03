<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ImageService;
use App\Services\ProductService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;


class ProductController extends Controller
{
    public function __construct(private ProductService $productService, private ImageService $imageService){}
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

        try {
            $uploadImg = $this->imageService->uploadImg($data);
            $data['image'] = $uploadImg;

            $this->productService->create($data);

            return response()->json(['message' => 'Product created successfully']);
        } catch (Exception $e) {
            return response()->json(['title' => 'Error','text' => $e->getMessage(), 'icon' => 'error']);
        }
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
    public function update(UpdateProductRequest $request, string $id)
    {
        $data = $request->validated();

        $getImage = $this->productService->getByUuid($id);

        try{
            $uploadImg = $this->imageService->uploadImg($data, $getImage->image);
            $data['image'] = $uploadImg;

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
