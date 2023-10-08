<?php

namespace App\Modules\ProductsTypes\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FilesModel;
use App\Modules\ProductsTypes\Models\ProductsType;
use App\Modules\ProductsTypes\Requests\ProductsTypesStoreRequest;
use App\Modules\ProductsTypes\Requests\ProductsTypesUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Redirect;

class ProductsTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $productTypes = ProductsType::orderBy('name')->get();

        return response()->view('products_types.index', [
            'types' => $productTypes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('products_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductsTypesStoreRequest $request): RedirectResponse
    {
        $fields = [
            'name' => $request->post('name'),
        ];

        $id = ProductsType::restore(0, $fields);

        $this->saveImage($id, $request->file('image'));

        return Redirect::route('products_types.create')->with('status', 'products_type-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): Response
    {
        $type = ProductsType::find($id);

        return response()->view('products_types.show', [
            'type' => $type
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): Response
    {
        $type = ProductsType::find($id);

        return response()->view('products_types.edit', [
            'type' => $type
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductsTypesUpdateRequest $request, string $id): RedirectResponse
    {
        $fields = [
            'name' => $request->post('name'),
        ];

        ProductsType::restore($id, $fields);

        if ($request->hasFile('image')) {
            $this->saveImage($id, $request->file('image'));
        }

        return Redirect::route('products_types.edit', $id)->with('status', 'products_type-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {

        ProductsType::deleteByID($id);

        return redirect()->route('products_types.index');
    }

    private function saveImage(int $typeID, UploadedFile $file): void
    {
        $path = "/products_types/{$typeID}/";
        $fileName = "img.{$file->clientExtension()}";
        FilesModel::putFileAs($path, $file, $fileName);
        ProductsType::restore($typeID, [
            'image' => FilesModel::getPathSave($path, $fileName)
        ]);
    }
}
