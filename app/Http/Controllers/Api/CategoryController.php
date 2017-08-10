<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\RealWorld\Transformers\CategoryTransformer;

class CategoryController extends ApiController
{
    /**
     * CategoryController constructor.
     *
     * @param CategoryTransformer $transformer
     */
    public function __construct(CategoryTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * Get all the categories.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // $tags = Category::all()->pluck('name');
        $tags = Category::all();
        return $this->respondWithTransformer($tags);
    }
}
