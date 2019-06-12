<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryController extends Controller
{

    /**
     * Categories Repository.
     *
     * @var CategoryRepositoryInterface
     */
    private $categories;

    /**
     * Create a new CategoryController instance.
     *
     * @param CategoryRepositoryInterface $categories
     */
    public function __construct(CategoryRepositoryInterface $categories)
    {
        parent::__construct();
        $this->middleware('permission',
            ['only' => ['store', 'update', 'destroy']]
        );
        $this->categories = $categories;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $categories = $this->categories->getAll();

        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CategoryCreateRequest $request)
    {
        $data = $request->all();
        $category = Category::create($data);

        return response()->json($category, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryUpdateRequest $request
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $data = $request->all();
        $category->update($data);

        return response()->json(['message' => 'OK'], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['message' => 'OK'], 200);
    }
}
