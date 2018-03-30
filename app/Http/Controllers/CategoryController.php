<?php
namespace App\Http\Controllers;
use Exception;
use App\Category;
// use Illuminate\Http\Request;
use DB;
use App\Http\Requests\CategoryRequest;
class CategoryController extends ApiController
{
    //列表
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
            $list = Category::orderBy($sort, $order)->paginate($limit);
            return $this->response->collection($list);
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '数据是空的';
            return $this->response->json(compact('responData'));
        }
    }
    // 创建
    public function create()
    {
        $responData = [
            'status'=>200,
            'messages'=>'ok'
        ];
        try
        {
            
            $categoriesData = Category::where('pid','0')->get();
            $responData['categories'] = $categoriesData ;
        }catch(Exception $e)
        {
            $responData['status'] = 500;
            $responData['messages'] = '获取类型数据失败';
        }
        return $this->response->json(compact('responData'));
    }
    // 添加
    public function store(CategoryRequest $request)
    {
        $responData = [
            'status'=>200,
            'messages'=>'ok'
        ];
        try
        {
            $attributes = $request->all();
            DB::transaction(function () use ($attributes) {
                Category::create(['name'=>$attributes['name'],'description'=>$attributes['desc'],'path'=>$attributes['path'],'pid'=>$attributes['pid']]);
            });
            
            $responData['messages'] = '创建成功';
        }catch(Exception $e)
        {
            $responData['status'] = 500;
            $responData['messages'] = '添加类型失败';
        }
         return $this->response->json(compact('responData'));
    }
    // 编辑
    public function edit($id)
    {
        $responData = [
            'status'=>200,
            'messages'=>'ok'
        ];
        try
        {
            $category = Category::find($id);
            $categoriesData = Category::where('pid','0')->get();
            if(!empty($category) && !empty($categoriesData))
            {
                $responData['category'] =  $this->response->transform->item($category);
                $responData['categories'] = $categoriesData ;
            }
        }catch(Exception $e)
        {
            $responData['status'] = 500;
            $responData['messages'] = '获取数据失败';
        }
        return $this->response->json(compact('responData'));
    }

    // update
    public function update($id,CategoryRequest $request)
    {
        $responData = [
            'status'=>200,
            'messages'=>'ok'
        ];
        try
        {
            $attributes = $request->all();
            $category = Category::find($id);
            DB::transaction(function () use ($attributes,$category) {
                $category->update(['name'=>$attributes['name'],'description'=>$attributes['desc'],'path'=>$attributes['path'],'pid'=>$attributes['pid'],'title'=>$attributes['name']]);
			});
            $responData['messages'] = '修改成功';
        }catch(Exception $e)
        {
            $responData['status'] = 500;
            $responData['messages'] = '更新失败';
        }
        return $this->response->json(compact('responData'));
    }
    public function destroy($id)
    {
        $responData = [
            'status'=>200
        ];
        try{
            $category = Category::find($id);
            
            if(!$category)
            {
                $this->response->withNotFount('没有找到这段数据');
            }
            $category->delete();
            return $this->response->withNoContent();
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '删除失败';
            return $this->response->json(compact('responData'));
        }
    }
    // show
    public function show($id)
    {
        $responData = [
            'status'=>200,
            'messages'=>'ok'
        ];
        try
        {
            $category = Category::find($id);
            $responData['category'] = $category;
            $responData['messages'] = '修改成功';
        }catch(Exception $e)
        {
            $responData['status'] = 500;
            $responData['messages'] = '获取失败';
        }
        return $this->response->json(compact('responData'));
    }
}
