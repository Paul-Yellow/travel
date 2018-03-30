<?php

namespace App\Providers;
use App\Repositories\Transform;
use League\Fractal\Manager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        \Carbon\Carbon::setlocale('zh');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //注册转换数据服务 通过依赖注入来响应数据
        $this->app->bind(Transform::class, function ($app) {
            $fractal = new Manager;
            $serializer = $app['config']->get('api.serializer');
            if (request()->has('include')) {
                $fractal->parseIncludes(request()->query('include'));
            }
            $fractal->setSerializer(new $serializer);
            return new Transform($fractal);
        });
    }
}
