<?php

namespace App\Repositories\Api;

use App\Repositories\CategoryRepository as ExtendsCategoryRepository;

use Carbon\Carbon;

class CategoryRepository extends ExtendsCategoryRepository
{
    public function categoriesFilterData($query, $columns = ['*'], $request = null, $paginate = null, $with = null)
    {
        $model = $query;

        if ($request) {
            $model = $model->orderBy($request->get('sort', 'id'), $request->get('dir', 'asc'));
        }

        return $this->getModelsByQuery($model, $columns, $paginate, $with);
    }

    public function getCategoryProductByPathName($data, $columns = ['*'], $request = null, $paginate = null, $with = null)
    {
        $query = $this->model
                ->withCount(['productCombinations' => function ($query) {
                    $query->where('status', 1)
                        ->where('type', 1);
                }])
                ->with(['productCombinations' => function ($query) use ($data) {
                    $query->with(['productItems', 'products' => function ($query) {
                        $query->with('cover', 'hashtags');
                    }])
                        ->where('status', 1)
                        ->where('type', 1);
                    if ($data['sort'] == 'stars' || $data['sort'] == 'name' || $data['sort'] == 'price') {
                        $query->orderBy($data['sort'], $data['sortType']);
                    }
                    $query->orderBy('created_at', 'desc')->limit(25);
                }, 'categoryImages' => function ($query) {
                    $query->with('media')
                        ->orderBy('id', 'desc')
                        ->limit(2);
                }, 'parentCategory', 'media'])
                ->where('path_name', $data['child']);

        return $query->first();
        // return $this->categoriesFilterData($query, null, null, 25, null);
    }

    public function getProductParentCategories()
    {
        return $this->model
                ->where('parent_category_id', null)
                ->where('type', 1)
                ->where('status', 1)
                ->get();
    }

    public function getCategoryProductLoadmore($data)
    {
        $query = $this->model
                ->with(['productCombinations' => function ($query) use ($data) {
                    $query->with(['productItems', 'products' => function ($query) {
                        $query->with('cover', 'hashtags');
                    }, 'categories.parentCategory'])
                        ->where('status', 1)
                        ->where('type', 1);
                    if ($data['sort'] == 'stars' || $data['sort'] == 'name' || $data['sort'] == 'price') {
                        $query->orderBy($data['sort'], $data['sortType']);
                    }
                    $query->orderBy('created_at', 'desc')
                        ->skip(($data['page']-1)*$data['perPage'])
                        ->limit($data['perPage']);
                }]);

        $query = $query->where('id', $data['channel']);

        return $query->first();
    }

    public function getProductCombinationsByCategory($data)
    {
        $ids = array($data['id']);
        $query = $this->model
            ->with(['productCombinations' => function ($query) use ($ids) {
                $query->with(['productItems', 'products' => function ($query) {
                    $query->with('cover', 'hashtags');
                }])
                    ->where('status', 1)
                    ->where('type', 1)
                    ->whereNotIn('id', $ids)
                    ->take(12);
            }, 'parentCategory'])
            ->where('path_name', $data['child']);

        return $query->first();
    }

    public function getValidParentCategories()
    {
        return $this->model
            ->with(['childCategories' => function ($query) {
                $query->where('status', 1);
            }])
            ->where('parent_category_id', null)
            ->where('status', 1)
            ->orderBy('type', 'asc')
            ->orderBy('order', 'asc')
            ->get();
    }

    public function getValidProductParentCategories()
    {
        return $this->model
            ->with([
            'childCategories' => function ($query) {
                $query->where('status', 1);
            },
            'banners' => function ($query) {
                $query->with('media')
                ->where('status', 1)
                ->where(function ($query) {
                    $query->where(function ($query) {
                        $query->where('start_at', '<=', Carbon::now())
                            ->where('end_at', '>=', Carbon::now());
                    })
                    ->orWhere(function ($query) {
                        $query->where('start_at', null)
                            ->where('end_at', null);
                    });
                })
                ->orderBy('start_at', 'desc')
                ->orderBy('created_at', 'desc');
            }])
            ->where('parent_category_id', null)
            ->where('status', 1)
            ->where('type', 1)
            ->orderBy('order', 'asc')
            ->get();
    }

    public function getChildCategoriesForSiteMap()
    {
        return $this->model
            ->with('parentCategory')
            ->where('parent_category_id', '<>', null)
            ->where('status', 1)
            ->get();
    }
}
