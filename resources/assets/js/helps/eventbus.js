// 全局可用 $emit 刷新
import Vue from 'vue';
const bug = new Vue();
// 安装vue 插件
export default function install(Vue) {
  Object.defineProperties(Vue.prototype, {
    $bus: {
      get() {
        return bus
      },
    },
  });
}