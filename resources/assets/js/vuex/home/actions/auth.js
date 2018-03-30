import {http,setToken as httpToken} from 'helps/http';
import { isEmpty } from 'lodash';
import router from 'router/index';
import {USER_TOKEN} from 'config/index';
import * as types from 'store/types';
export const attempLogin = ({dispatch},{iphone,password}) => {
    new Promise((resolve,reject)=>{
        http.post('/auth/login',{iphone,password})
        .then((res)=>{
            const data = res.data;
            dispatch('setToken',data.token);
            dispatch('setUser',data.user.data);
			dispatch('setMessage',{type:'success',message:'登入成功'});
            router.push({path:'/me'});
            resolve();
        }).catch(err=>{
          reject(err);
        });
    })
};
// 注册用户
export const register = ({dispatch},user)=>{
    new Promise((resolve,reject)=>{
        http.post('/auth/register',user)
        .then((res)=>{
            if(res.status === 200 && res.data.token){
                const data = res.data;
                dispatch('setToken',data.token);
                dispatch('setUser',data.user.data);
                dispatch('setMessage',{type:'success',message:'注册成功'});
                router.push({path:'/admin'});
                resolve();
            }
        }).catch(err=>{
		  reject(err);
        });
    });
    
};
export const setToken = ({commit},payload)=>{
    const token = (isEmpty(payload)? null:payload);
    commit(types.SET_TOKEN,token);
    localStorage.setItem(USER_TOKEN,JSON.stringify(token));
    httpToken(token);
    return Promise.resolve(token);
};
// 注销登入
export const logout = ({dispatch})=>{
    http.get('/admin/auth/logout')
       .then((res)=>{
        dispatch('setMessage',{type:'success',message:'注销成功'});
           return Promise.resolve()
       });
    return Promise.all([
        dispatch('setToken',null),
        localStorage.removeItem(USER_TOKEN),
        dispatch('setUser',{}),
        dispatch('setPermission',[]),
        dispatch('setRoles',[])
    ]);
};
// 设置消息
export const setMessage = ({commit},obj)=>{
    commit(types.SET_MESSAGE,obj);
    return Promise.resolve(obj);
};
// 清空消息
export const resetMessage = ({commit})=>{
    commit(types.SET_MESSAGE,{type:'success',message:''})
    commit(types.SET_MESSAGE,{type:'error',message:[]})
    commit(types.SET_MESSAGE,{type: 'warning',message: ''})
    commit(types.SET_MESSAGE,{type:'validation',message:''})
}
// 设置取数据
export const setFecting = ({commit},obj)=>{
    commit(types.SET_FETCH,obj);
    return Promise.resolve(obj);
};
// 设置权限
export const setPermission = ({commit},permission)=>{
    commit(types.SET_PERMISSION,permission);
    return Promise.resolve(permission);
};
// 设置用户信息
export const setUser = ({commit},user)=>{
    commit(types.SET_USER,user);
    return Promise.resolve(user);
};
// 设置角色
export const setRoles = ({commit},roles)=>{
    commit(types.SET_ROLES,roles);
    return Promise.resolve(roles);
};
// 加载用户信息 这些信息不能设置为缓存 为了信息安全; 
export const loadUser = ({dispatch,state})=>{
    new Promise((resolve,reject)=>{
        if(!isEmpty(state.token))
        {
            http.get('/admin/me')
                .then((res)=>{
                    const data = res.data.responData;
                    dispatch('setRoles',data.roles);
                    dispatch('setPermission',data.permission);
                    dispatch('setUser',data.user.data);
                    return resolve(data);
                }).catch(err=>{
                    dispatch('setMessage',{type:'error',message:'token过期或者没有权限'});
                    return reject(err);
            });
        }else{   
            dispatch('setMessage',{type:'error',message:'没有token'});
            return reject('没有token');
        }
    });           
};
// 读取一次站内通知
export const redOneNot = ({commit})=>{
    commit(types.MARK_ONE_NOTIFICATION_AS_READ);
};
// 读取所有站内通知
export const redAllNot = ({commit})=>{
    commit(types.MARK_NOTIFICATION_AS_READ);
};
