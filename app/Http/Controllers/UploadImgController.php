<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\ImageRequest;
use App\Services\BaseManager;
use App\UploadImg;
class UploadImgController extends ApiController
{
    public function index(ImageRequest $request)
    {
        $responData = [
            'status'=>200
        ];
        try{
            $sort = $this->parameters->sort();
            $order = $this->parameters->order('ascending');
            $limit = $this->parameters->limit();
            $list = UploadImg::orderBy($sort, $order)->paginate($limit);
            return $this->response->collection($list);
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '数据是空的';
            return $this->response->json(compact('responData'));
        }
    }
    //所有文章上传图片
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
            $path = 'imgtemp'. '/' . date('Y') . '/' . date('m') . '/' . date('d');
            $result = $upload->store($file, $path);
            $data = UploadImg::create(['name'=>'图片','url'=>$result['url'],'author'=>$author]);
            return  $this->response->item($data);
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '上传失败';
            return $this->response->json(compact('responData'));
        }
    }
    public function show(ImageRequest $request)
    {

    }
    public function edit(Request $request)
    {
        
    }
    public function update(Request $request)
    {
        
    }
    // 删除文章图片
    public function destroy($id)
    {
        $responData = [
            'status'=>200
        ];
        try{
            $uploadimg = UploadImg::find($id);
            $url = $uploadimg->url;
            $upload = new BaseManager();
            $data = $upload->deleteFile($url);
            $uploadimg->delete();
            return $this->response->withNoContent();
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '删除失败';
            return $this->response->json(compact('responData'));
        }
    }
}
