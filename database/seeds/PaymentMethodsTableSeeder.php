<?php

use Illuminate\Database\Seeder;
use App\PaymentMethod;

class PaymentMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    	PaymentMethod::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $paymentMethods = [
            ['name' => '現金(自取)'],
            ['name' => '信用卡'],
            ['name' => '信用卡三期'],
            ['name' => '銀聯卡'],
            ['name' => 'ATM'],
            ['name' => 'WebATM'],
            ['name' => '超商條碼'],
            ['name' => '超商支付'],
            ['name' => 'AliPay(支付寶)'],
            ['name' => '微信支付'],
        ];

        foreach ($paymentMethods as $paymentMethod) {
            PaymentMethod::create($paymentMethod);
        }
    }
}
