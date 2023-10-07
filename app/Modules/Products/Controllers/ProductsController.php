<?php

namespace App\Modules\Products\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FilesModel;
use App\Models\Products\Product;
use App\Models\Products\ProductsType;
use App\Modules\Products\Requests\ProductsStoreRequest;
use App\Modules\Products\Requests\ProductsUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Redirect;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $products = Product::with('type')
            ->orderBy('name')
            ->orderBy('type_id')
            ->get();

        return response()->view('products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $types = ProductsType::select('id as value', 'name as label')->get();

        return response()->view('products.create', [
            'types' => $types
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductsStoreRequest $request): RedirectResponse
    {
        $fields = [
            'name' => $request->post('name'),
            'price' => $request->post('price'),
            'type_id' => $request->post('type_id'),
        ];

        $id = Product::restore(0, $fields);
        $this->saveImage($id, $request->file('image'));

        return Redirect::route('products.create')->with('status', 'product-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): Response
    {
        $product = Product::with('type')->find($id);

        return response()->view('products.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): Response
    {
        $types = ProductsType::select('id as value', 'name as label')->get();
        $product = Product::with('type')->find($id);

        return response()->view('products.edit', [
            'product' => $product,
            'types' => $types
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductsUpdateRequest $request, string $id): RedirectResponse
    {
        $fields = [
            'name' => $request->post('name'),
            'price' => $request->post('price'),
            'type_id' => $request->post('type_id'),
        ];

        Product::restore($id, $fields);

        if ($request->hasFile('image')) {
            $this->saveImage($id, $request->file('image'));
        }

        return Redirect::route('products.edit', $id)->with('status', 'product-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Product::deleteByID($id);

        return redirect()->route('products.index');
    }

    private function saveImage(int $productID, UploadedFile $file): void
    {
        $path = "/products/{$productID}/";
        $fileName = "img.{$file->clientExtension()}";
        FilesModel::putFileAs($path, $file, $fileName);
        Product::restore($productID, [
            'image' => FilesModel::getPathSave($path, $fileName)
        ]);
    }
}
