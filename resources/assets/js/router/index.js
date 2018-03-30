import Router from 'vue-router';
import Layout from 'views/layout/home-app';
import store from 'store/store';
import AdminLayout from 'views/layout/admin-app';
import beforeEach from 'router/beforeEach';
import AA from 'views/home/index';
const HomeIndex = () => import('../views/home/index');
// 创建最新活动
const NewEventCreate = ()=>import('../views/admin/events/newevent/create');
const router = new Router({
    linkActiveClass: 'active',
    mode: 'history', //需要服务端支持
    // base: __dirname,
    scrollBehavior (to, from, savedPosition) {
        return { x: 0, y: 0 }
    },
    routes: [
        { 
            path: '/',
            name: '主页',
            component:Layout,
            hidden: true,
            meta:{
                requiresAuth: false,
            },
            // redirect: '/index',
            children: [{
                path: '/',
                component: HomeIndex,
                name: '万家山庄主页',
                meta:{
                    requiresAuth: false,
                },
            }, {
                path: 'login',
                component: ()=>import('../components/auth/signin.vue'),
                name: '登入页面',
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'signup',
                component: ()=>import('components/auth/signup.vue'),
                name: '注册页面',
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'service',
                component: ()=>import('components/home/me/service'),
                name: '服务条款',
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'react-native',
                component: ()=>import('views/home/rnApp/index'),
                name: 'app页面',
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'zhongyuan/list',
                component: ()=>import('components/home/zhongyuan/zhongyuanlist'),
                name:'认识中原',
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'newevent',
                component: ()=>import('views/home/events/newevent/list'),
                name: '最新活动',
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'newevent/detail/:id',
                component: ()=>import('views/home/events/newevent/detail'),
                name: '活动详情',
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'activeevent',
                component: ()=>import('views/home/events/activeevent/list'),
                name: '活动盛事',
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'activeevent/detail/:id',
                component: ()=>import('views/home/events/activeevent/detail'),
                name: '活动详情',
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'offers',
                component: ()=>import('views/home/events/offers/list'),
                name: '优惠信息',
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'offers/detail/:id',
                component: ()=>import('views/home/events/offers/detail'),
                name: '优惠详情',
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'mustv-visit',
                component: ()=>import('views/home/zhongyuan/mustv/list'),
                name: '中源必游',meta:{
                    requiresAuth: false,
                },
            },{
                path: 'mustv-visit/biyou',
                name: '来中原必做的六件事',
                component: ()=>import('views/home/zhongyuan/mustv/biyou'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'mustv-visit/bichi',
                name: '来中源必吃的特色小吃',
                component: ()=>import('views/home/zhongyuan/mustv/bichi'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'tags',
                name: '热门TAG',
                component: () => import('views/home/zhongyuan/tags/index'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'tags/detail',
                name: 'tag详情',
                component: () => import('views/home/zhongyuan/tags/detail'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'talent',
                name: '达人推荐列表',
                component: () => import('views/home/zhongyuan/talent/list'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'talent/detail/:id',
                name: '达人推荐详情',
                component: () => import('views/home/zhongyuan/talent/detail'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'acc/noticelist',
                name: '住宿须知',
                component: ()=>import('views/home/travel/accommodation/index'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'acc/noticelist/linian',
                name: '历年优良宾馆',
                component: ()=>import('views/home/travel/accommodation/linian'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'acc/noticelist/security',
                name: '住宿安全',
                component: ()=>import('views/home/travel/accommodation/security'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'acc/noticelist/bilingual',
                name: '旅馆标章',
                component: ()=>import('views/home/travel/accommodation/bilingual'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'acc/noticelist/mark',
                name: '双语标示',
                component: ()=>import('views/home/travel/accommodation/mark'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'acc/noticelist/check',
                name: '建筑安全检查',
                component: ()=>import('views/home/travel/accommodation/check'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'acc/noticelist/cancel',
                name: '公告注销',
                component: ()=>import('views/home/travel/accommodation/cancel'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'acc/noticelist/wenquan',
                name: '温泉标章',
                component: ()=>import('views/home/travel/accommodation/wenquan'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'information/trafficlist',
                name: '交通资讯',
                component: ()=>import('views/home/information/trafficlist/index'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'information/trafficlist/changbei',
                name: '昌北机场到中源',
                component: ()=>import('views/home/information/trafficlist/changbei'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'information/trafficlist/gaotie',
                name: '高铁到中源',
                component: ()=>import('views/home/information/trafficlist/gaotie'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'information/trafficlist/huoche',
                name: '火车站到中源',
                component: ()=>import('views/home/information/trafficlist/huoche'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'information/trafficlist/qiche',
                name: '汽车站到中源',
                component: ()=>import('views/home/information/trafficlist/qiche'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'information/trafficlist/danche',
                name: '共享单车起行',
                component: ()=>import('views/home/information/trafficlist/danche'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'information/server/index',
                name: '旅客服务',
                component: ()=>import('views/home/information/server/index'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'information/server/rexian',
                name: '常用服务热线',
                component: ()=>import('views/home/information/server/rexian'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'information/server/faq',
                name: '常见问题',
                component: ()=>import('views/home/information/server/faq'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'information/server/link',
                name: '链接专区',
                component: ()=>import('views/home/information/server/link'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'information/tipslist/index',
                name: '旅游须知',
                component: ()=>import('views/home/information/tipslist/index'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'information/tipslist/dengshan',
                name: '登山须知',
                component: ()=>import('views/home/information/tipslist/dengshan'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'information/tipslist/yongdian',
                name: '用电须知',
                component: ()=>import('views/home/information/tipslist/yongdian'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'information/tipslist/jinan',
                name: '急难救治',
                component: ()=>import('views/home/information/tipslist/jinan'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'information/tipslist/biaoshi',
                name: '旅馆标示',
                component: ()=>import('views/home/information/tipslist/biaoshi'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'attraction/category',
                name: '主题景点',
                component: ()=>import('views/home/attraction/index'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'attraction/list',
                name: '景点快搜',
                component: ()=>import('views/home/attraction/list'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'attraction/top',
                name: '景点top',
                component: ()=>import('views/home/attraction/top'),
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'attraction/detail/:id',
                name: '景点详情',
                component: () =>import('views/home/attraction/detail'),
                meta:{
                    requiresAuth: false,
                },
            }]
        },{
            path: '/zhongyuan',
            hidden: true,
            component: Layout,
            name: '玩转中原',
            redirect: '/zhongyuan/list',
            meta:{
                requiresAuth: false,
            },
            children:[{
                path: 'list',
                component: ()=>import('components/home/zhongyuan/zhongyuanlist'),
                name:'认识中原',
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'list/overview',
                component: ()=>import('components/home/zhongyuan/overview'),
                name: '中原概述',
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'list/arts',
                component: ()=>import('components/home/zhongyuan/arts'),
                name: '人文艺术',
                meta:{
                    requiresAuth: false,
                },
            },{
                path: 'list/exploring',
                component: ()=>import('components/home/zhongyuan/exploring'),
                name: '户外搜索', 
                meta:{
                    requiresAuth: false,
                },
            }]
            
        },{
            path:'/me',
            hidden: true,
            component: Layout,
            name: '个人中心首页',
            meta:{
                requiresAuth: true,
                role:['admin','user','guard'],
                permission: 'me'
            },
            redirect: '/me/index',
            children:[{
                name:'个人中心',
                path: 'index',
                meta:{
                    requiresAuth: true,
                    role:['admin','user','guard'],
                    permission: 'me.index'
                },
                component: ()=>import('components/home/me/profile')
            },{
                name:'创建旅游推荐文章',
                path: 'create',
                meta:{
                    requiresAuth: true,
                    role:['admin','user','guard'],
                    permission: 'me.create'
                },
                component: ()=>import('components/home/me/create')
            },{
                name:'编辑旅游推荐文章',
                path: ':id/edit',
                meta:{
                    requiresAuth: true,
                    role:['admin','user','guard'],
                    permission: 'me.edit'
                },
                component: ()=>import('components/home/me/edit')
            },{
                name: '通知中心',
                path: 'notification',
                meta:{
                    requiresAuth: true,
                    role:['admin','user','guard'],
                    permission: 'me.notification'
                },
                component: ()=>import('components/home/me/Notification')
            }]

        },{
            path: '/401',
            hidden: true,
            name: '权限错误页面',
            component: ()=>import('views/error/401.vue'),
            meta:{
                requiresAuth: false
            }
        },{
            path: '*',
            hidden: true,
            name: '没有找到页面',
            component: ()=>import('views/error/404.vue'),
            meta:{
                requiresAuth: false
            }
        },{
            path: '/admin',
            name: '控制台',
            redirect: '/admin/dashborde',
            component: AdminLayout,
            noDropdown: true,
            meta:{
                requiresAuth: true,
                role:['admin','user'],
                permission: 'dashborde.index'
            },
            iconname: 'icon-dashborde',
            children: [{
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'dashborde.index'
                },
                path: 'dashborde',
                component: ()=>import('views/admin/dashboard/index.vue'),
                name: '控制台'
            }]
        },{
            path: '/admin/category',
            component: AdminLayout,
            name: '类型管理',
            noDropdown: true,
            redirect: '/admin/category/list',
            meta: {
                requiresAuth: true,
                role: ['admin'],
                permission: 'category.index'
            },
            iconname: 'icon-category',
            children: [{
                path: 'list',
                hidden: true,
                meta: {
                    requiresAuth: true,
                    role: ['admin'],
                    permission: 'category.index'
                },
                component: ()=>import('views/admin/category/list'),
                name: '类型列表'
            },{
                path: 'create',
                hidden: true,
                 meta: {
                    requiresAuth: true,
                    role: ['admin'],
                    permission: 'category.store'
                },
                component: ()=>import('views/admin/category/create'),
                name: '创建类型'
            },{
                path:':id/edit',
                hidden: true,
                 meta: {
                    requiresAuth: true,
                    role: ['admin'],
                    permission: 'category.update'
                },
                component: ()=>import('views/admin/category/edit'),
                name: '编辑类型'
            }]
        }, {
            path: '/admin/comment',
            component: AdminLayout,
            name: '评论管理管理',
            noDropdown: true,
            redirect: '/admin/comment/list',
            meta: {
                requiresAuth: true,
                role: ['admin','user'],
                permission: 'comment.index'
            },
            iconname: 'icon-comment',
            children: [{
                path: 'list',
                hidden: true,
                meta: {
                    requiresAuth: true,
                    role: ['admin','user'],
                    permission: 'comment.index'
                },
                component: ()=>import('views/admin/comment/list'),
                name: '评论列表'
            }]
        },{
            path: '/admin/tag',
            component: AdminLayout,
            name: '标签管理',
            noDropdown: true,
            redirect: '/admin/tag/list',
            meta: {
                requiresAuth: true,
                role: ['admin'],
                permission: 'tag.index'
            },
            iconname: 'icon-tag',
            children: [{
                path: 'list',
                hidden: true,
                meta: {
                    requiresAuth: true,
                    role: ['admin'],
                    permission: 'tag.index'
                },
                component: ()=>import('views/admin/tag/list'),
                name: '标签列表'
            },{
                path: 'create',
                hidden: true,
                 meta: {
                    requiresAuth: true,
                    role: ['admin'],
                    permission: 'tag.store'
                },
                component: ()=>import('views/admin/tag/create'),
                name: '创建标签'
            },{
                path:':id/edit',
                hidden: true,
                 meta: {
                    requiresAuth: true,
                    role: ['admin'],
                    permission: 'tag.update'
                },
                component: ()=>import('views/admin/tag/edit'),
                name: '编辑标签'
            }]
        }, {
            path: '/admin/link',
            component: AdminLayout,
            name: '链接管理',
            noDropdown: true,
            redirect: '/admin/link/list',
            meta: {
                requiresAuth: true,
                role: ['admin'],
                permission: 'link.index'
            },
            iconname: 'icon-link',
            children: [{
                path: 'list',
                hidden: true,
                meta: {
                    requiresAuth: true,
                    role: ['admin'],
                    permission: 'link.index'
                },
                component: ()=>import('views/admin/link/list'),
                name: '链接列表'
            },{
                path: 'create',
                hidden: true,
                 meta: {
                    requiresAuth: true,
                    role: ['admin'],
                    permission: 'link.store'
                },
                component: ()=>import('views/admin/link/create'),
                name: '创建标签'
            },{
                path:':id/edit',
                hidden: true,
                 meta: {
                    requiresAuth: true,
                    role: ['admin'],
                    permission: 'link.update'
                },
                component: ()=>import('views/admin/link/edit'),
                name: '编辑链接'
            }]
        },{
            path: '/admin/manage',
            name: '网站管理',
            iconname: 'icon-admin-index',
            // redirect: '/admin/manage/log',
            component: AdminLayout,
            meta:{
                requiresAuth: true,
                role:['admin'],
                permission: 'manage.index'
            },
            children: [{
                path: 'info',
                iconname: 'icon-admin-log',
                meta:{
                    requiresAuth: true,
                    role:['admin'],
                    permission: 'manage.info'
                },
                component: ()=>import('views/admin/system/info'),
                name: '网站配置'
            },{
                path: 'actionlog',
                iconname: 'icon-admin-actionlog',
                meta:{
                    requiresAuth: true,
                    role:['admin'],
                    permission: 'manage.actionlog'
                },
                component: ()=>import('views/admin/system/log'),
                name: '操作日志'
            },{
                path: 'feed',
                iconname: 'icon-message',
                meta:{
                    requiresAuth: true,
                    role: ['admin'],
                    permission: 'manage.feed'
                },
                component: ()=>import('views/admin/system/feed'),
                name: '反馈信息'
            }]
        },{
            path: '/admin/setting',
            name: '系统管理',
            iconname: 'icon-admin-setting',
            redirect: '/admin/setting/users',
            meta:{
                requiresAuth: true,
                role:['admin'],
                permission: 'setting.index'
            },
            component: AdminLayout,
            children: [{
                path: 'users',
                iconname: 'icon-admin-user',
                meta:{
                    requiresAuth: true,
                    role:['admin'],
                    permission: 'users.index'
                },
                component: ()=>import('views/admin/setting/users/list'),
                name: '用户管理'
            },{
                path: 'users/create',
                hidden: true,
                meta:{
                    requiresAuth: true,
                    role:['admin'],
                    permission: 'users.store'
                },
                component: ()=>import('views/admin/setting/users/create'),
                name: '创建用户'
            },{
                path: 'users/:id/edit',
                hidden: true,
                meta:{
                    requiresAuth: true,
                    role:['admin'],
                    permission: 'users.update'
                },
                component: ()=>import('views/admin/setting/users/edit'),
                name: '编辑用户'
            },{
                path: 'uploadimg',
                iconname: 'icon-image',
                meta:{
                    requiresAuth: true,
                    role:['admin'],
                    permission: 'uploadimg.index'
                },
                component: ()=>import('views/admin/setting/uploadimg/list'),
                name: '文章图片管理'
            },{
                path: 'roles',
                component: ()=>import('views/admin/setting/roles/list'),
                iconname: 'icon-admin-role',
                meta:{
                    requiresAuth: true,
                    role:['admin'],
                    permission: 'roles.index'
                },
                name: '角色管理'
            },{
                path: 'roles/create',
                hidden: true,
                meta:{
                    requiresAuth: true,
                    role:['admin'],
                    permission: 'roles.store'
                },
                component: ()=>import('views/admin/setting/roles/create'),
                name: '创建角色'
            },{
                path: 'roles/:id/edit',
                hidden: true,
                meta:{
                    requiresAuth: true,
                    role:['admin'],
                    permission: 'roles.update'
                },
                component: ()=>import('views/admin/setting/roles/edit'),
                name: '编辑角色'
            },{
                path: 'permission',
                component: ()=>import('views/admin/setting/permission/list'),
                iconname: 'icon-admin-permission',
                meta:{
                    requiresAuth: true,
                    role:['admin'],
                    permission: 'permission.index'
                },
                name: '权限管理'
            },{
                path: 'permission/create',
                hidden: true,
                meta:{
                    requiresAuth: true,
                    role:['admin'],
                    permission: 'permission.store'
                },
                component: ()=>import('views/admin/setting/permission/create'),
                name: '创建权限'
            },{
                path: 'permission/:id/edit',
                hidden: true,
                meta:{
                    requiresAuth: true,
                    role:['admin'],
                    permission: 'permission.update'
                },
                component: ()=>import('views/admin/setting/permission/edit'),
                name: '编辑权限'
            }]
        },{
            path: '/admin/events',
            name: '活动管理',
            iconname: 'icon-admin-event',
            component: AdminLayout,
            meta:{
                requiresAuth: true,
                role:['admin','user'],
                permission: 'events.index'
            },
            redirect: '/admin/events/newevent',
            children: [{
                path: 'newevent',
                iconname: 'icon-admin-newevent',
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'newevent.index'
                },
                component: ()=>import('views/admin/events/newevent/list'),
                name: '最新活动'
            },{
                path: 'newevent/create',
                hidden: true,
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'newevent.store'
                },
                component: NewEventCreate,
                name: '创建最新活动'
            },{
                path: 'newevent/:id/edit',
                hidden: true,
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'newevent.update'
                },
                component: ()=>import('views/admin/events/newevent/edit'),
                name: '编辑最新活动'
            },{
                path: 'activeevent',
                iconname: 'icon-admin-activitie-event',
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'activeevent.index'
                },
                component: ()=>import('views/admin/events/activeevent/list'),
                name: '活动盛事'
            },{
                path: 'activeevent/create',
                hidden: true,
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'activeevent.store'
                },
                component: ()=>import('views/admin/events/activeevent/create'),
                name: '创建活动盛事'
            },{
                path: 'activeevent/:id/edit',
                hidden: true,
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'activeevent.update'
                },
                component: ()=>import('views/admin/events/activeevent/edit'),
                name: '编辑活动盛事'
            },{
                path: 'offers',
                iconname: 'icon-admin-offers-activitie',
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'offers.index'
                },
                component: ()=>import('views/admin/events/offers/list'),
                name: '优惠信息'
            },{
                path: 'offers/create',
                hidden: true,
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'offers.store'
                },
                component: ()=>import('views/admin/events/offers/create'),
                name: '创建优惠信息'
            },{
                path: 'offers/:id/edit',
                hidden: true,
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'offers.store'
                },
                component: ()=>import('views/admin/events/offers/edit'),
                name: '编辑优惠信息'
            }
            // ,{
            //     path: 'tour-app',
            //     name: '观光app',
            //     iconname: 'icon-admin-tour-app',
            //     meta:{
            //         requiresAuth: true,
            //         role:['admin','user']
            //     },
            //     component: AA
            // }
            ]
        },{
            path: '/admin/topsyzhongyuan',
            name: '玩转中原',
            component: AdminLayout,
            iconname: 'icon-admin-topsyzhongyuan',
            meta:{
                requiresAuth: true,
                role:['admin','user'],
                permission: 'topsyzhongyuan.index'
            },
            redirect: '/admin/topsyzhongyuan/talent-recommended',
            children: [{
                path: 'talent',
                name: '达人推荐',
                iconname: 'icon-admin-talent-recommended',
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'talent-recommended.index'
                },
                component: ()=>import('views/admin/zhongyuan/talent/list')
            }
            // ,{
            //     path: 'theme-tour',
            //     name: '主题游程',
            //     iconname: 'icon-admin-theme-tour',
            //     meta:{
            //         requiresAuth: true,
            //         role:['admin','user']
            //     },
            //     component: AA
            // }
            // ,{
                // path: 'custom-itinerary',
                // name: '自定行程',
                // iconname: 'icon-admin-custom-itinerary',
                // meta:{
                //     requiresAuth: true,
                //     role:['admin','user']
                // },
                // component: AA
            // }
            ]
        },{
            path: '/admin/tourist-attractions',
            name: '旅游景点',
            component: AdminLayout,
            meta:{
                requiresAuth: true,
                role:['admin','user'],
                permission: 'tourist-attractions.index'
            },
            redirect: '/admin/tourist-attractions/attraction',
            iconname: 'icon-admin-tourist-attractions',
            children: [{
                path: 'attraction',
                name: '主题景点',
                component: ()=>import('views/admin/attraction/list'),
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'attraction.index'
                },
                iconname: 'icon-admin-theme-attractions'
            },{
                path: 'attraction/create',
                name: '创建景点',
                hidden: true,
                component: ()=>import('views/admin/attraction/create'),
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'attraction.store'
                }
            },{
                path: 'attraction/:id/edit',
                name: '编辑景点',
                hidden: true,
                component: ()=>import('views/admin/attraction/edit'),
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'attraction.update'
                }
            }
            // ,{
            //     path: 'attractions-search',
            //     name: '景点搜索',
            //     component: AA,
            //     meta:{
            //         requiresAuth: true,
            //         role:['admin','user']
            //     },
            //     iconname: 'icon-admin-attractions-search'
            // },{
            //     path: 'partition-search',
            //     name: '按区搜索',
            //     component: AA,
            //     meta:{
            //         requiresAuth: true,
            //         role:['admin','user']
            //     },
            //     iconname: 'icon-admin-partition-search'
            // },{
            //     path: 'top10',
            //     name: 'TOP10',
            //     component: AA,
            //     meta:{
            //         requiresAuth: true,
            //         role:['admin','user']
            //     },
            //     iconname: 'icon-admin-top10'
            // }
            ]
        },{
            path: '/admin/goods',
            component: AdminLayout,
            iconname: 'icon-admin-home-specialties',
            meta:{
                requiresAuth: true,
                role:['admin','user'],
                permission: 'goods.index'
            },
            redirect: '/admin/goods/list',
            name: '特产商品管理',
            children: [{
                path: 'list',
                component: AA,
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'goods.index'
                },
                iconname: 'icon-admin-theme-specialtie',
                name: '特产列表'
            },{
                path: 'category',
                component: AA,
                name: '特产分类',
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'goods.category.index'
                },
                iconname: 'icon-admin-theme-specialtie-search'
            },{
                path: 'tag',
                component: AA,
                name: '特产标签',
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'goods.tag.index'
                },
                iconname: 'icon-admin-season-specialtie'
            },{
                path: 'spec',
                component: AA,
                name: '特产规格',
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'goods.spec.index'
                },
                iconname: 'icon-admin-season-specialtie-search'
            },{
                path: 'attribute',
                component: AA,
                name: '特产属性',
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'goods.attribute.index'
                },
                iconname: 'icon-admin-season-specialtie-search'
            },{
                path: 'model',
                component: AA,
                name: '特产模型',
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'goods.model.index'
                },
                iconname: 'icon-admin-season-specialtie-search'
            }]
        },{
            path: '/admin/hotel',
            component: AdminLayout,
            iconname: 'icon-admin-hotel',
            name: '旅馆住宿',
            meta:{
                requiresAuth: true,
                role:['admin','user'],
                permission: 'hotel.index'
            },
            redirect: '/admin/hotel/lodging-cargory',
            children: [{
                path: 'lodging-cargory',
                component: AA,
                name: '住宿类别',
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'lodging-cargory.index'
                },
                iconname: 'icon-admin-lodging-cargory'
            },{
                path: 'lodging-search',
                component: AA,
                name: '住宿搜索',
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'lodging-search.index'
                },
                iconname: 'icon-admin-lodging-search'
            },{
                path: 'lodging-notice',
                component: AA,
                name: '住宿须知',
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'lodging-notice.index'
                },
                iconname: 'icon-admin-lodging-notice'
            },{
                path: 'room-price',
                component: AA,
                name: '房间价格',
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'room-price.index'
                },
                iconname: 'icon-admin-room-price'
            }]
        },{
            path: '/admin/video-jobs',
            component: AdminLayout,
            name: '影像资料',
            iconname: 'icon-admin-video-jobs',
            meta:{
                requiresAuth: true,
                role:['admin','user'],
                permission: 'video-jobs.index'
            },
            redirect: '/admin/video-jobs/hot-video',
            children: [{
                path: 'hot-video',
                component: AA,
                name: '热门视频',
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'hot-video.index'
                },
                iconname: 'icon-admin-hot-video'
            },{
                path: 'hot-image',
                component: AA,
                name: '照片欣赏',
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'hot-image.index'
                },
                iconname: 'icon-admin-hot-image'
            },{
                path: 'hot-scener',
                component: AA,
                name: '风景欣赏',
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'hot-scener.index'
                },
                iconname: 'icon-admin-hot-scener'
            },{
                path: 'history-memory',
                component: AA,
                name: '历史记忆',
                meta:{
                    requiresAuth: true,
                    role:['admin','user'],
                    permission: 'history-memory.index'
                },
                iconname: 'icon-admin-history-memory'
            }]
        }
    ]
});
router.beforeEach(beforeEach);
router.afterEach( (to) =>{
    store.commit('UPDATE_LOADING_STATUS', {isLoading: false})
});
export default router;