<?php

namespace App\Http\Requests\Api;

class DeleteUserCategory extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $userCategory = $this->route('user_category');

        return $userCategory->user_id == auth()->id();
    }
}
