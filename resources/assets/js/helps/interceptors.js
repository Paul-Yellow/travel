// 响应拦截
import {isArray} from 'lodash';
export default (http,store)=>{
    http.interceptors.request.use((config) => {
        return config;
    },(error) =>{
        return Promise.reject(error);
    });
    http.interceptors.response.use(
        // 返回请求数据
        response => {
            if(response.data.responData){
                if(response.data.responData.status !== 200 && response.data.responData.status === 500 && response.data.responData.messages !== ''){
                    store.dispatch('setMessage',{type:'error',message:response.data.responData.messages});
                    store.dispatch('setFecting', { fetching: false })
                }
            }
             return response
        },
        (error)=>{
            const {response} = error;
            if([401,400,403].indexOf(response.status) > -1)
            {
                //        store.dispatch('setMessage',{message: response.data.messages})
                store.dispatch('setMessage',{type:'error',message:response.data.messages})
                .then(()=>{
                    setTimeout(()=>{
                            store.dispatch('logout');
                    },100);
                });
            }
            if([500].indexOf(response.status)){
                store.dispatch('setMessage',{type:'error',message:'服务器错误!!!'});
            }
            // 如果响应的数据是数组，显示错误数据
            if(isArray(response.data))
            {
                store.dispatch('setMessage',{type:'error',message:response.data.messages});
                // store.dispatch('setMessage',{message: response.data.messages});
                // store.dispatch('logout');
            }else
            {
                store.dispatch('setMessage',{type:'error',message:response.data.messages});
                // store.dispatch('setMessage',{message: response.data.messages});
                // store.dispatch('logout');
            }
            // 不获取
            store.dispatch('setFecting',{fetch:false});
            return Promise.reject(error);
        }
    );
};