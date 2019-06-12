<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCheckRequest;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductFilterRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Model\Product;
use App\Model\ProductCategory;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductCategory\ProductCategoryRepositoryInterface;
use App\Services\ProductCategoryInteractionService;
use App\Services\ProductFilterService;

class ProductController extends Controller
{
    /**
     * ProductCategories repository.
     *
     * @var ProductCategoryRepositoryInterface
     */
    private $productCategories;

    /**
     * Product repository.
     *
     * @var ProductRepositoryInterface
     */
    private $products;

    /**
     * Product service.
     *
     * @var ProductCategoryInteractionService
     */
    private $productCategoryServices;

    /**
     * Create a new ProductController instance.
     *
     * @param ProductCategoryRepositoryInterface $productCategories
     * @param ProductRepositoryInterface $products
     * @param ProductCategoryInteractionService $productCategoryServices
     */
    public function __construct(
        ProductCategoryRepositoryInterface $productCategories,
        ProductRepositoryInterface $products,
        ProductCategoryInteractionService $productCategoryServices
    ) {
        parent::__construct();
        $this->middleware('permission',
            ['only' => ['store', 'update', 'destroy']]
        );
        $this->productCategories = $productCategories;
        $this->products = $products;
        $this->productCategoryServices = $productCategoryServices;
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
        $this->productCategoryServices
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
        $product = $this->products->getEdit($id);

        if (empty($product)) {
            return response()
                ->json(['error' => 'product not found'], 404);
        }
        $data = $request->except(['category_ids']);
        $product->update($data);
        // Create new product categories.
        $this->productCategoryServices
            ->createProductCategories($product->id, $request['category_ids']);

        return response()
            ->json(['message' => 'OK'], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
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
            ->productCategories
            ->getProductIds($request['id']);
        $products = $this->products->getProducts($product_ids);

        return ProductResource::collection($products);
    }

    /**
     * Filter products by their properties.
     *
     * @param ProductFilterRequest $request
     * @param ProductFilterService $filters
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function filter(ProductFilterRequest $request, ProductFilterService $filters)
    {
        $products = $this->products->getFilter()->filter($filters)->get();

        return ProductResource::collection($products);
    }
}
