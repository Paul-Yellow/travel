import * as types from 'store/types';
const mutations = {
    [types.SET_TOKEN](state,value){
        state.token = value;
    },
    [types.SET_USER](state,value){
        state.user = value;
    },
    [types.SET_FETCH](state,obj){
        state.fetch = obj;
    },
    [types.SET_MESSAGE](state,obj){
        state.message[obj.type] = obj.message;
    },
    [types.SET_ROLES](state,value){
        state.roles = value;
    },
    [types.SET_PERMISSION](state,value){
        state.permission = value;
    },
    [types.MARK_NOTIFICATION_AS_READ](state) {
        state.user.unread_count = 0;
      },
    [types.MARK_ONE_NOTIFICATION_AS_READ](state) {
        state.user.unread_count --;
    },
    [types.UPDATE_LOADING_STATUS](state,value){
        state.loadingStatus = value.isLoading;
    }
};
export default mutations;