import * as types from 'store/types';
const mutations = {
    [types.ADMIN_TOGGLE](state){
        state.isopen = !state.isopen;
    },
    [types.GET_UPLOAD_IMG](state,payload){
        state.getUploadImg = payload
    }
};
export default mutations;