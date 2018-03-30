<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Talent;
use App\Events\LikeTalent;
use App\Events\FavoriteTalent;
use App\Notifications\TalentComment;
use App\Events\UserCreditChanged;
use Exception;
use DB;
class TalentController extends ApiController
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
            $list = Talent::orderBy($sort, $order)->paginate($limit);
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
                Talent::create(['title'=>$attributes['params']['title'],'content'=>$attributes['params']['content'],'content_short'=>$attributes['params']['content_short'],'date'=>$attributes['params']['date2'],'imgUrl'=>$attributes['params']['imgUrl'],'user_id'=>$attributes['params']['user_id']]);
                event(new UserCreditChanged(2));
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
            $talent = Talent::find($id);
            if(!$talent)
            {
                $this->response->withNotFount('没有找到这段数据');
            }
            $talent->increment('view_count',1);
            if($talent->user)
            {
                $responData['user'] = $this->response->transform->item($talent->user);
            }
            if($talent)
            {
                $responData['talent'] = $talent;
            }
            
            if($talent->comments)
            {
                // $responData['comments'] = $this->response->transform->collection($talent->comments);
                $responData['comments'] = $talent->comments;
            }
        }catch(Exception $e)
        {
           $responData['status'] = 500;
           $responData['messages'] = '没有找到数据';
        }
        return $this->response->json(compact('responData'));
    }
    // cancel
    public function edit($id)
    {
        $responData = [
            'status'=>200,
            'messages'=>'ok'
        ];
        try
        {
            $talent = Talent::find($id);
            if($talent)
            {
                $responData['talent'] =  $this->response->transform->item($talent);
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
            $talent = Talent::find($id);
            DB::transaction(function () use ($attributes,$talent) {
                $talent->update(['title'=>$attributes['params']['title'],'content'=>$attributes['params']['content'],'content_short'=>$attributes['params']['content_short'],'date'=>$attributes['params']['date2'],'imgUrl'=>$attributes['params']['imgUrl'],'user_id'=>$attributes['params']['user_id']]);
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
            $talent = Talent::find($id);
            
            if(!$talent)
            {
                $this->response->withNotFount('没有找到这段数据');
            }
            $talent->delete();
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
                    'id' => 'required|exists:talent,id',
                ]);

            $user = $request->user();
            $post = Talent::find($request->id);

            $type = count($user->toggleLike($post)['attached'])
                    ? $post::TALENT_LIKE
                    : $post::TALENT_UNLIKE;
            event(new LikeTalent($post, $type));

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
        $responData = [
            'status'=>200
        ];
        try{
            $this->validate($request, [
                    'id' => 'required|exists:talent,id',
                ]);

            $user = $request->user();
            $post = Talent::find($request->id);

            $type = count($user->toggleFavorite($post)['attached'])
                    ? $post::TALENT_FAVORITE
                    : $post::TALENT_UNFAVORITE;

            event(new FavoriteTalent($post, $type));

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
            $post = Talent::whereId($id)->firstOrFail();

            $comment = $post->comments()->create($request->all());
            $post->user->notify(new TalentComment($post, $comment));
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
