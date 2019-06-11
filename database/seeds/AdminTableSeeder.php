<?php

use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Admin::create([
            'no'    => 'a100000000001',
            'name'    => 'Superdo',
            'email'    => 'hello080810@gmail.com',
            'account'   => 'superdo',
            'password'   =>  Hash::make('qwertyuiop123456'),
            'createIP'  => env('APP_URL', '127.0.0.1'),
            'active'    =>  1,
            'remember_token' =>  str_random(10)
        ]);
        //
        Admin::create([
            'no'    => 'a100000000002',
            'name'    => 'fujacook',
            'email'    => 'fujacook@fujacook.com',
            'account'   => 'fujacook',
            'password'   =>  Hash::make('123123'),
            'createIP'  => env('APP_URL', '127.0.0.1'),
            'remember_token' =>  str_random(10),
            'active'    =>  1
        ]);
        //
        Admin::create([
            'no'    => 'a'.time().rand('00','99'), //以時間當亂數種子
            'name'    => 'Ronghong',
            'email'    => 'hello080810@gmail.com',
            'account'   => 'ronghong',
            'password'   =>  Hash::make('123123'),
            'createIP'  => env('APP_URL', '127.0.0.1'),
            'remember_token' =>  str_random(10),
            'active'    =>  1
        ]);
    }
}

