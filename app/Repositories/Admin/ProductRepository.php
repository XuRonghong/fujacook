<?php

namespace App\Repositories\Admin;

use App\Http\Controllers\FuncController;
use App\Product;
use App\ProductCategory;
use App\Repositories\Repository;


class ProductRepository extends Repository
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function setModel_ProductCategore()
    {
        $this->model = new ProductCategory();
    }

    public function setModel_Product()
    {
        $this->model = new Product();
    }

    public function getORM_ProductCategory($columns = ['*'], $whereQuery='1 = 1')
    {
        return ProductCategory::query()->where('open', 1)->whereRaw($whereQuery)->orderBy('rank', 'asc')->get($columns);
    }

    public function create($attributes)
    {
        try{
            $attributes = array_merge($attributes, [
                'no' => 'GP'. date('Ymd'). rand(1001,9999),
                'author_id' => auth()->guard('admin')->user()->id,
                'open' => config('app.open_default', 1),
                'rank' => 5,
            ]);
            $attributes['price'] = data_get($attributes, 'price') ?: '100';
            return parent::create($attributes); // TODO: Change the autogenerated stub
        } catch (\Exception $e){
            return ['errors'=> $e->getMessage()];
        }
    }

    public function update($attributes, $id)
    {
        try{
            $attributes = array_merge($attributes, [
                'author_id' => auth()->guard('admin')->user()->id,
            ]);
            // 啟用 或 不啟用
            if (isset($attributes['open']) && isset($attributes['doValidate'])) {
                $scene = $this->model->find($id);
                $attributes['open'] = ($attributes['open'] == "change") ? !$scene->open : $scene->open;
            }

            return parent::update($attributes, $id);
        } catch (\Exception $e){
            return ['errors'=> $e->getMessage()];
        }
    }

    public function delete($id, $onDelete='')
    {
        try{
            $model = parent::delete($id);

            /* 刪除商品類別，類別下商品也刪除
              $table->foreign('product.type')
                ->references('product_categories.id')
                ->on('product_categories')
                ->onDelete('cascade');
             */
            if ($onDelete=='cascade') {
                $this->setModel_Product();
                $model = $this->model->where('type', $id)->delete();

                $author_id = auth()->guard('admin')->user()->id;
                $value = json_encode( $model, JSON_UNESCAPED_UNICODE);
                FuncController::addActionLog('delete', $author_id, $value,'type='.$id, $this->model->getTable() );
            }

            return $model;
        } catch (\Exception $e){
            return ['errors'=> $e->getMessage()];
        }
    }
}
