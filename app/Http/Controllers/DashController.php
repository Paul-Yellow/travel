<?php

namespace App\Http\Controllers;
use Exception;
use App\Services\BaseManager;
use App\Dashborde;
use App\Http\Requests\ImageRequest;
class DashController extends ApiController
{
    //
    public function index()
    {
        $responData = [
            'status'=>200
        ];
        try{
            $dash = Dashborde::all();
            return  $this->response->collection($dash);
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '轮播图是空的';
            return $this->response->json(compact('responData'));
        }
    }
    // 首页轮播图
    public function store(ImageRequest $request)
    {
        $responData = [
            'status'=>200
        ];
        try{
            $file = $request->file('file');
            $author = $request->input('author');
            $upload = new BaseManager();
            if (!$request->hasFile('file'))
            {
                return $this->withNotFound();
            }
            $path = 'sidebar'. '/' . date('Y') . '/' . date('m') . '/' . date('d');
            $result = $upload->store($file, $path);
            Dashborde::create(['name'=>'绝美中原，避暑天堂','url'=>$result['url'],'author'=>$author]);
            return  $this->response->json(compact('result'));
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '添加失败.请检测storage 目录权限';
            return $this->response->json(compact('responData'));
        }
    }
    //
    public function create()
    {

    }
    // 
    public function update()
    {

    }
    // 
    public function edit()
    {

    }
    // 
    public function show(ImageRequest $request,$id)
    {
    }
    //删除轮播图
    public function destroy($id)
    {
        $responData = [
            'status'=>200
        ];
        try{
            $dash = Dashborde::find($id);
            $url = $dash->url;
            $upload = new BaseManager();
            $data = $upload->deleteFile($url);
            $dash->delete();
            return $this->response->json(compact('data'));
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '删除失败';
            return $this->response->json(compact('responData'));
        }
    }
}
