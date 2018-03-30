<template>
    <div class="header-wrapper" id="header-wrapper"> 
      <div class="header"> 
        <h1 class="main-logo">
          <router-link :to="'/'" class="link" title="万家山庄">万家山庄</router-link>
        </h1> 
      <div class="member-func-wrapper">
        <div v-if="isLogged" class="btn-member" @click="toggle"> 
          <div class="member-func-blk" id="member-func-blk" v-bind:class="{'is-open':userToggle}">
            <button class="btn-close-circle" id="btn-close-member-func" title="關閉">關閉</button>
            <ul class="member-func-list">
              <li class="item" v-if="getRoles[0] ==='admin' || getRoles[0] ==='user'">
                <router-link class="link" :to="'/admin'">
                  <img src="/images/svg/member-01.svg" class="thumb lazy">
                  <strong class="title">{{currentUser.name}}</strong>
                   <strong class="title">管理员</strong> 
                </router-link>
              </li>
              <li v-else class="item">
                <router-link class="link" to="/me">
                  <img src="/images/svg/member-01.svg" class="thumb lazy">
                  <strong class="title">{{currentUser.name}}</strong>
                </router-link>
              </li>
              <li class="item">
                <router-link class="link" to="/service" title="服务条款">
                  <img src="/images/svg/member-01.svg" alt="服务条款"  class="thumb lazy">
                  <strong class="title">服务条款</strong>
                </router-link>
              </li>
              <li class="item">
                <a class="link" href="/zh-cn/member/collection" title="我的收藏">
                  <img src="/images/svg/member-02.svg" alt="我的收藏" data-src="/Content/images/content/submenu/member-02.svg" class="thumb lazy">
                  <strong class="title">我的收藏</strong>
                </a> 
              </li>
              <li class="item">
                <a class="link" href="/zh-cn/member/change-password" title="变更密码">
                  <img src="/images/svg/member-05.svg" alt="变更密码" data-src="/Content/images/content/submenu/member-05.svg" class="thumb lazy">
                  <strong class="title">变更密码</strong>
                </a>
              </li>
              <li class="item">
                <router-link class="link" to="/me/create" title="article" >
                  <img src="/images/svg/Fun-02.svg" alt="登入"  class="thumb lazyloaded">
                  <strong class="title">创建文章</strong>
                </router-link>
              </li>
              <li class="item">
                <a class="link" href="javascript:void(0)" title="登出" @click="logout">
                  <img src="/images/svg/member-08.svg" alt="登出" data-src="/Content/images/content/submenu/member-06.svg" class="thumb lazy">
                  <strong class="title">登出</strong>
                </a>
              </li>
            </ul>
            <div class="member-func-close-mask" id="member-func-close-mask"></div>
          </div>
        </div>
        <router-link :to="'/login'" title="登入 " class="btn-member" v-else >登入</router-link>
      </div> 
      <!-- <a class="btn-diamond" href="/zh-cn/member/collection" data-nums="0" title="收藏" id="btn-my-collection">收藏</a>  -->
      <div class="main-nav-wrapper" id="main-nav-wrapper" v-bind:class="{'is-open':getIsOpen}">
        <button class="btn-open-menu" id="btn-open-menu" @click="SidebarToggle">
          <span class="line"></span>
          <span class="title">菜单</span> </button>
          <transition name="slide-fade">
            <nav class="main-nav" id="main-nav">
              <ul class="main-nav-title-list " id="main-nav-title-list" :class="!show?'current-lv':''">
                <li class="item" v-for="(item,index) in Menu" :key="index" :class=" 'sub-' + (index+1)" @click="toggleSubMenu(index,item.name)"> 
                  <a class="menu-title has-more" href="javascript:void(0)" :title="item.name"> 
                    <img :src="item.img" :alt="item.name"  class="thumb lazyloaded"> 
                    <strong class="title">{{item.name}}</strong>
                  </a>
                  <ul class="nav-sub-list">
                    <li class="item" v-for="(i,key) in item.menuSub" :key="key">
                      <router-link class="menu-title" :to="i.url" :title="i.name">
                        <img :src="i.img" :alt="i.name"  class="thumb lazyloaded">
                        <strong class="title">{{i.name}}</strong>
                      </router-link>
                    </li>
                  </ul>
                </li>
                <li class="item desktop-adj" v-show="currentUser.name">
                  <router-link class="menu-title" to="/me/notification" title="通知" :class="currentUser.unread_count === 0 ? '' : 'ac-not' ">
                    <i class="icon-notification"><span class="new"></span></i>
                    <!-- <img src="/images/svg/icon-main-search.svg" alt="" data-src="images/svg/icon-main-search.svg" class="thumb lazyloaded"> -->
                    <strong class="title"><span class="adj">通知</span>通知</strong>
                  </router-link>
                </li>
              </ul>
              <div class="site-func-blk" id="site-func-blk">
                <ul class="social-link-list" style="float:right;">
                  <li class="item">
                    <a href="http://open.weixin.com" class="btn-fb-fans" target="_blank" title="万家山庄">万</a>
                  </li>
                  <li class="item">
                    <a href="https://weibo.com/u/5530559065?refer_flag=1001030102"_ class="btn-weibo-fans" target="_blank" title="万家山庄微博">微博</a>
                  </li>
                </ul>
                <!-- <a href="/zh-cn/sitemap" class="common-link show-at-desktop" title="网站导览">网站导览</a> -->
                <!-- <div class="lang-link-drop-blk">
                  <span class="lang-hint">Language</span>
                  <ul class="lang-link-list">
                    <li class="item"> <a href="/zh-tw" class="link">中文版</a> </li>
                    <li class="item"> <a href="/en" class="link">English</a> </li>
                    <li class="item"> <a href="/ja" class="link">日本語</a> </li>
                    <li class="item"> <a href="/ko" class="link">한국어</a> </li>
                    <li class="item"> <a href="/es" class="link">Español</a> </li>
                    <li class="item"> <a href="/id" class="link">Bahasa Indonesia</a> </li>
                  </ul>
                </div> -->
              </div>
            </nav>
          </transition>
          <transition name="slide-fade">
            <div id="mobile-sublist-wrapper">
              <nav id="menu-breadcrumb" class="menu-breadcrumb" :class="show?'show':'' " @click="backMenu">
                <button id="btn-back-all" title="全部" class="btn-back-all">全部</button>
                <span id="current-unit-name" class="current">{{name}}</span>
              </nav>
              <ul class="nav-sub-list" v-for="(item,index) in Menu" :key="index" :class="(index===menuIndex)?'current-lv':''">
                <li class="item" v-for="(i,key) in item.menuSub" :key="key">
                  <router-link class="menu-title" :to="i.url" :title="i.name">
                    <img :src="i.img" :alt="i.name"  class="thumb lazyloaded">
                    <strong class="title">{{i.name}}</strong>
                  </router-link>
                </li>
              </ul>
            </div>
          </transition>
          <div class="mobile-nav-close-mask" id="mobile-nav-close-mask" @click="SidebarToggle"></div>
        </div>
      </div>
    </div>
</template>
<script>
import {mapActions,mapGetters} from 'vuex';
import {Menu} from 'utils/mock';
export default{
  name:'navbar',
  data(){
    return{
      userToggle:false,
      Menu: Menu,
      show: false,
      menuIndex:null,
      name: ''
    }
  },
  computed:{
    ...mapGetters([
      'getIsOpen',
      'isLogged',
      'currentUser',
      'getRoles'
    ])
  },
  watch: {
    isLogged(value){
      if(value === false){
        this.$router.push({path:'/login'})
      }
    }
  },
  methods: {
    ...mapActions([
      'SidebarToggle',
      'logout'
    ]),
    toggleSubMenu(index,name){
      this.show = true;
      this.menuIndex = index;
      this.name = name;
    },
    toggle(){
      this.userToggle = !this.userToggle;
    },
    backMenu(){
      this.show = false;
      this.menuIndex = null;
    }
  }
};
</script>
<style scope lang="scss">
.slide-fade-enter-active {
  transition: all .3s ease;
}
.slide-fade-leave-active {
  transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active for below version 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}
</style>