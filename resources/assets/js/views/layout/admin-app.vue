<template>
  <div class="app-wrapper">
      <admin-header ></admin-header>
      <section class="main" v-bind:class="{'is-open':getIsOpen}">
        <sidebar></sidebar>
        <admin-main></admin-main>
      </section>
  </div>
</template>
<script>
// 头部
import AdminHeader from 'components/layout/admin/header';
// 侧边栏
import Sidebar from 'components/layout/admin/sidebar';
// 主体内容
import AdminMain from 'components/layout/admin/admin-main';
// 遍历路由到sidebar
import router from 'router/index';
// 过滤路由权限
import permission from 'store/permission';
import store from 'store/store';
import {mapGetters} from 'vuex';
export default {
  name: 'adminapp',
  components:{
    Sidebar,
    AdminMain,
    AdminHeader
  },
  beforeRouteEnter:(to, from, next) => {
    const roles = store.getters.getRoles;
    permission.init({
      roles:roles,
      router:router.options.routes
    });
    next();
  },
  computed: {
    ...mapGetters([
      'getIsOpen'
    ])
  }
}
</script>
