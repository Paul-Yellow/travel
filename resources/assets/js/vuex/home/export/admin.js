import * as actions from 'store/home/actions/admin';
import * as getters from 'store/home/getters/admin';
import mutations from 'store/home/mutations/admin';
const state = {
    isopen: false,
    getUploadImg: ''
};
export default{
    state,
    getters,
    actions,
    mutations
};