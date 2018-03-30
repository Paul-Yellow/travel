<template>
   <div class="content-right-blk show-at-desktop">
      <div class="right-nav-blk yellow">
        <ul class="right-nav-list">
          <li class="item ">
            <router-link class="link" to="/service" title="服务条款">
              <img src="/images/svg/member-01.svg" alt="服务条款"  class="thumb lazyloaded">
              <strong class="title">服务条款</strong>
            </router-link>
          </li>
          <li class="item ">
            <a class="link" href="/zh-cn/member/collection" title="我的收藏">
              <img src="/images/svg/member-02.svg" alt="我的收藏"  class="thumb lazyloaded">
              <strong class="title">我的收藏</strong>
            </a>
          </li>
          <li class="item ">
            <a class="link" href="/zh-cn/member/forgot" title="忘记密码">
              <img src="/images/svg/member-05.svg" alt="忘记密码"  class="thumb lazyloaded">
              <strong class="title">忘记密码</strong>
            </a>
          </li>
          <li class="item" v-if="isLogged">
            <router-link class="link" to="/me/create" title="article" >
              <img src="/images/svg/Fun-02.svg" alt="登入"  class="thumb lazyloaded">
              <strong class="title">创建文章</strong>
            </router-link>
          </li>
          <li class="item act" v-if="isLogged">
            <a class="link" href="javascript:void(0);" title="登出" @click="logout">
              <img src="/images/svg/member-08.svg" alt="登入"  class="thumb lazyloaded">
              <strong class="title">登出</strong>
            </a>
          </li>
          <li class="item act" v-if="!isLogged">
            <router-link class="link"  title="登入" :to="'/login'">
              <img src="/images/svg/member-08.svg" alt="登入"  class="thumb lazyloaded">
              <strong class="title">登入</strong>
            </router-link>
          </li>
        </ul>
      </div>
    </div>
</template>
<script>
import {mapGetters,mapActions} from 'vuex';
export default {
  name: 'sidebar',
  methods:{
    ...mapActions([
      'logout'
    ])
  },
  computed:{
    ...mapGetters([
      'isLogged'
    ])
  }
}
</script>
