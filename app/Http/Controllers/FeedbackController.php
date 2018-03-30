<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;
class FeedbackController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $responData = [
            'status'=>200
        ];
        try{
            $sort = $this->parameters->sort();
            $order = $this->parameters->order();
            $limit = $this->parameters->limit();
            $list = Feedback::orderBy($sort, $order)->paginate($limit);
            return $this->response->collection($list);
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '数据是空的';
            return $this->response->json(compact('responData'));
        }
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
            $feed = Feedback::find($id);
            
            if(!$feed)
            {
                $this->response->withNotFount('没有找到这段数据');
            }
            $feed->delete();
            return $this->response->withNoContent();
        }catch(Exception $e){
            $responData['status'] = 500;
            $responData['messages'] = '删除失败';
            return $this->response->json(compact('responData'));
        }
    }
}
