import * as actions from 'store/home/actions/auth';
import * as getters from 'store/home/getters/auth';
import mutations from 'store/home/mutations/auth';
import {USER_TOKEN} from 'config/index';
const state = {
    user: {},
    token: localStorage.getItem(USER_TOKEN),
    fetch: true,
    loadingStatus: false,
    message:{
        success: '',
        error: '',
        warning: '',
        validation:''
    },
    roles: [],
    permission: []
};
export default {
    state,
    getters,
    actions,
    mutations
};