<?php

namespace App\Repositories\Api;

use App\Repositories\ProductCombinationProductItemRepository as MainProductCombinationProductItemRepository;

class ProductCombinationProductItemRepository extends MainProductCombinationProductItemRepository
{
    public function getProductCombinationProductItemByCombinationIdAndItemId($data)
    {
        $query = $this->model
            ->with(['productItem'])
            ->where('product_combination_id', $data['product_combination_id'])
            ->where('product_item_id', $data['product_item_id']);

        return $query->first();
    }
}
