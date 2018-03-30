<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Role;
use App\Permission;
use Exception;
use DB;
class RoleController extends ApiController
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
            $list = Role::orderBy($sort, $order)->paginate($limit);
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
            $permissions = Permission::all();
            return $this->response->json(compact('permissions'));
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '数据是空的';
            return $this->response->json(compact('responData'));
        }
    }
    public function store(RoleRequest $request)
    {
        $responData = [
            'status'=>200
        ];
        try
        {
            $attributes = $request->all();
            DB::transaction(function () use ($attributes) {
                $role = Role::create(['name'=>$attributes['name'],'slug'=>$attributes['slug'],'description'=>$attributes['desc'],'level'=>$attributes['level']]);
                if ($attributes['permissions']) {
                    $role->syncPermissions($attributes['permissions']);
                }
			});
            $responData['messages'] = '创建成功';
        }catch(Exception $e)
        {
            $responData['status'] = 500;
            $responData['messages']='创建失败';
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
            $role = Role::with('permissions')->find($id)->toArray();
            if(!$role)
            {
                return $this->response->withNotFound('没有找到记录');
            }
            if($role['permissions'])
            {
                $permission = [];
				foreach ($role['permissions'] as $v) {
					$arr = explode('.', $v['slug']);
					$permission[$arr[0]][] = $v;
				}
				$role['permissions'] = $permission;
               
            }
            $responData['results'] = $role;
        }catch(Exception $e)
        {
            $responData['status'] = 500;
            $responData['messages'] ='查找失败';
            return $this->response->withNotFound('没有找到记录');
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
            $role = Role::find($id);
            $permissions = Permission::all();
            if($role)
            {
                $responData['role'] =  $this->response->transform->item($role);
            }
        }catch(Exception $e)
        {
            $responData['status'] = 500;
            $responData['messages'] ='查找失败';
            $this->response->withNotFount('没有找到这段数据');
        }
        return $this->response->json(compact('responData','permissions'));
    }
    public function update($id,Request $request)
    {
        $responData = [
            'status'=>200
        ];
        try
        {
            $role = Role::find($id);
            $attributes = $request->all();
            if(!$role)
            {
                $this->response->withNotFount('没有找到这段数据');
            }
            DB::transaction(function () use ($attributes,$role) {
                $role->update(['name'=>$attributes['name'],'slug'=>$attributes['slug'],'description'=>$attributes['desc'],'level'=>$attributes['level']]);
                if ($attributes['permissions']) {
                    $role->syncPermissions($attributes['permissions']);
                }
			});
            $responData['messages'] = '修改成功';
        }catch(Exception $e)
        {
            $responData['status'] = 500;
            $responData['messages'] = '修改失败';
            $this->response->withNotFount('发生了一个错误');
        }
        return $this->response->json(compact('responData'));
    }
    public function destroy($id)
    {
        $responData = [
            'status'=>200
        ];
        try{
            $role = Role::find($id);
            
            if(!$role)
            {
                $this->response->withNotFount('没有找到这段数据');
            }
            $role->delete();
            return $this->response->withNoContent();
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '删除失败';
            return $this->response->json(compact('responData'));
        }
    }
}
