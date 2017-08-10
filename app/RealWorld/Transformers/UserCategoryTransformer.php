<?php

namespace App\RealWorld\Transformers;

class UserCategoryTransformer extends Transformer
{
    protected $resourceName = 'user_category';

    public function transform($data)
    {
        return $data;
    }
}