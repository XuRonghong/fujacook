<?php

namespace App\Repositories\Api;

use App\Models\ProductCombinationReview;
use App\Repositories\ProductCombinationReviewRepository as ExtendsProductCombinationReviewRepository;

class ProductCombinationReviewRepository extends ExtendsProductCombinationReviewRepository
{
    public function __construct(ProductCombinationReview $model)
    {
        $this->model = $model;
    }

    public function productCombinationReviewsFilter($query, $columns = ['*'], $request = null, $paginate = null, $with = null)
    {
        $model = $query;

        if ($request) {
            if ($request->filled('name')) {
                $model = $model->whereHas('member', function ($model) use ($request) {
                    $model->where('name', 'like', "%{$request->name}%");
                });
                $model = $model->orWhereHas('productCombination', function ($model) use ($request) {
                    $model->where('name', 'like', "%{$request->name}%");
                });
            }
            
            $model = $model->orderBy($request->get('sort', 'id'), $request->get('dir', 'desc'));
        }

        return $this->getModelsByQuery($model, $columns, $paginate, $with);
    }

    public function getProductCombinationReviews($columns = ['*'], $request = null, $paginate = null, $with = null)
    {
        $query = $this->model;

        return $this->productCombinationReviewsFilter($query, $columns, $request, $paginate, $with);
    }

    
    public function createMany($attributes)
    {
        if (array_has($attributes, 'productCombinationReviews')) {
            foreach ($attributes['productCombinationReviews'] as $key => $item) {
                $attributes['productCombinationReviews'][$key]["member_id"] = $attributes["member_id"];
               
                $model = $this->create($attributes['productCombinationReviews'][$key]);
            }
        }

        return $model;
    }
}
