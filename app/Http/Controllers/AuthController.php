<?php

namespace App\Http\Controllers;
use Auth;
use Lang;
use App\User;
use App\Role;
use App\Services\Jwt;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\RegisterRequests;
use Illuminate\Support\Facades\Validator; 
class AuthController extends ApiController
{
    //限制登入次数
    use ThrottlesLogins,RegistersUsers;
    // 登入 并发放token
    public function login(Request $request)
    {
        // 判断是否多次登入失败，如果是需要禁用段时间登入
        if($this->hasTooManyLoginAttempts($request))
        {
            // 锁住登入请求
            $this->fireLockoutEvent($request);
            // 返回锁住响应状态信息
            return $this->sendLockoutResponse($request);
        }
        $credentials = $request->only('iphone','password');
        
        //验证登入信息成功并生成token
        if ($token = Auth::guard('api')->attempt($credentials)) 
        {
            // 判断用户状态是否允许登入
            if(Auth::guard('api')->user()->status === 1)
            {
                // All good so return the json with token and user.
                return $this->sendLoginResponse($request, $token);
            }
            
        }
        // 递增登入次数
        $this->incrementLoginAttempts($request);
        // 返回登入失败信息
        return $this->sendFailedLoginResponse($request);
    }
    /*
    * 注册成功返回一个用户token
    */
    public function register(RegisterRequests $request)
    {
        $validator = $this->validator($request->all());
        if($validator->fails())
        {
            return $this->response->withError('注册失败，帐号已经被注册');
        }
        $credentials = [
            'iphone'    =>  $request->input('iphone'),
            'name'      =>  $request->input('username'),
            'sex'       =>  $request->input('sex'),
            'email'     =>  $request->input('email'),
            'password'  =>  bcrypt($request->input('password')),
            'address'   =>  $request->input('province').$request->input('city').$request->input('area')
                
        ];
        $guard = Role::where('slug','guard')->first();
        $id = factory(User::class, 1)->create($credentials)->each(function ($u) use ($guard){
            $u->attachRole($guard);
        });
        if($id)
        {
            if($token = Auth::guard('api')->attempt($request->only('iphone','password')))
            {
                return $this->sendLoginResponse($request, $token);
            }
        }
    }
    /**
     * 返回一个token 到当前用户
     *
     * @param Request $request
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendLoginResponse(Request $request, $token)
    {
        // 清除请求
        $this->clearLoginAttempts($request);
        $user = $this->response->transform->item(Auth::guard('api')->user());
        // 获取token 过期时间
        $token_ttl = (new Jwt($token))->getTokenTTL();
        return $this->response->json(compact('token', 'token_ttl', 'user'));
    }
     /**
     * 确定登入无效后返回失败信息
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $message = Lang::get('auth.failed');
        return $this->response->withUnauthorized($message);
    }
    /**
     * 在多次登入被锁后重定向用户.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );
        $message = Lang::get('auth.throttle', ['seconds' => $seconds]);
        return $this->response->withTooManyRequests($message);
    }
    /**
     * 移除用户token
     *
     * @return \Illuminate\Http\Response
     */
    public function revokeToken()
    {
        Auth::guard('api')->logout();
        return $this->response->withNoContent();
    }
    /**
     * 刷新用户token.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshToken(Request $request)
    {
        $token = Auth::guard('api')->refresh();
        // 获取token 过期时间
        $token_ttl = (new Jwt($token))->getTokenTTL();
        return $this->response->json(compact('token', 'token_ttl'));
    }
    // 通过什么来登入
    public function username()
    {
        return 'iphone';
    }
    // 验证注册
    protected function validator(array $data) 
    { 
        return Validator::make($data, [ 
            'email' => 'required|email|max:255', 
            'password' => 'required|min:6', 
            'sex'   => 'required',
            'iphone' => 'required|unique:users'
        ]); 
    } 
}

