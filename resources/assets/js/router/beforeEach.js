import store from 'store/store';
import {USER_TOKEN} from 'config/index';
import {isEmpty} from 'lodash';
// 检查路由是否需要验证
const needAuth = auth=>auth===true;
function hasPermission(roles) {
  if (roles.indexOf('admin') >= 0){ return true;}else{return false;} // admin角色 直接通过
}
function hasPermissionUser(permissionData,permission){
    if(permissionData.indexOf(permission) >= 0){
        return true;
    }else{
        return false;
    }
}
const beforeEach = (to,from,next)=>{
    store.commit('UPDATE_LOADING_STATUS', {isLoading: true})
    const auth = to.meta.requiresAuth;
    let token = JSON.parse(localStorage.getItem(USER_TOKEN));
    // if(store.getters.isLogged){
    //     if(to.path === '/login'){
    //         next({path: '/me'});
    //     }else{
    //         store.dispatch('setToken',token).then(()=>{
    //             // 判断路由拦截那里toke 过期发生错误之后不获取数据;
    //             if(store.getters.fetch)
    //             {
    //                 store.dispatch('loadUser').then((res)=>{
    //                     setTimeout(()=>{
    //                         // console.log(store.getters.getPermission);
    //                         // console.log(to);
    //                         // console.log(from);
    //                         if (to.meta) {
    //                             if(hasPermission(store.getters.getRoles)){
    //                                 next();
    //                                 // return;
    //                             }else if(hasPermissionUser(store.getters.getPermission,to.meta.permission)){
    //                                 next();
    //                                 // return;
    //                             }else{
    //                                 next({path:'/401'});
    //                                 // return;
    //                             }
    //                         }
    //                     },500);
    //                 }).catch(err=>{
    //                     next({path: '/'});
    //                     return;
    //                 });
    //             }else{
    //                 next({path: '/'});
    //             }       
    //         });
    //     }
    // }else{
    //     if(!needAuth(auth)){
    //         next();
    //         return;
    //     }else{
    //         next({path:'/login'});
    //     }
    // }
        if(!needAuth(auth)){
            next();
            return;
        }else{
            if(store.getters.isLogged){
                if(to.path === '/login'){
                    next({path: '/me'});
                }else{
                    store.dispatch('setToken',token).then(()=>{
                        // 判断路由拦截那里toke 过期发生错误之后不获取数据;
                        if(store.getters.fetch)
                        {
                            // 从后台获取权限跟角色数据  如果是admin 角色直接放行;如果是普通用户或者普通管理员则判断权限;
                            store.dispatch('loadUser').then((res)=>{
                                setTimeout(()=>{
                                    // if (to.meta) {
                                        if(hasPermission(store.getters.getRoles)){
                                            next();
                                            // return;
                                        }else if(hasPermissionUser(store.getters.getPermission,to.meta.permission)){
                                            next();
                                            // return;
                                        }else{
                                            next({path:'/401'});
                                            // return;
                                        }
                                    // }
                                },500);
                            }).catch(err=>{
                                next({path:'/401'});
                                return;
                            });
                        }else{
                            next({path:'/401'});
                        }       
                    });
                }
            }
        }
};

export default beforeEach;