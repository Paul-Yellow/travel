import {http as fetch} from '../helps/http';

export function getToken() {
  return fetch({
    url: '/qiniu/upload/token', // 假地址 自行替换
    method: 'get'
  });
}
export function upload() {
  return fetch({
    url: '/qiniu/upload/token', // 假地址 自行替换
    method: 'get'
  });
}