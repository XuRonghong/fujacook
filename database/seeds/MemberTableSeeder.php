<?php

use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Member;

class MemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Member::truncate();
//        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        //
        Member::create([
            'no'    => 'm'.time().rand('00','99'), //以時間當亂數種子
            'name'    => 'Ronghong',
            'email'    => 'hello080810@gmail.com',
            'account'   => 'ronghong',
            'password'   =>  Hash::make('123123'),
            'createIP'  => env('APP_URL', '127.0.0.1'),
            'active'    =>  1,
            'remember_token' =>  str_random(10)
        ]);
    }
}

