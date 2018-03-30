<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\PermissionRequest;
use App\Permission;
use Exception;
use DB;
class PermissionController extends ApiController
{
     //
    public function index()
    {
        $responData = [
            'status'=>200
        ];
        // 分页排序数据
        try{
            $sort = $this->parameters->sort();
            $order = $this->parameters->order();
            $limit = $this->parameters->limit();
            $list = Permission::orderBy($sort, $order)->paginate($limit);
            return $this->response->collection($list);
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '数据是空的';
            return $this->response->json(compact('responData'));
        }
    }
    public function create()
    {

    }
    public function store(PermissionRequest $request)
    {
        
        $responData = [
            'status'=>200
        ];
        try
        {
            $attributes = $request->all();
            DB::transaction(function () use ($attributes) {
                Permission::create(['name'=>$attributes['name'],'slug'=>$attributes['slug'],'description'=>$attributes['desc'],'model'=>$attributes['model']]);
			});
            $responData['messages'] = '创建成功';
        }catch(Exception $e)
        {
            $responData['status'] = 500;
            $responData['messages'] = '添加失败';
        }
        return $this->response->json(compact('responData'));
    }
    public function show($id)
    {

    }
    public function edit($id)
    {
        $responData = [
            'status'=>200
        ];
        try
        {
            $permissions = Permission::find($id);
            if($permissions)
            {
                $responData['permission'] =  $this->response->transform->item($permissions);
            }
            $responData['messages'] = '获取成功';
        }catch(Exception $e)
        {
            $responData['status'] = 500;
            $responData['messages'] = '获取失败';
            $this->response->withNotFount('没有找到这段数据');
        }
        return $this->response->json(compact('responData'));
    }
    public function update($id,PermissionRequest $request)
    {
        $responData = [
            'status'=>200
        ];
        try
        {
            $attributes = $request->all();
            $permission = Permission::find($id);
            DB::transaction(function () use ($attributes,$permission) {
                $permission->update(['name'=>$attributes['name'],'slug'=>$attributes['slug'],'description'=>$attributes['desc'],'model'=>$attributes['model']]);
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
            $permission = Permission::find($id);
            
            if(!$permission)
            {
                $this->response->withNotFount('没有找到这段数据');
            }
            $permission->delete();
            return $this->response->withNoContent();
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '删除失败';
            return $this->response->json(compact('responData'));
        }
    }
}
