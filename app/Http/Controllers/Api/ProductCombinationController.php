<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\Api\CategoryRepository;
use App\Repositories\Api\ProductCombinationRepository;

class ProductCombinationController extends Controller
{
    public function __construct(
        CategoryRepository $categoryRepository,
        ProductCombinationRepository $productCombinationRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->productCombinationRepository = $productCombinationRepository;
    }

    public function popular()
    {
        $popularProductCombinations = $this->productCombinationRepository->getPopularProductCombinations();

        return response()->json([
            'result' => '200',
            'data' => $popularProductCombinations,
        ]);
    }

    public function hotSearch()
    {
        $hotSearchProductCombinations = $this->productCombinationRepository->getHotSearchProductCombinations();

        return response()->json([
            'result' => '200',
            'data' => $hotSearchProductCombinations,
        ]);
    }

    public function getProduct(Request $request)
    {
        $productCombination = $this->productCombinationRepository->getProductCombinationsById($request->all());
        if ($productCombination) {
            $productCombination->loadMissing([
                'products.cover',
                'products',
                'productItems.productSpecs.productSpecCategory',
                'categories.parentCategory',
                'productCombinationAdditionalPurchase',
                'productCombinationCountdown',
            ]);
        }
        
        $youmaylike = $this->getProductYouMayLike($request->all());

        if ($productCombination) {
            return response()->json([
                'result' => '200',
                'data' => $productCombination,
                'category_products' => $youmaylike,
            ]);
        } else {
            return response()->json([
                'result' => '404',
            ]);
        }
    }

    public function getProductYouMayLike($data)
    {
        return $this->categoryRepository->getProductCombinationsByCategory($data);
    }

    public function show($id)
    {
        $productCombination = $this->productCombinationRepository->findValid($id);

        if ($productCombination) {
            $productCombination->loadMissing([
                'products.cover',
                'products',
                'productItems.productSpecs.productSpecCategory',
                'categories.parentCategory',
                'productCombinationAdditionalPurchase',
                'productCombinationCountdown',
            ]);
        }

        return response()->json([
            'result' => '200',
            'data' => $productCombination,
        ]);
    }
    
    public function additionalPurchase(Request $request)
    {
        $productCombinations = $this->productCombinationRepository->getAdditionalPurchaseProductCombinations($request->get('price', 0));

        if ($productCombinations) {
            $productCombinations->load([
                'products.cover',
                'products',
                'productItems.productSpecs.productSpecCategory',
                'categories.parentCategory',
                'productCombinationAdditionalPurchase',
            ]);
        }

        return response()->json([
            'result' => '200',
            'data' => $productCombinations,
        ]);
    }
}
