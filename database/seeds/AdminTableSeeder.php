<?php

use App\SysMemberInfo;
use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Admin;
use App\AdminInfo;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        //
        Admin::create([
            'no'    => 'a1000000000001',
            'rank'  => 1,
            'type'  => 1,
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
            'no'    => 'a1000000000002',
            'rank'  => 2,
            'type'  => 2,
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
            'no'    => 'a1'.time().rand('00','99'), //以時間當亂數種子
            'rank'  => 3,
            'type'  => 3,
            'name'    => 'Ronghong',
            'email'    => 'hello080810@gmail.com',
            'account'   => 'ronghong',
            'password'   =>  Hash::make('123123'),
            'createIP'  => env('APP_URL', '127.0.0.1'),
            'remember_token' =>  str_random(10),
            'active'    =>  1
        ]);


        $data_arr = [
            [
                "user_image" => env('APP_URL') . "/images/admin.jpg",
                "user_name" => "Superdo",
                "user_email" => "superdo@fujacook.com",
                "user_contact" => ""
            ],
            [
                "user_image" => env('APP_URL') . "/images/manager.jpg",
                "user_name" => "Manager",
                "user_email" => "fujacook@fujacook.com",
                "user_contact" => ""
            ],
            [
                "user_image" => env('APP_URL') . "/images/manager.jpg",
                "user_name" => "Ronghong",
                "user_email" => "ronghong@fujacook.com",
                "user_contact" => ""
            ],
        ];
        $admin_id = 1;
        foreach ($data_arr as $key => $var) {
            $Dao = new AdminInfo();
            $Dao->admin_id = $admin_id++;
            $Dao->user_image = $var['user_image'];
            $Dao->user_name = $var['user_name'];
            $Dao->user_email = $var['user_email'];
            $Dao->user_contact = $var['user_contact'];
            $Dao->save();
        }
    }
}

