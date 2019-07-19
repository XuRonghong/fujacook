<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\Api\CategoryRepository;
use App\Repositories\Api\ProductCombinationRepository;

class CategoryController extends Controller
{
    public function __construct(
        CategoryRepository $categoryRepository,
        ProductCombinationRepository $productCombinationRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->productCombinationRepository = $productCombinationRepository;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryRepository->getCategoryProductByPathName($request->all());

        return response()->json([
            'result' => '200',
            'data' => $categories,
        ], 200);
    }

    public function getProductParentCategories(Request $request)
    {
        $categories = $this->categoryRepository->getProductParentCategories();

        return response()->json([
            'result' => '200',
            'data' => $categories,
        ], 200);
    }

    public function getProductsLoadmore(Request $request)
    {
        $categories = $this->categoryRepository->getCategoryProductLoadmore($request->all());

        return response()->json([
            'result' => '200',
            'data' => $categories,
        ], 200);
    }

    public function feature()
    {
        $category = $this->categoryRepository->getProductParentCategories();
        
        $categories = [];

        foreach ($category as $key => $value) {
            $category_product_combinations = $this->productCombinationRepository->getCategoryFeatureProductCombinations($value->id, 3);

            if($category_product_combinations->isNotEmpty()){
                $value->product_combinations = $category_product_combinations;
                $categories[] = $value;
            }
        }

        return response()->json([
            'result' => '200',
            'data' => $categories,
        ], 200);
    }

    public function getValidParentCategories()
    {
        $category = $this->categoryRepository->getValidParentCategories();

        $categories = [];

        foreach ($category as $key => $value) {
            if($value->type == 1){
                $category_product_combinations = $this->productCombinationRepository->getParentCategoryProductCombinations($value->id, 2);

                if($category_product_combinations->isNotEmpty()){
                    $value->product_combinations = $category_product_combinations;
                    $categories[] = $value;
                }
            }else{
                $value->product_combinations = [];
                $categories[] = $value;
            }
        }
        
        return response()->json([
            'result' => '200',
            'data' => $categories,
        ], 200);
    }

    public function getIndexParentCategories()
    {
        $category = $this->categoryRepository->getValidProductParentCategories();
        $categories = [];

        foreach ($category as $key => $value) {
            $category_product_combinations = $this->productCombinationRepository->getParentCategoryProductCombinations($value->id, 10);

            if($category_product_combinations->isNotEmpty()){
                $value->product_combinations = $category_product_combinations;
                $categories[] = $value;
            }
        }
        
        return response()->json([
            'result' => '200',
            'data' => $categories,
        ], 200);
    }
}
