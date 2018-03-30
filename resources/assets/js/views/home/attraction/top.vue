<template>
  <div>
    <div class="unit-title-blk bg-slash">
      <Breadcrumb class="breadcrumb"></Breadcrumb>
      <h2 class="unit-title icon-unit-attraction">{{$route.name}}</h2>
    </div>
    <div class="page-content-wrapper">
      <div class="tripadvisor-top10-header">
        <div class="banner">
          <p class="asia-rankings">国家4A级景区</p>
          <div class="title">
            <p class="main-name">中源旅游</p>
            <p class="prize">靖安县是国家4a级景区</p>
          </div><span class="thumb-frame">
            <img src="/images/footer.jpg" class="thumb lazyloaded" alt="国家4a级景区"></span>
          </div>
          <p class="statement">免責聲明：這些評論是旅行者個人的主觀評論，並不代表网站意见。</p>
        </div>
        <div class="tripadvisor-top10-list">
          <div class="list-title">中源 TOP 10</div>
          <ul class="tripadvisor-top10-card-list">
            <li class="item" v-for="item in list" :key="item.id">
              <div class="tripadvisor-top10-card">
                <router-link :to="item.url" class="link" target="_blank" :title="item.name">
                  <div class="info-blk">
                    <p class="rankings-ten">{{item.id}}</p>
                    <h3 class="info-title">{{item.name}}</h3>
                  </div>
                  <span class="thumb-frame">
                    <img :src="item.img" :alt="item.name" class="thumb lazyloaded">
                  </span>
                </router-link>
              </div>
            </li>
          </ul>
        </div>
    </div>
  </div>
</template>
<script>
import Breadcrumb from 'components/layout/breadcrumb';
import {topMock} from 'utils/mock';
export default {
  name: 'top_attraction',
  data(){
    return{
      list: topMock
    }
  },
  components:{
    Breadcrumb
  }
}
</script>
<style lang="scss" scoped>
  .page-content-wrapper {
    width: 100%;
      padding: 3.19149vw 2.12766%;
  }
</style>
