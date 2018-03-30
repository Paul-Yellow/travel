<template>
  <div>
    <div class="unit-title-blk bg-slash">
      <Breadcrumb class="breadcrumb"></Breadcrumb>
      <h2 class="unit-title icon-unit-accommodation">{{$route.name}}</h2>
    </div>
    <div class="page-content-wrapper">
      <ul class="event-news-card-list">
        <li class="item" v-for="(item,index) in noticelist" :key="index">
          <div class="icon-card-item bg-slash-blue region">
            <router-link :to="item.url" class="link" target="_self" :title="item.name">
              <span class="thumb-frame">
                <img :src="item.img" :alt="item.name"  class="thumb lazyloaded">
              </span>
              <div class="info-blk vam-blk">
                <h3 class="info-title vam">
                  <span class="ellipsis">{{item.name}}</span>
                </h3>
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
import {noticelist} from 'utils/mock';
export default {
  components:{
    Breadcrumb
  },
  data(){
    return{
      noticelist: noticelist
    }
  }
}
</script>

