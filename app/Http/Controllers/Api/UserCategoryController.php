<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\DeleteUserCategory;
use App\Http\Requests\Api\UpdateUserCategory;
use App\UserCategory;
use App\Http\Requests\Api\CreateUserCategory;
use App\RealWorld\Transformers\UserCategoryTransformer;

class UserCategoryController extends ApiController
{
    /**
     * ArticleController constructor.
     *
     * @param UserCategoryTransformer $transformer
     */
    public function __construct(UserCategoryTransformer $transformer)
    {
        $this->transformer = $transformer;

        $this->middleware('auth.api')->except(['index', 'show']);
        $this->middleware('auth.api:optional')->only(['index', 'show']);
    }

    /**
     * Get all the user_categories.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // $tags = Category::all()->pluck('name');
        // $userCategories = UserCategory::all();

        $user = auth()->user();
        $userCategories = $user->userCategories()->get();
        return $this->respondWithTransformer($userCategories);
    }

    public function store(CreateUserCategory $request)
    {
        $user = auth()->user();

        $userCategory = $user->userCategories()->create([
            'name' => $request->input('user_category.name'),
            'icon' => $request->input('user_category.icon')
        ]);

        return $this->respondWithTransformer($userCategory);
    }

    /**
     * Update the user_category given by its id and return the user_category if successful.
     *
     * @param UpdateUserCategory $request
     * @param UserCategory $userCategory
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserCategory $request, UserCategory $userCategory)
    {
        if ($request->has('user_category')) {
            $userCategory->update($request->get('user_category'));
        }

        return $this->respondWithTransformer($userCategory);
    }

    /**
     * Delete the user_category given by its id.
     *
     * @param DeleteUserCategory $request
     * @param UserCategory $userCategory
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteUserCategory $request, UserCategory $userCategory)
    {
        $userCategory->delete();

        return $this->respondSuccess('success');
    }
}
