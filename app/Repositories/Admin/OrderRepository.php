<?php

namespace App\Repositories\Admin;

use App\Http\Controllers\FuncController;
use App\Order;
use App\OrderContact;
use App\OrderDetail;
use App\PaymentMethod;
use App\Product;
use App\Repositories\Repository;


class OrderRepository extends Repository
{
    protected $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function setModel_OrderContact()
    {
        $this->model = new OrderContact();
    }

    public function getORM_Product($columns = ['*'], $whereQuery='1 = 1')
    {
        return Product::query()->where('open', 1)->whereRaw($whereQuery)->with('spec')->get($columns);
    }

    public function getORM_PaymentMethods($columns = ['*'], $whereQuery='1 = 1')
    {
        return PaymentMethod::query()->where('status', 1)->whereRaw($whereQuery)->get($columns);
    }

    public function create($attributes, $from='order')
    {
        try{
            if ($from=='order') {
                $attributes = array_merge($attributes, [
                    'no' => 'OR' . date('Ymd') . rand(1001, 9999),
                    'member_id' => auth()->guard('admin')->user()->id,
                ]);
                $order = parent::create($attributes);
                //
                $orderDetail = OrderDetail::query()->create([
                    'order_id' => $order->id,
                    'product_id' => $attributes['product_id'],
                    'ownerKey' => $attributes['ownerKey'],
                    'related' => $attributes['related'],
                    'type' => 0,
                    'purchase_price' => 20,
                    'cost_price' => 10,
                    'price' => 15,
                    'quantity' => 1,
                ]);
                //
                $orderContact = OrderContact::query()->create([
                    'order_id' => $order->id,
                    'type' => 1,
                    'name' => 'rhrh',
                    'gender' => 'man',
                    'email' => 'xxx@xx.x',
                    'phone' => '09000',
                ]);
                return 'ok';
            } else {
                parent::create($attributes); // TODO: Change the autogenerated stub
            }
        } catch (\Exception $e){
            return ['errors'=> $e->getMessage()];
        }
    }

    public function update($attributes, $id)
    {
        try{
//            $attributes = array_merge($attributes, [
//                'author_id' => auth()->guard('admin')->user()->id,
//            ]);
            // 啟用 或 不啟用
            if (isset($attributes['open']) && isset($attributes['doValidate'])) {
                $Dao = $this->model->find($id);
                $attributes['open'] = ($attributes['open'] == "change") ? !$Dao->status : $Dao->status;
            }

            return parent::update($attributes, $id);
        } catch (\Exception $e){
            return ['errors'=> $e->getMessage()];
        }
    }

    public function delete($id, $onDelete='', $for='')
    {
        try{
            $model = parent::delete($id);

            if ($onDelete=='cascade') {
                if ($for == 'product_spec') {
                    /* 刪除商品，商品下規格也刪除
                      $table->foreign('product_specs.product_id')->references('product.id')->on('product')->onDelete('cascade');
                     */
                    $this->setModel_ProductSpec();
                    $model = $this->model->where('product_id', $id)->delete();
                    $str = 'product_id='.$id;
                } else {
                    /* 刪除商品類別，類別下商品也刪除
                      $table->foreign('product.type')->references('product_categories.id')->on('product_categories')->onDelete('cascade');
                     */
                    $this->setModel_Product();
                    $model = $this->model->where('type', $id)->delete();
                    $str = 'type='.$id;
                }
                $author_id = auth()->guard('admin')->user()->id;
                $value = json_encode( $model, JSON_UNESCAPED_UNICODE);
                FuncController::addActionLog('delete', $author_id, $value, $str, $this->model->getTable() );
            }

            return $model;
        } catch (\Exception $e){
            return ['errors'=> $e->getMessage()];
        }
    }
}
