
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('src/bootstrap');
import ElementUi from 'element-ui';
// import 'element-ui/lib/theme-default/index.css';
import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/zh-CN';
import {sync} from 'vuex-router-sync';
import VueAMap from 'vue-amap';
import Vue from 'vue';
// vue 路由
import VueRouter from 'vue-router';
// 路由配置
import router from 'router/index';
// 数据源
import store from 'store/store';
// http插件
import httpPlugin from 'helps/http';
import eventBus from 'helps/eventbus';
import Home from 'src/home.vue';
// 错误日志
import errLog from 'store/errLog';
// 注册全局权限指令控制按钮权限
import Permission from './directive/permission';
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.use(ElementUi,{locale});
Vue.use(VueRouter);
Vue.use(httpPlugin,{store});
Vue.use(eventBus);
Vue.use(Permission);
// 高德地图
Vue.use(VueAMap);
VueAMap.initAMapApiLoader({
  key: '7f165fd3cd5df7c93b43a4669013a479',
  plugin: ['AMap.Autocomplete', 'AMap.PlaceSearch', 'AMap.Scale', 'AMap.OverView', 'AMap.ToolBar', 'AMap.MapType', 'AMap.PolyEditor', 'AMap.CircleEditor']
})
if (process.env === 'production') {
  Vue.config.errorHandler = function(err, vm) {
    errLog.pushLog({
      err,
      url: window.location.href,
      vm
    })
  };
}
sync(store,router)
new Vue({
    store,
    router,
    render: h=>h(Home)
}).$mount('#app');
