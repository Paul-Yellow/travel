<?php
namespace App\Repositories;
use League\Fractal\Manager;
use League\Fractal\TransformerAbstract;
use Illuminate\Database\Eloquent\Collection;
use League\Fractal\Resource\Item as FractalItem;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection as FractalCollection;
/*
注册转换api 数据服务
*/ 
class Transform
{
    private $fractal;
    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
    }
    // 转换集和数据
    public function collection($data, TransformerAbstract $transformer = null)
    {
        $transformer = $transformer ?: $this->fetchDefaultTransformer($data);
        $collection = new FractalCollection($data, $transformer);
        if ($data instanceof LengthAwarePaginator) {
            $collection->setPaginator(new IlluminatePaginatorAdapter($data));
        }
        return $this->fractal->createData($collection)->toArray();
    }
    // 转换单个数据
    public function item($data, TransformerAbstract $transformer = null)
    {
        $transformer = $transformer ?: $this->fetchDefaultTransformer($data);
        return $this->fractal->createData(
            new FractalItem($data, $transformer)
        )->toArray();
    }
    // 获取 config/api 数据服务中的默认转换数据
    protected function fetchDefaultTransformer($data)
    {
        $classname = $this->getClassnameFrom($data);
        if ($this->hasDefaultTransformer($classname)) {
            $transformer = config('api.transformers.'.$classname);
            return new $transformer;
        }
    }
    //检查是config/api 里面是否有数据
    protected function hasDefaultTransformer($classname)
    {
        return ! is_null(config('api.transformers.'.$classname));
    }

    // get 类名给对象
    protected function getClassnameFrom($object)
    {
        if ($object instanceof LengthAwarePaginator or $object instanceof Collection) {
            return get_class(array_first($object));
        }
        return get_class($object);
    }
}