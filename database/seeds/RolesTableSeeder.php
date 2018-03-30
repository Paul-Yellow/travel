<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $adminRole = Role::create([
            'name' => '超级管理员',
            'slug' => 'admin',
            'description' => '超级管理员',
        ]);
        // $userRole = Role::create([
        //     'name' => '普通管理员',
        //     'slug' => 'user',
        //     'description' => '普通管理员',
        // ]);
        // $guardRole = Role::create([
        //     'name' => '普通用户',
        //     'slug' => 'guard',
        //     'description'  => '普通用户'
        // ]);
        /*管理员初始化所有权限*/
        $all_permissions = Permission::all();
    	$adminRole->attachPermission($all_permissions);
        /**
         * 普通用户赋予一般权限
         */
        // $dashBackendPer = Permission::where('slug', 'dashborde.index')->first();
        // $dashBackendPerStore = Permission::where('slug', 'dashborde.store')->first();
        // $dashBackendPerDestory = Permission::where('slug', 'dashborde.destroy')->first();
        // $guardBackendPer = Permission::where('slug', 'me.index')->first();
        // $guardBackendPerStore = Permission::where('slug', 'me.store')->first();
        // $guardBackendPerUpdate = Permission::where('slug', 'me.update')->first();
        // $guardRole->attachPermission([$guardBackendPer->id,$guardBackendPerStore->id,$guardBackendPerUpdate->id]);
        // $userRole->attachPermission([$dashBackendPer->id,$guardBackendPer->id,$guardBackendPerStore->id,$guardBackendPerUpdate->id,$dashBackendPerStore->id,$dashBackendPerDestory->id]);
    }
}
