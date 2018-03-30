<?php

namespace App\Http\Controllers;
use App\NewEvents;
use App\ActiveEvents;
use Illuminate\Http\Request;
use App\Events\LikePost;
use App\Events\FavoritePost;
use App\Notifications\UserComment;
// use App\Transformers\CommentTransformer;
use App\Events\UserCreditChanged;
use App\Category;
use App\Tag;
use Exception;
use DB;
class NewEventsController extends ApiController
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
            $list = NewEvents::orderBy($sort, $order)->paginate($limit);
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
            $responData['categories'] = $categoriesData ;
            $tag = Tag::all();
            $responData['tag'] = $tag;
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
                $newevents = NewEvents::create(['title'=>$attributes['params']['title'],'content'=>$attributes['params']['content'],'content_short'=>$attributes['params']['content_short'],'area'=>$attributes['params']['region'],'date'=>$attributes['params']['date2'],'ln'=>$attributes['params']['latitude'][0],'lo'=>$attributes['params']['latitude'][1],'imgUrl'=>$attributes['params']['imgUrl'],'user_id'=>$attributes['params']['user_id'],'category_name'=>$attributes['params']['pid']['name'],'category_id'=>$attributes['params']['pid']['id']]);
                event(new UserCreditChanged(2));
                if($newevents)
                {
                    if(isset($attributes['params']['tags']) && $attributes['params']['tags'])
                    {
                        $newevents->tags()->sync($attributes['params']['tags']);
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
        try
        {
            $newevents = NewEvents::find($id);
            if(!$newevents)
            {
                $this->response->withNotFount('没有找到这段数据');
            }
            $newevent_limit = NewEvents::orderBy('updated_at')->offset(0)->limit(5)->get();
            $activeevent_limit = ActiveEvents::orderBy('updated_at')->offset(0)->limit(5)->get();
            $newevents->increment('view_count',1);
            if($newevents->user)
            {
                // $this->response->collection
                // $this->response->transform->item
                $responData['user'] = $this->response->transform->item($newevents->user);
            }
            if($newevents)
            {
                $responData['newevents'] = $newevents;
            }
            if($newevent_limit)
            {
                $responData['newevent_limit'] = $newevent_limit;    
            }
            if($activeevent_limit)
            {
                $responData['activeevent_limit'] = $activeevent_limit;
            }
            
            if($newevents->comments)
            {
                
                // $responData['comments'] = $this->response->transform->collection($newevents->comments);
                $responData['comments'] = $newevents->comments;
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
            $newevents = NewEvents::find($id);
            $category = Category::all();
            $tag = Tag::all();
            if($newevents)
            {
                $responData['newevents'] =  $this->response->transform->item($newevents);
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
            $newevents = NewEvents::find($id);
            DB::transaction(function () use ($attributes,$newevents) {
                $newevents->update(['title'=>$attributes['params']['title'],'content'=>$attributes['params']['content'],'content_short'=>$attributes['params']['content_short'],'area'=>$attributes['params']['region'],'date'=>$attributes['params']['date2'],'ln'=>$attributes['params']['latitude'][0],'lo'=>$attributes['params']['latitude'][1],'imgUrl'=>$attributes['params']['imgUrl'],'user_id'=>$attributes['params']['user_id'],'category_name'=>$attributes['params']['pid']['name'],'category_id'=>$attributes['params']['pid']['id']]);
                if($newevents)
                {
                    if(isset($attributes['params']['tags']) && $attributes['params']['tags'])
                    {
                        $newevents->tags()->sync($attributes['params']['tags']);
                    }
                }
            });
            $responData['messages'] = '修改成功';
        }catch(Exception $e)
        {
            $responData['status'] = 500;
            $responData['messages'] = '没有找到数据';
        }
        return $this->response->json(compact('responData'));
    }
    public function destroy($id)
    {
        $responData = [
            'status'=>200
        ];
        try{
            $newevents = NewEvents::find($id);
            
            if(!$newevents)
            {
                $this->response->withNotFount('没有找到这段数据');
            }
            $newevents->delete();
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
        try{
            $this->validate($request, [
                    'id' => 'required|exists:newevent,id',
                ]);

            $user = $request->user();
            $post = NewEvents::find($request->id);

            $type = count($user->toggleLike($post)['attached'])
                    ? $post::NEWEVENT_LIKE
                    : $post::NEWEVENT_UNLIKE;
            event(new LikePost($post, $type));

            return $this->response->json(['success' => true]);
        }catch(Exception $e){
            return $this->response->json(['messages'=>'点赞失败']);
        }
    }
    // 收藏
    public function postFavouritePost(Request $request)
    {
        try{
            $this->validate($request, [
                    'id' => 'required|exists:newevent,id',
                ]);

            $user = $request->user();
            $post = NewEvents::find($request->id);

            $type = count($user->toggleFavorite($post)['attached'])
                    ? $post::NEWEVENT_FAVORITE
                    : $post::NEWEVENT_UNFAVORITE;

            event(new FavoritePost($post, $type));

            return $this->response->json(['success' => true]);
        }catch(Exception $e){
            return $this->response->json(['messages'=>'收藏失败']);
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
            $post = NewEvents::whereId($id)->firstOrFail();

            $comment = $post->comments()->create($request->all());
            $post->user->notify(new UserComment($post, $comment));
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
}
