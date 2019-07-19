<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\Api\CategoryRepository;
use App\Repositories\Api\SearchKeywordRepository;
use App\Repositories\Api\ProductCombinationRepository;

class SearchKeywordController extends Controller
{
    public function __construct(
        CategoryRepository $categoryRepository,
        SearchKeywordRepository $searchKeywordRepository,
        ProductCombinationRepository $productCombinationRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->searchKeywordRepository = $searchKeywordRepository;
        $this->productCombinationRepository = $productCombinationRepository;
    }
    
    public function index()
    {
        $keywords = $this->searchKeywordRepository->getKeywordsForApi();
        
        return response()->json([
            'result' => '200',
            'data' => $keywords,
        ], 200);
    }

    public function search(Request $request)
    {
        if(!$request->has('sort')) $request['sort'] = '';
        if(!$request->has('page')) $request['page'] = 1;
        if(!$request->has('perPage')) $request['perPage'] = 15;

        $data = [];

        $product_combinations = $this->productCombinationRepository->getCategoryProductByKeyword($request->all());

        $data['product_combinations'] = $product_combinations;

        return response()->json([
            'result' => '200',
            'data' => $data,
        ], 200);
    }
}
