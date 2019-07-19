<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\ArticleRepository;
use App\Repositories\Api\CategoryRepository;
use App\Repositories\Api\ProductCombinationRepository;

class SitemapController extends Controller
{
    public function __construct(
        CategoryRepository $categoryRepository,
        ArticleRepository $articleRepository,
        ProductCombinationRepository $productCombinationRepository
    ) {
        $this->articleRepository = $articleRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productCombinationRepository = $productCombinationRepository;
    }
    
    public function index()
    {
        $data = [];

        $data['articles']    = $this->articleRepository->getAllArticlesForSiteMap();
        $data['categories']  = $this->categoryRepository->getChildCategoriesForSiteMap();
        $data['productCombinations'] = $this->productCombinationRepository->getAllProductCombinationsForSiteMap();
        
        return response()->json([
            'result' => '200',
            'data' => $data,
        ], 200);
    }
}
