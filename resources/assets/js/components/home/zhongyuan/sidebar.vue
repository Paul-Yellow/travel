<template>
  <div class="content-right-blk">
    <div class="right-nav-blk yellow">
      <ul class="right-nav-list">
        <li class="item">
          <router-link class="link" to="/zhongyuan/list/overview" title="中原概述">
            <img src="/images/fun/taipei-01.svg" alt="中原概述" data-src="/images/fun/taipei-01.svg" class="thumb lazyloaded">
            <strong class="title">中原概述</strong>
          </router-link>
        </li>
        <li class="item ">
          <router-link class="link" to="/zhongyuan/list/arts" title="人文艺术">
            <img src="/images/fun/taipei-03.svg" alt="人文艺术" data-src="/images/fun/taipei-03.svg" class="thumb lazyloaded">
            <strong class="title">人文艺术</strong>
          </router-link>
        </li>
        <li class="item ">
          <router-link class="link" to="/zhongyuan/list/exploring" title="户外探索">
            <img src="/images/fun/taipei-04.svg" alt="户外探索" data-src="/images/fun/taipei-04.svg" class="thumb lazyloaded">
            <strong class="title">户外探索</strong>
          </router-link>
        </li>
      </ul>
    </div>
    <div class="right-side-info-blk" v-show="hot">
      <h3 class="title">热门新闻</h3>
        <ul class="hot-info-list">
          <li class="item small-info-card-item">
            <a href="/zh-cn/news/details/9803" class="link" title="欢迎全台各地小朋友~">
              <span class="thumb-frame">
                <img src="/image/59241/50x50" data-src="/image/59241/50x50" alt="欢迎全台各地小朋友" class="thumb lazyloaded">
              </span>
              <div class="info-blk vam-blk">
                <h3 class="info-title vam">
                  <span class="ellipsis"> 欢迎全台各地小朋友 </span>
                </h3>
                <span class="icon-view">9.3万</span>
              </div>
            </a>
          </li>
        </ul>
        <a href="/zh-cn/activity" class="btn-more">更多</a>
      </div>
    </div>
</template>
<script>
export default {
  name: 'sidebar',
  data(){
    return{
      hot:false
    }
  }
}
</script>
