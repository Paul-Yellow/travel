<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Permission;
use Exception;
use DB;
class UserController extends ApiController
{
    //
    public function index()
    {
        $responData = [
            'status'=>200
        ];
        try{
            // 分页排序数据
            $sort = $this->parameters->sort();
            $order = $this->parameters->order();
            $limit = $this->parameters->limit();
            $list = User::orderBy($sort, $order)->paginate($limit);
            return $this->response->collection($list);
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '数据是空的';
            return $this->response->json(compact('responData'));
        }
    }
    public function create()
    {
        $responData = [
            'status'=>200
        ];
        try{
            $roles = Role::all();
            $permissions = Permission::all();
            return $this->response->json(compact('roles','permissions'));
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '创建失败';
            return $this->response->json(compact('responData'));
        }
    }
    // 添加用户
    public function store(UserRequest $request)
    {
        $responData = [
            'status'=>200
        ];
        try
        {
            $attributes = $request->all();
            DB::transaction(function () use ($attributes) {
                $user = factory(User::class, 1)->create(['name'=>$attributes['username'],'email'=>$attributes['email'],'sex'=>$attributes['sex'],'iphone'=>$attributes['iphone'],'password'=>bcrypt($attributes['password'])])->each(function ($u) use($attributes){
                    if ($attributes['roles']) {
                        $u->syncRoles($attributes['roles']);
                    }
                    if ($attributes['permissions']) {
                        $u->syncPermissions($attributes['permissions']);
                    }
                });
			});
            $responData['messages'] = '创建成功';
        }catch(Exception $e)
        {
            $responData['status'] = 500;
            $responData['messages'] = '添加用户失败';
        }
        return $this->response->json(compact('responData'));
    }
    public function show($id)
    {
        $responData = [
            'status'=>200
        ];
        try
        {
            $user = User::find($id);
            if (!$user) {
                return $this->response->withNotFound('没有找到记录');
            }
            $permission = $user->getPermissions();
            $roles = $user->getRoles();
            if(!$permission->isEmpty())
            {
                $responData['permission'] = $permission->pluck('slug');
            }
            if(!$roles->isEmpty())
            {
                $responData['roles'] = $roles->pluck('slug');
            }
        }catch(Exception $e)
        {
            $responData['status'] = 500;
            $responData['messages'] = '获取数据失败';
            return $this->response->withNotFound('发生了一个错误');
        }

        return $this->response->json(compact('responData'));

    }
    public function edit($id)
    {
        $responData = [
            'status'=>200
        ];
        try
        {
            $user = User::find($id);
            $roles = Role::all();
            $permissions = Permission::all();
            // 用户角色 = 
            $rolesId = $user->getRoles();
            if(!$user->isEmpty())
            {
                $responData['user'] =  $this->response->transform->item($user);
            }
            if(!$roles->isEmpty())
            {
                // 选择 roles
                $responData['rolesId'] = $rolesId->pluck('id');
            }
        }catch(Exception $e)
        {
            $responData['status'] = 500;
            $responData['messages'] = '没有找到这段数据';
            $this->response->withNotFount('没有找到这段数据');
        }
        return $this->response->json(compact('responData','roles','permissions'));
    }
    public function update($id,Request $request)
    {
        
        $responData = [
            'status'=>200
        ];
        try
        {
            $userinfo = User::find($id);
            $attributes = $request->all();
            if(!$userinfo)
            {
                $this->response->withNotFount('没有找到这段数据');
            }
            DB::transaction(function () use ($attributes,$userinfo) {
                
                $userinfo->update(['name'=>$attributes['username'],'email'=>$attributes['email'],'sex'=>$attributes['sex'],'iphone'=>$attributes['iphone']]);
                if ($attributes['roles']) {
                    $userinfo->syncRoles($attributes['roles']);
                }
                if ($attributes['permissions']) {
                    $userinfo->syncPermissions($attributes['permissions']);
                }
                
			});
            $responData['messages'] = '修改成功';
        }catch(Exception $e)
        {
            $responData['status'] = 500;
            $responData['messages'] = '修改失败';
        }
        return $this->response->json(compact('responData'));

    }
    public function destroy($id)
    {
        $responData = [
            'status'=>200
        ];
        try{
            $user = User::find($id);
            
            if(!$user)
            {
                $this->response->withNotFount('没有找到这段数据');
            }
            $user->delete();
            return $this->response->withNoContent();
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '删除失败';
            return $this->response->json(compact('responData'));
        }
    }
    public function updateStatus($id,Request $request)
    {
        
        $responData = [
            'status'=>200
        ];
        try
        {
            $userinfo = User::find($id);
            $attributes = $request->all();
            if(!$userinfo)
            {
                $this->response->withNotFount('没有找到这段数据');
            }
            DB::transaction(function () use ($attributes,$userinfo) {
                if($attributes['status']){
                    $userinfo->update(['status'=>$attributes['status']]);
                }
                
			});
            $responData['messages'] = '修改成功';
        }catch(Exception $e)
        {
            $responData['status'] = 500;
            $responData['messages'] = '改变用户状态失败';
        }
        return $this->response->json(compact('responData'));

    }
}
