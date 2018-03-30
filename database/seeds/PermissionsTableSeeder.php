<?php

use Illuminate\Database\Seeder;
use App\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 登入到个人中心
        //查看用户信息权限
        Permission::create([
            'name' => '用户信息列表',
            'slug' => 'me.index',
            'description' => '用户信息列表'
        ]);
        Permission::create([
            'name' => '创建用户信息页面',
            'slug' => 'me.create',
            'description' => '创建用户信息页面'
        ]);
        Permission::create([
            'name' => '添加用户信息',
            'slug' => 'me.store',
            'description' => '添加用户信息'
        ]);
        Permission::create([
            'name' => '显示用户信息',
            'slug' => 'me.show',
            'description' => '显示用户信息'
        ]);
        Permission::create([
            'name' => '编辑用户信息',
            'slug' => 'me.update',
            'description' => '编辑用户信息'
        ]);
        Permission::create([
            'name'  => '编辑用户信息页面',
            'slug'  => 'me.edit',
            'description' => '编辑用户信息页面',
        ]);
        Permission::create([
            'name'  => '删除用户信息',
            'slug'  => 'me.destroy',
            'description' => '删除用户信息'
        ]);
        Permission::create([
            'name'  => '通知信息',
            'slug'  => 'me.notification',
            'description' => '通知信息'
        ]);
        // 管理所有文章图片权限
        //所有文章图片权限
        Permission::create([
            'name' => '文章图片列表',
            'slug' => 'uploadimg.index',
            'description' => '文章图片列表'
        ]);
        Permission::create([
            'name' => '创建图片页面',
            'slug' => 'uploadimg.create',
            'description' => '创建图片页面'
        ]);
        Permission::create([
            'name' => '添加文章图片',
            'slug' => 'uploadimg.store',
            'description' => '添加文章图片'
        ]);
        Permission::create([
            'name' => '显示文章图片',
            'slug' => 'uploadimg.show',
            'description' => '显示文章图片'
        ]);
        Permission::create([
            'name' => '编辑文章图片',
            'slug' => 'uploadimg.update',
            'description' => '编辑用户信息'
        ]);
        Permission::create([
            'name'  => '编辑文章图片页面',
            'slug'  => 'uploadimg.edit',
            'description' => '编辑文章图片页面',
        ]);
        Permission::create([
            'name'  => '删除文章图片',
            'slug'  => 'uploadimg.destroy',
            'description' => '删除文章图片'
        ]);


        //登入后台 权限在vue里面进行拦截
        ////////////
        // 后台控制台 ////
        ////////////
        Permission::create([
            'name' => '后台控制台',
            'slug' => 'dashborde.index',
            'description' => '后台控制台'
        ]);
        Permission::create([
            'name' => '后台控制台创建页面',
            'slug' => 'dashborde.create',
            'description' => '后台控制台创建页面'
        ]);
        Permission::create([
            'name' => '后台控制台添加内容',
            'slug' => 'dashborde.store',
            'description' => '后台控制台添加内容'
        ]);
        Permission::create([
            'name' => '后台控制台编辑页面',
            'slug' => 'dashborde.edit',
            'description' => '后台控制台编辑页面'
        ]);
        Permission::create([
            'name' => '后台控制台显示页面',
            'slug' => 'dashborde.show',
            'description' => '后台控制台显示页面'
        ]);
        Permission::create([
            'name' => '后台控制台更新内容',
            'slug' => 'dashborde.update',
            'description' => '后台控制台更新内容'
        ]);
        Permission::create([
            'name' => '后台控制台删除内容',
            'slug' => 'dashborde.destroy',
            'description' => '控制台删除内容'
        ]);
        //////////
        //网站管理//
        //////////
        /*
        * 运行日志
        */  
        Permission::create([
            'name'  => '网站配置列表',
            'slug'  => 'manage.info',
            'description'   => '网站配置列表'
        ]);
        /*
        * 操作日志
        */ 
        Permission::create([
            'name'  => '显示操作日志列表',
            'slug'  => 'manage.actionlog',
            'description'   => '显示操作日志列表'
        ]);

        //////////
        //系统管理//
        //////////
        /////////////
        //角色管理 //
        ////////////
        /**
         * 显示角色列表
         */
        Permission::create([
            'name' => '显示角色列表',
            'slug' => 'role.index',
            'description' => '显示角色列表'
        ]);
        /**
         * 创建角色页面
         */
        Permission::create([
            'name' => '创建角色页面',
            'slug' => 'role.create',
            'description' => '创建角色页面'
        ]);
        /**
         * 创建角色
         */
        Permission::create([
            'name' => '创建角色',
            'slug' => 'role.store',
            'description' => '创建角色'
        ]);
        /**
         * 删除角色
         */
        Permission::create([
            'name' => '删除角色',
            'slug' => 'role.destroy',
            'description' => '删除角色'
        ]);
        /**
         * 修改角色页面
         */
        Permission::create([
            'name' => '修改角色页面',
            'slug' => 'role.edit',
            'description' => '修改角色页面'
        ]);
        /**
         * 修改角色
         */
        Permission::create([
            'name' => '修改角色',
            'slug' => 'role.update',
            'description' => '修改角色'
        ]);
        /**
         * 查看角色权限
         */
        Permission::create([
            'name' => '查看角色权限',
            'slug' => 'role.show',
            'description' => '查看角色权限'
        ]);
        /////////////
        //权限管理 //
        ////////////
        /**
         * 显示权限列表
         */
        Permission::create([
            'name' => '显示权限列表',
            'slug' => 'permission.index',
            'description' => '显示权限列表'
        ]);
        /**
         * 创建权限页面
         */
        Permission::create([
            'name' => '创建权限页面',
            'slug' => 'permission.create',
            'description' => '创建权限页面'
        ]);
        /**
         * 创建权限
         */
        Permission::create([
            'name' => '创建权限',
            'slug' => 'permission.store',
            'description' => '创建权限'
        ]);
        /**
         * 删除权限
         */
        Permission::create([
            'name' => '删除权限',
            'slug' => 'permission.destroy',
            'description' => '删除权限'
        ]);
        /**
         * 修改权限页面
         */
        Permission::create([
            'name' => '修改权限页面',
            'slug' => 'permission.edit',
            'description' => '修改权限页面'
        ]);
        /**
         * 修改权限
         */
        Permission::create([
            'name' => '修改权限',
            'slug' => 'permission.update',
            'description' => '修改权限'
        ]);
        /////////////
        //用户管理 //
        ////////////
        /**
         * 显示用户列表
         */
        Permission::create([
            'name' => '显示用户列表',
            'slug' => 'users.index',
            'description' => '显示用户列表'
        ]);
        /**
         * 创建用户页面
         */
        Permission::create([
            'name' => '创建用户页面',
            'slug' => 'users.create',
            'description' => '创建用户页面'
        ]);
        /**
         * 创建用户
         */
        Permission::create([
            'name' => '创建用户',
            'slug' => 'users.store',
            'description' => '创建用户'
        ]);
        /**
         * 修改用户页面
         */
        Permission::create([
            'name' => '修改用户页面',
            'slug' => 'users.edit',
            'description' => '修改用户页面'
        ]);
        /**
         * 修改用户信息
         */
        Permission::create([
            'name' => '修改用户',
            'slug' => 'users.update',
            'description' => '修改用户'
        ]);
        /**
         * 删除用户
         */
        Permission::create([
            'name' => '删除用户',
            'slug' => 'users.destroy',
            'description' => '删除用户'
        ]);
        /**
         * 查看用户信息
         */
        Permission::create([
            'name' => '查看用户信息',
            'slug' => 'users.show',
            'description' => '查看用户信息'
        ]);
        /**
         * 修改用户密码
         */
        Permission::create([
            'name' => '修改用户密码',
            'slug' => 'users.reset',
            'description' => '修改用户密码'
        ]);
        /**
         * 获取用户权限信息
         */
        Permission::create([
            'name' => '获取用户权限信息',
            'slug' => 'users.info',
            'description' => '获取用户权限信息'
        ]);
     
        Permission::create([
            'name' => '改变用户权限',
            'slug' => 'users.updatestatus',
            'description' => '改变用户权限'
        ]);
     
    }
}
