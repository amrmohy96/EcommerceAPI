<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProduct;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')
            ->except('index', 'show');
    }

    public function index()
    {
        return ProductCollection::collection(Product::paginate(10));
        //return new ProductCollection(Product::all());
    }


    public function create()
    {
        //
    }


    public function store(StoreUpdateProduct $request)
    {
        $product = Product::create($request->all());
        return response([
            'data' => new ProductResource($product)
        ], Response::HTTP_CREATED);
    }


    public function show(Product $product)
    {
        return new ProductResource($product);
    }


    public function edit(Product $product)
    {
        //
    }


    public function update(StoreUpdateProduct $request, Product $product)
    {
        $product->update($request->all());
        return response([
            'data' => new ProductResource($product)
        ], Response::HTTP_CREATED);
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
