<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;
use Exception;
use DB;
class LinkController extends ApiController
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
        $responData = [
            'status'=>200
        ];
         try{
            $sort = $this->parameters->sort();
            $order = $this->parameters->order();
            $limit = $this->parameters->limit();
            $list = Link::orderBy($sort, $order)->paginate($limit);
            return $this->response->collection($list);
         }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '数据是空的';
            return $this->response->json(compact('responData'));
        }
     }
 
     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
        $responData = [
            'status'=>200,
            'messages'=>'ok'
        ];
        try
        {
            $attributes = $request->all();
            DB::transaction(function () use ($attributes) {
                $responData['link'] = $this->response->item(Link::create($attributes));
            });
            $responData['messages'] = '创建成功';
        }catch(Exception $e)
        {
            $responData['status'] = 500;
            $responData['messages'] = '添加错误';
        }
        return $this->response->json(compact('responData'));
         
     }
    //  update
    public function edit($id)
    {
        $responData = [
            'status'=>200,
            'messages'=>'ok'
        ];
        try
        {
            $link = Link::find($id);
            
            if($link)
            {
                $responData['link'] =  $this->response->transform->item($link);
                $responData['articles'] = $link->newevents;
            }
        }catch(Exception $e)
        {
            $responData['status'] = 500;
            $responData['messages'] = '没有找到数据';
        }
        return $this->response->json(compact('responData'));
    }
    // all Link
    public function shoWAll()
    {
        $responData = [
            'status'=>200,
            'messages'=>'ok'
        ];
        try
        {
            $list = Link::all();
            if($list){
                $responData['list'] = $list;
            }
        }catch(Exception $e)
        {
            $responData['status'] = 500;
            $responData['messages'] = '没有找到数据';
        }
        return $this->response->json(compact('responData'));
    } 
     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
        $responData = [
            'status'=>200
        ];
         try{
            return $this->response->item(Link::findOrFail($id));
         }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '数据是空的';
            return $this->response->json(compact('responData'));
        }
     }
 
     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, $id)
     {
        $responData = [
            'status'=>200,
            'messages'=>'ok'
        ];
        try
        {
            $attributes = $request->all();
            $link = Link::find($id);
            DB::transaction(function () use ($attributes,$link) {
                $link->update($attributes);
            });
            $responData['messages'] = '编辑成功';
        }catch(Exception $e)
        {
            $responData['status'] = 500;
            $responData['messages'] = '添加错误';
        }
        return $this->response->json(compact('responData'));
     }
 
     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
        $responData = [
            'status'=>200
        ];
         try{
            $link = Link::find($id);
            
            if(!$link)
            {
                $this->response->withNotFount('没有找到这段数据');
            }
            $link->delete();
            return $this->response->withNoContent();
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '删除失败';
            return $this->response->json(compact('responData'));
        }
     }
}
