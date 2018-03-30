import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);
import admin from './home/export/admin';
// 验证
import auth from './home/export/auth';
let store = new Vuex.Store({
    modules: {
        admin,
        auth
    }
});
export default store;