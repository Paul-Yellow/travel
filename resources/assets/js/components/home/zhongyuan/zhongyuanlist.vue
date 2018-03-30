<template>
<div>
  <div class="unit-title-blk bg-slash">
      <Breadcrumb class="breadcrumb"></Breadcrumb>
    <h2 class="unit-title icon-unit-play">认识中原</h2>
  </div>
  <div class="page-content-wrapper">
    <ul class="event-news-card-list">
      <li class="item">
        <div class="icon-card-item bg-slash-blue region">
          <router-link to="/zhongyuan/list/overview" class="link" target="_self"  title="中原概述">
            <span class="thumb-frame">
              <img src="/images/fun/taipei-01.svg" alt="中原概述" data-src="/images/fun/taipei-01.svg" class="thumb lazyloaded">
            </span>
            <div class="info-blk vam-blk">
              <h3 class="info-title vam"><span class="ellipsis">中原概述</span></h3>
            </div>
          </router-link>
        </div>
      </li>
      <li class="item">
        <div class="icon-card-item bg-slash-blue region">
          <router-link to="/zhongyuan/list/arts" class="link" target="_self" title="人文艺术">
            <span class="thumb-frame">
              <img src="/images/fun/taipei-03.svg" alt="人文艺术" data-src="/images/fun/taipei-03.svg" class="thumb lazyloaded">
            </span>
            <div class="info-blk vam-blk">
              <h3 class="info-title vam">
                <span class="ellipsis">人文艺术</span>
              </h3>
            </div>
          </router-link>
        </div>
      </li>
      <li class="item">
        <div class="icon-card-item bg-slash-blue region">
          <router-link to="/zhongyuan/list/exploring" class="link" target="_self" title="户外探索">
            <span class="thumb-frame">
              <img src="/images/fun/taipei-04.svg" alt="户外探索" data-src="/images/fun/taipei-04.svg" class="thumb lazyloaded">  
            </span>
            <div class="info-blk vam-blk">
              <h3 class="info-title vam"><span class="ellipsis">户外探索</span></h3>
            </div>
          </router-link>
        </div>
      </li>
    </ul>
  </div>
</div>
</template>
<script>
import Breadcrumb from 'components/layout/breadcrumb';
export default {
  name: 'zhongyuanlist',
  components:{
    Breadcrumb
  }
}
</script>
