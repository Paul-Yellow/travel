<template>
  <header id="navbar" v-bind:class="{'is-open':getIsOpen}">
    <div id="navbar-container">
      <div class="navbar-header">
          <router-link  to="/" class="navbar-brand">
            <img src="/images/logo.png" alt="农家乐后台" class="brand-icon">
            <div class="brand-title">
              <span class="brand-text">农家乐管理后台</span>
            </div>
          </router-link>
      </div>
      <div class="navbar-content">
        <ul  class="ul-menu">
          <li class="toggle">
            <button class="btn-toggle" @click="toggle"><i class="icon-toggle"></i></button>
          </li>
        </ul>
        <el-menu  :default-active="activeIndex" theme="dark" class="ul-menu1" mode="horizontal" @select="handleSelect" >
          <el-submenu index="2">
            <template slot="title">{{currentUser.name}}</template>
            <el-menu-item  index="/me">我的个人资料</el-menu-item>
            <el-menu-item  index="/admin/setting">设置</el-menu-item>
            <el-menu-item  index="logout">退出登入</el-menu-item>
          </el-submenu>
        </el-menu>
        <div class="clear"></div>
      </div>
    </div>                    
  </header>
</template>
<script>
import {mapActions,mapGetters} from 'vuex';
export default {
  name: 'adminheader',
  data () {
    return {
      activeIndex: '1'
    };
  },
  watch:{
    isLogged(value){
      if(value ===false){
        this.$router.push({path:'/login'});
      }
    }
  },
  methods: {
    handleSelect(name) {
      switch(name){
        case 'logout':
          this.logout();
          break;
        default:
          this.$router.push({path:name});
          break;
      }
    },
    toggle () {
      this.SidebarToggle();
    },
    ...mapActions([
      'SidebarToggle',
      'logout'
    ])
  },
  computed: {
    ...mapGetters([
      'getIsOpen',
      'currentUser',
      'isLogged'
    ])
  }
}
</script>
<style lang="scss">
#navbar .navbar-brand{
  display: flex;
  flex-direction: row;
  -webkit-flex-direction: row;
  -moz-flex-direction: row;
  flex-wrap: nowrap;
  -webkit-flex-wrap: nowrap;
  -moz-flex-wrap: nowrap;
  justify-content: flex-start;
  -moz-justify-content: flex-start;
  -webkit-justify-content: flex-start;
}
#navbar .el-menu--horizontal .el-submenu>.el-menu{
  // right: 0px !important;
  left: -100%;
}
</style>

