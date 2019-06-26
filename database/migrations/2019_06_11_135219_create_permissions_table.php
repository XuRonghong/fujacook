<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    protected $table_names = [
                /*
                 * When using the "HasRoles" trait from this package, we need to know which
                 * table should be used to retrieve your roles. We have chosen a basic
                 * default value but you may easily change it to any table you like.
                 */
                'roles' => 'roles',

                /*
                 * When using the "HasRoles" trait from this package, we need to know which
                 * table should be used to retrieve your permissions. We have chosen a basic
                 * default value but you may easily change it to any table you like.
                 */
                'permissions' => 'permissions',

                /*
                 * When using the "HasRoles" trait from this package, we need to know which
                 * table should be used to retrieve your models permissions. We have chosen a
                 * basic default value but you may easily change it to any table you like.
                 */
                'admin_permission' => 'admin_permission',

                /*
                 * When using the "HasRoles" trait from this package, we need to know which
                 * table should be used to retrieve your models roles. We have chosen a
                 * basic default value but you may easily change it to any table you like.
                 */
                'model_has_roles' => 'admin_has_roles',

                /*
                 * When using the "HasRoles" trait from this package, we need to know which
                 * table should be used to retrieve your roles permissions. We have chosen a
                 * basic default value but you may easily change it to any table you like.
                 */
                'role_has_permissions' => 'role_has_permissions',
            ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table_names = $this->table_names;

        Schema::create($table_names['permissions'], function (Blueprint $table) {
            $table->increments('id')->comment('流水編號');
            $table->string('name', 50)->comment('功能對應route name');
            $table->string('description', 50)->comment('描述');
            $table->string('guard_name', 10)->comment('權限對應guard')->default('admin');
            $table->timestamps();
        });

        Schema::create($table_names['admin_permission'], function (Blueprint $table) use ($table_names) {
            $table->increments('id')->comment('流水編號');
            $table->unsignedInteger('admin_id')->comment('對應admin.id');
            $table->unsignedInteger('permission_id')->comment('對應permissions.id');
            $table->timestamps();

//            $table->morphs('model');

//            $table->foreign('permission_id')
//                ->references('id')
//                ->on($table_names['permissions'])
//                ->onDelete('cascade');

        });



//        Schema::create($table_names['roles'], function (Blueprint $table) {
//            $table->increments('id')->comment('流水編號');
//            $table->string('name', 30)->comment('權限角色名稱');
//            $table->string('description', 50)->comment('描述');
//            $table->string('guard_name', 10)->comment('對應的guard');
//            $table->timestamps();
//        });
//
//        Schema::create($table_names['model_has_roles'], function (Blueprint $table) use ($table_names) {
//            $table->unsignedInteger('role_id')->comment('對應roles.id');
//            $table->unsignedInteger('admin_id')->comment('對應admin.id');
//
////            $table->morphs('model');
//
//            $table->foreign('role_id')
//                ->references('id')
//                ->on($table_names['roles'])
//                ->onDelete('cascade');
//
////            $table->foreign('admin_id')
////                ->references('id')
////                ->on('admins')
////                ->onDelete('cascade');
//
//            $table->primary(['role_id'/*, 'model_id', 'model_type'*/]);
//        });



//        Schema::create($table_names['role_has_permissions'], function (Blueprint $table) use ($table_names) {
//            $table->unsignedInteger('permission_id')->comment('對應permissions.id');
//            $table->unsignedInteger('role_id')->comment('對應roles.id');
//
//            $table->foreign('permission_id')
//                ->references('id')
//                ->on($table_names['permissions'])
//                ->onDelete('cascade');
//
//            $table->foreign('role_id')
//                ->references('id')
//                ->on($table_names['roles'])
//                ->onDelete('cascade');
//
//            $table->primary(['permission_id', 'role_id']);
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = $this->table_names;
//        Schema::dropIfExists($tableNames['role_has_permissions']);
//        Schema::dropIfExists($tableNames['model_has_roles']);
        Schema::dropIfExists($tableNames['admin_permission']);
//        Schema::dropIfExists($tableNames['roles']);
        Schema::dropIfExists($tableNames['permissions']);
    }
}
