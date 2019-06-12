<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Repositories\Category\CategoryRepository;

class CategoryController extends Controller
{
    private $categoryRepository;

    /**
     * Create a new CategoryController instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('permission',
            ['only' => ['store', 'update', 'destroy']]
        );
        $this->categoryRepository = app(CategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $categories = $this->categoryRepository->getAll();

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

        return response()
            ->json($category, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        $category = $this->categoryRepository->getEdit($id);

        if (empty($category))
        {
            return response()
                ->json(['error' => 'category not found'], 404);
        }

        $data = $request->all();
        $category->update($data);

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
        $result = Category::destroy($id);

        if ($result) {
            return response()
                ->json(['message' => 'OK'], 200);
        }
        else {
            return response()
                ->json(['error' => 'category not found'], 404);
        }
    }
}
