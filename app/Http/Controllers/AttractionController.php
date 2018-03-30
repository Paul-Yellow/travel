<?php

namespace App\Http\Controllers;

use App\Attraction;
use App\NewEvents;
use Illuminate\Http\Request;
use App\Events\LikeAttraction;
use App\Events\FavoriteAttraction;
use App\Notifications\AttractionComment;
use App\Events\UserCreditChanged;
use App\Category;
use App\Tag;
use Exception;
use DB;
class AttractionController extends ApiController
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
            $list = Attraction::orderBy($sort, $order)->paginate($limit);
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
             'status'=>200,
             'messages'=>'ok'
         ];
         try
         {
             $categoriesData = Category::all();
             $responData['categories'] = $categoriesData;
             $responData['tag'] = Tag::all();
         }catch(Exception $e)
         {
             $responData['status'] = 500;
             $responData['messages'] = '获取类型数据失败';
         }
         return $this->response->json(compact('responData'));
     }
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
                 $data = Attraction::create(['title'=>$attributes['params']['title'],'content'=>$attributes['params']['content'],'content_short'=>$attributes['params']['content_short'],'date'=>$attributes['params']['date2'],'imgUrl'=>$attributes['params']['imgUrl'],'user_id'=>$attributes['params']['user_id'],'category_name'=>$attributes['params']['pid']['name'],'category_id'=>$attributes['params']['pid']['id']]);
                 event(new UserCreditChanged(2));
                 if($data)
                 {
                     if(isset($attributes['params']['tags']) && $attributes['params']['tags'])
                     {
                         $data->tags()->sync($attributes['params']['tags']);
                     }
                 }
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
        $responData = [
            'status'=>200,
            'messages'=>'ok'
        ];
        try{
            $data = Attraction::find($id);
            $list = Attraction::all();
            if(!$data)
            {
                $this->response->withNotFount('没有找到这段数据');
            }
            if($data->user)
            {
                $responData['user'] = $this->response->transform->item($data->user);
            }
            if($data)
            {
                $responData['data'] = $data;
                $data->increment('view_count',1);
            }
            if($list)
            {
                $responData['list'] = $list;
            }
        }catch(Exception $e){
            $responData['status'] = 500;
             $responData['messages'] = '查询失败';
        }
        return $this->response->json(compact('responData'));
    }
     public function showList()
     {
        //  if($this->parameters->get('pid')){
        //     $sort = $this->parameters->sort();
        //     $order = $this->parameters->order();
        //     $limit = $this->parameters->limit();
        //     // $list = Attraction::orderBy($sort, $order)->paginate($limit);
        //     $data =  Attraction::where('category_id',$this->parameters->get('pid'))->orderBy($sort, $order)->paginate($limit);
        //     return $this->response->collection($data);
        //  }else{
        //     $sort = $this->parameters->sort();
        //     $order = $this->parameters->order();
        //     $limit = $this->parameters->limit();
        //     // $list = Attraction::orderBy($sort, $order)->paginate($limit);
        //     $data =  Attraction::orderBy($sort, $order)->paginate($limit);
        //     return $this->response->collection($data);
        //  }
        
         $responData = [
             'status'=>200,
             'messages'=>'ok'
         ];
         try
         {    
            $sort = $this->parameters->sort();
            $order = $this->parameters->order();
            $limit = $this->parameters->limit();
            // $list = Attraction::orderBy($sort, $order)->paginate($limit);
            $data =  Attraction::where('category_id',$this->parameters->get('pid'))->orderBy($sort, $order)->paginate($limit);
            $this->response->collection($data);
            //  'category_id'
             if($data){
                $responData['list'] = $this->response->collection($data);
             }
         }catch(Exception $e)
         {
            $responData['status'] = 500;
            $responData['messages'] = '没有找到数据';
         }
         return $this->response->json(compact('responData'));
     }
    // 显示类型
    public function showCategory()
    {
         $responData = [
             'status'=>200,
             'messages'=>'ok'
         ];
         try
         {
             
             if($this->parameters->get('id')){
                $query = $this->parameters->get('id');
                $data = Category::where('pid',$query)->get();
                $responData['category'] = $data;
             }else{
                $data =  Category::all();
                $responData['category'] = $data;
             }
         }catch(Exception $e)
         {
            $responData['status'] = 500;
            $responData['messages'] = '没有找到数据';
         }
         return $this->response->json(compact('responData'));
    }
     public function edit($id)
     {
         $responData = [
             'status'=>200,
             'messages'=>'ok'
         ];
         try
         {
             $data = Attraction::find($id);
             $category = Category::all();
             $tag = Tag::all();
             if($data)
             {
                 $responData['data'] =  $this->response->transform->item($data);
             }
             if($category)
             {
                 $responData['category'] = $this->response->transform->collection($category);
             }
             if($tag)
             {
                 $responData['tagAll'] = $tag;
             }
         }catch(Exception $e)
         {
             $responData['status'] = 500;
             $responData['messages'] = '没有找到数据';
         }
         return $this->response->json(compact('responData'));
     }
     public function update($id,Request $request)
     {
         $responData = [
             'status'=>200,
             'messages'=>'ok'
         ];
         try
         {
             $attributes = $request->all();
             $data = Attraction::find($id);
             DB::transaction(function () use ($attributes,$data) {
                 $data->update(['title'=>$attributes['params']['title'],'content'=>$attributes['params']['content'],'content_short'=>$attributes['params']['content_short'],'date'=>$attributes['params']['date2'],'imgUrl'=>$attributes['params']['imgUrl'],'user_id'=>$attributes['params']['user_id'],'category_name'=>$attributes['params']['pid']['name'],'category_id'=>$attributes['params']['pid']['id']]);
                 if($data)
                 {
                     if(isset($attributes['params']['tags']) && $attributes['params']['tags'])
                     {
                         $data->tags()->sync($attributes['params']['tags']);
                     }
                 }
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
            $data = Attraction::find($id);
            
            if(!$data)
            {
                $this->response->withNotFount('没有找到这段数据');
            }
            $data->delete();
            return $this->response->withNoContent();
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '删除失败';
            return $this->response->json(compact('responData'));
        }
     }
     //点赞
     public function postLikePost(Request $request)
     {
        $responData = [
            'status'=>200
        ];
         try{
            $this->validate($request, [
                    'id' => 'required|exists:offers_activitie,id',
                ]);
    
            $user = $request->user();
            $post = Attraction::find($request->id);
    
            $type = count($user->toggleLike($post)['attached'])
                    ? $post::OFFERS_LIKE
                    : $post::OFFERS_UNLIKE;
            event(new LikeAttraction($post, $type));
    
            return $this->response->json(['success' => true]);
         }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '点赞失败';
            return $this->response->json(compact('responData'));
        }
     }
     // 收藏
     public function postFavouritePost(Request $request)
     {
         try{
            $this->validate($request, [
                    'id' => 'required|exists:offers_activitie,id',
                ]);
    
            $user = $request->user();
            $post = Attraction::find($request->id);
    
            $type = count($user->toggleFavorite($post)['attached'])
                    ? $post::OFFERS_FAVORITE
                    : $post::OFFERS_UNFAVORITE;
    
            event(new FavoriteAttraction($post, $type));
    
            return $this->response->json(['success' => true]);
         }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '收藏失败';
            return $this->response->json(compact('responData'));
        }
     }
     // 评论
     public function storeComment(Request $request, $id)
     {
         $responData = [
             'status'=>200,
             'messages'=>'ok'
         ];
         try
         {
             $post = Attraction::whereId($id)->firstOrFail();
 
             $comment = $post->comments()->create($request->all());
             $post->user->notify(new AttractionComment($post, $comment));
             $responData['users'] = $comment->user;
             $responData['comment'] = $comment;
             $responData['messages'] = '发表成功';
         }catch(Exception $e)
         {
             $responData['status'] = 500;
             $responData['messages'] = '发表评论失败';
         }
         return $this->response->json(compact('responData'));
     }
     public function findCategory($id)
     {
        $responData = [
            'status'=>200,
            'messages'=>'ok'
        ];
        try
        {
            $data = Attraction::find($id);
            if($data)
            {
                $responData['data'] = $data;
            }
            
        }catch(Exception $e)
        {
           $responData['status'] = 500;
           $responData['messages'] = '没有找到数据';
        }
        return $this->response->json(compact('responData'));
     }

}
