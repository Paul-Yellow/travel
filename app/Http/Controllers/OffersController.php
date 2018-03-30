<?php

namespace App\Http\Controllers;
use App\Offers;
use App\NewEvents;
use Illuminate\Http\Request;
use App\Events\LikeOffers;
use App\Events\FavoriteOffers;
use App\Notifications\OffersComment;
use App\Events\UserCreditChanged;
use App\Category;
use App\Tag;
use Exception;
use DB;
class OffersController extends ApiController
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
            $list = Offers::orderBy($sort, $order)->paginate($limit);
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
                $data = Offers::create(['name'=>$attributes['params']['name'],'content'=>$attributes['params']['content'],'content_short'=>$attributes['params']['content_short'],'area'=>$attributes['params']['region'],'date'=>$attributes['params']['date2'],'ln'=>$attributes['params']['latitude'][0],'lo'=>$attributes['params']['latitude'][1],'imgUrl'=>$attributes['params']['imgUrl'],'user_id'=>$attributes['params']['user_id'],'category_name'=>$attributes['params']['pid']['name'],'category_id'=>$attributes['params']['pid']['id'],'explain'=>$attributes['params']['explain'],'phone'=>$attributes['params']['phone']]);
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
        try
        {
            $data = Offers::find($id);
            if(!$data)
            {
                $this->response->withNotFount('没有找到这段数据');
            }
            $newevent_limit = NewEvents::orderBy('updated_at')->offset(0)->limit(5)->get();
            $data->increment('view_count',1);
            if($data->user)
            {
                // $this->response->collection
                // $this->response->transform->item
                $responData['user'] = $this->response->transform->item($data->user);
            }
            if($data)
            {
                $responData['data'] = $data;
            }
            if($newevent_limit)
            {
                $responData['newevent_limit'] = $newevent_limit;
            }
            
            if($data->comments)
            {
                
                // $responData['comments'] = $this->response->transform->collection($data->comments);
                $responData['comments'] = $data->comments;
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
            $data = Offers::find($id);
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
            $data = Offers::find($id);
            DB::transaction(function () use ($attributes,$data) {
                $data->update(['name'=>$attributes['params']['name'],'content'=>$attributes['params']['content'],'content_short'=>$attributes['params']['content_short'],'area'=>$attributes['params']['region'],'date'=>$attributes['params']['date2'],'ln'=>$attributes['params']['latitude'][0],'lo'=>$attributes['params']['latitude'][1],'imgUrl'=>$attributes['params']['imgUrl'],'user_id'=>$attributes['params']['user_id'],'category_name'=>$attributes['params']['pid']['name'],'category_id'=>$attributes['params']['pid']['id'],'explain'=>$attributes['params']['explain'],'phone'=>$attributes['params']['phone']]);
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
            $data = Offers::find($id);
            
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
        try{
            $this->validate($request, [
                    'id' => 'required|exists:offers_activitie,id',
                ]);

            $user = $request->user();
            $post = Offers::find($request->id);

            $type = count($user->toggleLike($post)['attached'])
                    ? $post::OFFERS_LIKE
                    : $post::OFFERS_UNLIKE;
            event(new LikeOffers($post, $type));

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
                    'id' => 'required|exists:offers_activitie,id',
                ]);

            $user = $request->user();
            $post = Offers::find($request->id);

            $type = count($user->toggleFavorite($post)['attached'])
                    ? $post::OFFERS_FAVORITE
                    : $post::OFFERS_UNFAVORITE;

            event(new FavoriteOffers($post, $type));

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
            $post = Offers::whereId($id)->firstOrFail();

            $comment = $post->comments()->create($request->all());
            $post->user->notify(new OffersComment($post, $comment));
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
