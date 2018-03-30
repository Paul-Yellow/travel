<?php
return[
    // 序列化数据
    'serializer' => League\Fractal\Serializer\DataArraySerializer::class,
    // 转换数据
    'transformers' =>[
        App\User::class => App\Transformers\UserTransformer::class,
        App\Role::class => App\Transformers\RoleTransformer::class,
        App\Permission::class => App\Transformers\PermissionTransformer::class,
        App\Dashborde::class  => App\Transformers\DashTransformer::class,
        App\Menu::class => App\Transformers\MenuTransformer::class,
        App\UploadImg::class => App\Transformers\UploadImageTransformer::class,
        App\NewEvents::class => App\Transformers\NewEventsTransformer::class,
        App\ActiveEvents::class => App\Transformers\ActiveEventsTransformer::class,
        App\Category::class => App\Transformers\CategoryTransformer::class,
        App\Comment::class => App\Transformers\CommentTransformer::class,
        App\Tag::class => App\Transformers\TagTransformer::class,
        App\UserLog::class => App\Transformers\UserLogTransformer::class,
        App\Feedback::class => App\Transformers\FeedbackTransformer::class,
        App\Link::class => App\Transformers\LinkTransformer::class,
        //AttractionTransformer
        App\Offers::class => App\Transformers\OffersTransformer::class,
        App\Talent::class => App\Transformers\TalentTransformer::class,
        App\Attraction::class => App\Transformers\AttractionTransformer::class,
    ]
];