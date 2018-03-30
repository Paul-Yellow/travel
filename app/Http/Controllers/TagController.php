<?php

namespace App\Http\Controllers;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;
use Exception;
use DB;
class TagController extends ApiController
{
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
            $list = Tag::orderBy($sort, $order)->paginate($limit);
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
     public function store(TagRequest $request)
     {
        $responData = [
            'status'=>200,
            'messages'=>'ok'
        ];
        try
        {
            $attributes = $request->all();
            DB::transaction(function () use ($attributes) {
                $responData['tag'] = $this->response->item(Tag::create($attributes));
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
            $tag = Tag::find($id);
            
            if($tag)
            {
                $responData['tag'] =  $this->response->transform->item($tag);
                $responData['articles'] = $tag->newevents;
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
     public function show(Request $request)
     {
        $responData = [
            'status'=>200,
            'messages'=>'ok'
        ];
        try
        {
            $query = $request->query('name');
            $data = Tag::where('name',$query)->first();
            if(!Empty($data->newevents))
            {
                $responData['newevent'] = $data->newevents;
            }
            if(!Empty($data->activeevent))
            {
                $responData['activeevent'] = $data->activeevent;
            }
            if(!Empty($data->offers))
            {
                $responData['offers'] = $data->offers;
            }
        }catch(Exception $e)
        {
            $responData['status'] = 500;
            $responData['messages'] = '获取失败';
        }
        return $this->response->json(compact('responData'));
        //  return $this->response->item(Tag::findOrFail($id));
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
            $tag = Tag::find($id);
            DB::transaction(function () use ($attributes,$tag) {
                $tag->update($attributes);
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
            $tag = Tag::find($id);
        
            if(!$tag)
            {
                $this->response->withNotFount('没有找到这段数据');
            }
            $tag->delete();
            return $this->response->withNoContent();
         }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '删除失败';
            return $this->response->json(compact('responData'));
        }
     }
    //  Tag All
    public function tagAll()
    {
        $responData = [
            'status'=>200,
            'messages'=>'ok'
        ];
        try
        {
           $responData['data'] = Tag::path()->orderBy('name')->get();
           $responData['tag'] = Tag::nopath()->orderBy('name')->get();
        }catch(Exception $e)
        {
            $responData['status'] = 500;
            $responData['messages'] = '获取失败';
        }
        return $this->response->json(compact('responData'));
    }
}
