<?php

namespace App\Http\Controllers;
use App\Dashborde;
use App\NewEvents;
use App\ActiveEvents;
use App\Attraction;
use Exception;
use Illuminate\Http\Request;

class IndexController extends ApiController
{
    //
    public function index()
    {
        $responData = [
            'status'=>200,
            'messages' => 'ok'
        ];
        try
        {
            $dash = Dashborde::all();
            $newevent = NewEvents::offset(0)->limit(5)->get();
            $activeevent = ActiveEvents::offset(0)->limit(5)->get();
            $attraction = Attraction::offset(0)->limit(5)->get();
            if(!$dash->isEmpty())
            {
                $responData['dash'] = $dash;
            }
            if(!$newevent->isEmpty())
            {
                $responData['newevent'] = $newevent;
            }
            if(!$activeevent->isEmpty())
            {
                $responData['activeevent'] = $activeevent;
            }
            if(!$attraction->isEmpty())
            {
                $responData['attraction'] = $attraction;
            }
        }catch(Exception $e)
        {
            $responData['status'] = 500;
            $responData['messages'] = '获取数据失败!';
        }
        return $this->response->json(compact('responData'));
    }
  
}
