<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCheckRequest;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductFilterRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Model\Product;
use App\Model\ProductCategory;
use App\Repositories\Product\ProductRepository;
use App\Repositories\ProductCategory\ProductCategoryRepository;
use App\Services\ProductCategoryInteractionService;
use App\Services\ProductFilterService;

class ProductController extends Controller
{
    private $productCategoryRepository;
    private $productRepository;
    private $productCategoryInteractionService;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('permission',
            ['only' => ['store', 'update', 'destroy']]
        );
        $this->productCategoryRepository = app(ProductCategoryRepository::class);
        $this->productRepository = app(ProductRepository::class);
        $this->productCategoryInteractionService =
            app(ProductCategoryInteractionService::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        $data = $request->all();
        $product = Product::create($data);

        // Create new product categories.
        $this->productCategoryInteractionService
            ->createProductCategories($product->id, $request['category_ids']);

        return response()
            ->json(new ProductResource($product), 201);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $product = $this->productRepository->getEdit($id);

        if (empty($product)) {
            return response()
                ->json(['error' => 'product not found'], 404);
        }
        $data = $request->except(['category_ids']);
        $product->update($data);
        // Delete old product categories.
        ProductCategory::where('product_id', $product->id)->delete();
        // Create new product categories.
        $this->productCategoryInteractionService
            ->createProductCategories($product->id, $request['category_ids']);

        return response()
            ->json(['message' => 'OK'], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Product::destroy($id);

        if ($result) {
            return response()
                ->json(['message' => 'OK'], 200);
        }
        else {
            return response()
                ->json(['error' => 'category not found'], 404);
        }
    }

    /**
     * Display resource by category_id.
     *
     * @param CategoryCheckRequest $request
     * @return mixed
     */
    public function getProductsByCategory(CategoryCheckRequest $request)
    {
        $product_ids  = $this
            ->productCategoryRepository
            ->getProductIds($request['id']);
        $products = $this->productRepository->getProducts($product_ids);

        return ProductResource::collection($products);
    }

    public function filter(ProductFilterRequest $request)
    {
        $products = $this->productRepository->getFilter();

        $result = (new ProductFilterService($products, $request->all()))->filter()->get();

        return ProductResource::collection($result);
    }
}
