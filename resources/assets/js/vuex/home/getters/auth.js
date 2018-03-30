import {isEmpty} from 'lodash';
// 获取token 数据。并且不能为空
export const isLogged = ({token}) => !isEmpty(token);
// 获取用户数据
export const currentUser = ({user}) => user;
// getroles
export const getRoles = state=>state.roles;
// getPermission
export const getPermission = state=>state.permission;
// is fetch
export const fetch = state => state.fetch;