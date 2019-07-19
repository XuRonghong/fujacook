<?php

namespace App\Repositories\Api;

use App\Repositories\ProductCombinationRepository as MainProductCombinationRepository;

use Carbon\Carbon;

class ProductCombinationRepository extends MainProductCombinationRepository
{
    //熱門商品
    public function getPopularProductCombinations()
    {
        $query = $this->getProductCombinationsQueryByPopularType(2, 'leftJoin');
        
        $query->with(['products.cover',
                    'products.hashtags',
                    'productItems',
                    'categories',
                    'categories.parentCategory',
                    'productCombinationPopular']);

        return $query->limit(10)
                     ->get();
    }

    //熱搜商品
    public function getHotSearchProductCombinations()
    {
        $query = $this->getProductCombinationsQueryByPopularType();

        $query->with(['products.cover',
                    'categories',
                    'categories.parentCategory',
                    'productCombinationHotSearch']);

        return $query->get();
    }

    public function getProductCombinationsQueryByPopularType($type = 1, $joinStrategy = 'join')
    {
        $query = $this->model
            ->select('product_combinations.*')
            ->where('product_combinations.status', 1)
            ->where('product_combinations.type', 1)
            ->{$joinStrategy}(
                'product_combination_populars',
                function ($join) use ($type) {
                    $join->on('product_combination_populars.product_combination_id', '=', 'product_combinations.id')
                         ->where('product_combination_populars.type', '=', $type);
                }
            )
            ->orderByRaw('-`product_combination_populars`.`order` DESC')
            ->orderBy('created_at', 'desc');

        return $query;
    }

    public function getProductCombinationsById($data)
    {
        $query = $this->model
            ->with(['productCombinationCountdown'])
            ->with(['categories' => function ($query) {
                $query->with('parentCategory');
            },
                'products' => function ($query) {
                    $query->with(['cover', 'hashtags',
                        'carousels' => function ($query) {
                            $query->where(function ($query) {
                                $query->where(function ($query) {
                                    $query->where('type', 'image')
                                          ->where('quality', 'large');
                                })->orWhere(function ($query) {
                                    $query->where('type', '<>', 'image');
                                });
                            });
                        }]);
                },
                'productItems',
                'productCombinationReview' => function ($query) {
                    $query->with('member')
                        ->orderBy('created_at', 'desc')
                        ->take(4);
                }
            ])
            ->where('status', 1)
            ->where('id', $data['id']);

        return $query->first();
    }

    public function findValid($id)
    {
        return $this->model
             ->where('id', $id)
             ->where('status', 1)
             ->first();
    }

    //限時商品
    public function getCategoryFeatureProductCombinations($category_id, $limit)
    {
        $query = $this->model
                ->whereHas('categories.parentCategory', function ($query) use ($category_id) {
                    $query->where('id', $category_id);
                })
                ->whereHas('productCombinationCountdown', function ($query) {
                    $query->where('start_date', '<=', Carbon::now())
                          ->where('end_date', '>=', Carbon::now());
                })
                ->with(['productCombinationCountdown', 'productItems', 'categories', 'categories.parentCategory', 'products.cover'])
                ->where('type', 2)
                ->where('status', 1)
                ->limit($limit);

        return $query->get();
    }

    //主分類商品
    public function getParentCategoryProductCombinations($category_id, $limit)
    {
        $query = $this->model
                ->whereHas('categories.parentCategory', function ($query) use ($category_id) {
                    $query->where('id', $category_id);
                })
                ->with(['productCombinationCountdown', 'productItems', 'categories', 'categories.parentCategory', 'products.cover'])
                ->where('type', 1)
                ->where('status', 1)
                ->orderBy('created_at', 'desc')
                ->limit($limit);

        return $query->get();
    }

    public function getCategoryProductByKeyword($data)
    {
        $query = $this->model->with(['productItems', 'products.cover', 'products.hashtags', 'categories', 'categories.parentCategory']);

        if (isset($data['categoties'])) {
            $query = $query->whereHas('categories.parentCategory', function ($query) use ($data) {
                $query->where('id', $data['categoties']);
            });
        }

        $query = $query->where(function ($query) use ($data) {
            $query->orWhereHas('products.hashtags', function ($query) use ($data) {
                $query->where('name', 'like', '%'.$data['keyword'].'%');
            })
                ->orWhere('name', 'like', '%'.$data['keyword'].'%');
        });
                    
        $query = $query->where('status', 1)
                    ->where('type', 1);

        if ($data['sort'] == 'stars' || $data['sort'] == 'name' || $data['sort'] == 'price') {
            $query = $query->orderBy(data_get($data, 'sort', 'price'), data_get($data, 'sortType', 'desc'));
        }
        
        $query = $query->orderBy('created_at', 'desc')
                    ->orderBy('id', 'desc')
                    ->skip(($data['page']-1)*$data['perPage'])
                    ->limit($data['perPage']);

        return $query->get();
    }

    public function getAdditionalPurchaseProductCombinations($price)
    {
        return $this->model
             ->where('type', 3)
             ->where('status', 1)
             ->whereHas('productCombinationAdditionalPurchase', function ($query) use ($price) {
                 $query->where('over_price', '<', $price);
             })
             ->limit(40)
             ->get();
    }

    public function getAllProductCombinationsForSiteMap()
    {
        return $this->model
            ->select('id')
            ->with(['categories', 'categories.parentCategory'])
            ->get();
    }
}
