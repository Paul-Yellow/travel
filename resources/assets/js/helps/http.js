import axios from 'axios';
import interceptors from './interceptors';
import {API_URL} from 'config/index';
// api 地址
export const http = axios.create({
    baseURL: API_URL
});
// 默认请求头
http.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};
//设置 token api 请求头
export function setToken(token) {
  http.defaults.headers.common.Authorization = `Bearer ${token}`;
};
// 安装Vue 插件 以便全局可用 $http ajax
export default function install (Vue,{store})
{
    interceptors(http,store);
    Object.defineProperty(Vue.prototype,'$http',{
        get() {
            return http
        }
    });
}