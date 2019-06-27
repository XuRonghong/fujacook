<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (env('DB_REFRESH')) {
            // $this->call(UsersTableSeeder::class);
            $this->call(AdminTableSeeder::class);
            $this->call(MemberTableSeeder::class);
        }
        $this->call(MenuTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
    }
}
