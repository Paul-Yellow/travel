<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Http\Request;
use App\Services\BaseManager;
use App\User;
use App\Comment;
use Carbon\Carbon;
use App\Feedback;
use App\Events\VoteComment;
use App\Events\UserFollow;
use App\Transformers\NotificationTransformer;
use App\UserLog;
// 用户发表文章
use App\Talent;
use DB;
class MeController extends ApiController
{
    public function index()
    {
        $responData = [
            'status'=> 200,
            'messages'=>'ok'
        ];
        try
        {
            $user = Auth::guard('api')->user();
            
            $permission = Auth::guard('api')->user()->getPermissions();
            $roles = Auth::guard('api')->user()->getRoles();
            if(!$user->isEmpty())
            {
                $responData['user'] =  $this->response->transform->item($user);
            }
            if(!$permission->isEmpty())
            {
                $responData['permission'] = $permission->pluck('slug');
            }
            if(!$roles->isEmpty())
            {
                $responData['roles'] = $roles->pluck('slug');
            }
            $responData['messages'] = '获取成功';
        }catch(Exception $e)
        {
            $responData['status'] = 500;
            $responData['messages'] = '获取失败';
        }
        return $this->response->json(compact('responData'));
    }
    // 上传头像
    public function store(Request $request)
    {
        $responData = [
            'status'=>200
        ];
        try{
            $file = $request->file('img');
            $upload = new BaseManager();
            if (!$request->hasFile('img'))
            {
                return $this->withNotFound();
            }

            $path = 'avatar'. '/' . date('Y') . '/' . date('m') . '/' . date('d');
            $result = $upload->store($file, $path);
            $user = Auth::guard('api')->user();
            $user->avatar = $result['url'];
            $user->save();
            return  $this->response->json(compact('result'));
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '上传失败.请检测目录是否赋予了可写权限';
            return $this->response->json(compact('responData'));
        }
    }
    // 更新用户信息
    public function update(Request $request,$id)
    {
        $responData = [
            'status'=>200
        ];
        try{
            $userinfo = User::find($id);
            if(!$userinfo)
            {
                $this->response->withNotFount('没有找到这段数据');
            }
            $credentials = [
                    'name'      =>  $request->input('username'),
                    'sex'       =>  $request->input('sex'),
                    'email'     =>  $request->input('email'),
                    'address'   =>  $request->input('province').$request->input('city').$request->input('area')
                ];
            $userinfo->fill($credentials)->save();
            return $this->response->item($userinfo);
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '更新失败';
            return $this->response->json(compact('responData'));
        }
    }
    // 创建
    public function create()
    {
    }
    // 编辑
    public function edit($id,Request $request)
    {
    }
    // cancel
    public function show(Request $request)
    {

    }
    // 删除
    public function destroy($id)
    {
    }
    // 关注
    public function postFollowers(Request $request)
    {
        $responData = [
            'status'=>200
        ];
        try{
            $this->validate($request, [
                    'id' => 'required|exists:users,id',
                ]);

            $user = $request->user();
            $target = User::find($request->id);

            $type = count($user->toggleFollow($target)['attached'])
                    ? $user::USER_FOLLOW
                    : $user::USER_UNFOLLOW;
            event(new UserFollow($target, $type));

            return $this->response->json(['success' => true]);
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '关注失败';
            return $this->response->json(compact('responData'));
        }
    }
    // 评论点赞
    public function postVoteComment(Request $request, $type)
    {
        $responData = [
            'status'=>200
        ];
        try{
            $this->validate($request, [
                    'id' => 'required|exists:comments,id',
                ]);

            $user = $request->user();
            $comment = Comment::find($request->id);
            $voteType = ($type == 'up')
                        ? $this->toggleVote($user, $comment)
                        : $this->toggleDownVote($user, $comment);
            event(new VoteComment($comment, $voteType));

            return $this->response->json(['success' => true]);
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '删除失败';
            return $this->response->json(compact('点赞失败'));
        }
    }

    public function toggleVote($user, $target)
    {
        $hasVoted = $user->hasUpVoted($target);

        $hasVoted ? $user->cancelVote($target) : $user->upVote($target);

        return $hasVoted ? $target::COMMENT_CANCEL_UP_VOTE : $target::COMMENT_UP_VOTE;
    }

    public function toggleDownVote($user, $target)
    {
        $hasDownVoted = $user->hasDownVoted($target);

        if ($hasDownVoted) {
            $type = $target::COMMENT_CANCEL_DOWN_VOTE;
            $user->cancelVote($target);
        } else {
            $type = $user->hasUpVoted($target) ? $target::COMMENT_UP_TO_DOWN_VOTE : $target::COMMENT_DOWN_VOTE;
            $user->downVote($target);
        }

        return $type;
    }
    // 获取关注数
    public function getFollowers()
    {
        $responData = [
            'status'=>200
        ];
        try{
            return $this->response->collection(auth()->user()->followers());
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '获取关注数失败';
            return $this->response->json(compact('responData'));
        }
    }
    // 获取通知
    public function getNotifications()
    {
        $responData = [
            'status'=>200
        ];
        try{
            return $this->response->collection(auth()->user()->notifications, new NotificationTransformer);
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '获取通知消息失败';
            return $this->response->json(compact('responData'));
        }
    }
    // 已读站内消息
    public function markAsRead($id = null)
    {
        $responData = [
            'status'=>200
        ];
        try{
            $notifications = auth()->user()->unreadNotifications();

            if ($id) {
                $notifications->where('id', $id);
            }

            $notifications->update(['read_at' => Carbon::now()]);

            return $this->response->withNoContent();
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '已读消息发生异常';
            return $this->response->json(compact('responData'));
        }
    }
    // 反馈
    public function addFeedBack(Request $request)
    {
        $responData = [
            'status'=>200
        ];
        try{
            Feedback::create($request->only('content'));

            return $this->response->withNoContent();
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '发生异常';
            return $this->response->json(compact('responData'));
        }
    }
    // 操作日志
    public function getLogList()
    {
        $responData = [
            'status'=>200
        ];
        // 分页排序数据
        try{
            $sort = $this->parameters->sort();
            $order = $this->parameters->order();
            $limit = $this->parameters->limit();
            $list = UserLog::orderBy($sort, $order)->paginate($limit);
            return $this->response->collection($list);
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '没有操作日志';
            return $this->response->json(compact('responData'));
        }
    }
    //评论列表
    public function commentList()
    {
        $responData = [
            'status'=>200
        ];
        // 分页排序数据
        try{
            $sort = $this->parameters->sort();
            $order = $this->parameters->order();
            $limit = $this->parameters->limit();
            $list = Comment::orderBy($sort, $order)->paginate($limit);
            return $this->response->collection($list);
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '评论列表为空';
            return $this->response->json(compact('responData'));
        }
    }
    // 删除评论
    public function deleteComment($id)
    {
        $responData = [
            'status'=>200
        ];
        try{
            $comment = Comment::find($id);
            
            if(!$comment)
            {
                $this->response->withNotFount('没有找到这段数据');
            }
            $comment->delete();
            return $this->response->withNoContent();
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '删除失败';
            return $this->response->json(compact('responData'));
        }
    }
}
