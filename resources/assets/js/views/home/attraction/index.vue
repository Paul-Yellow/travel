<template>
  <div>
    <div class="unit-title-blk bg-slash">
      <Breadcrumb class="breadcrumb"></Breadcrumb>
      <h2 class="unit-title icon-unit-attraction">{{$route.name}}</h2>
    </div>
    <div class="page-content-wrapper" v-loading.fullscreen.lock="listLoading" v-if="!listLoading">
      <p class="total-nums-blk">共有<span class="nums">{{listCount}}</span>个主题分类</p>
      <ul class="event-news-card-list">
        <li class="item"  v-for="(item,key) in list"  :key="key">
          <div class="icon-card-item bg-slash-green region">
            <router-link :to="{path:'/attraction/list/',query:{pid:item.id}}"  class="link" :title="item.name">
              <span class="thumb-frame">
                <img :src="item.path" :alt="item.name" class="thumb lazyloaded">
              </span>
              <div class="info-blk vam-blk"><h3 class="info-title vam"><span class="ellipsis">{{item.name}}</span></h3></div>
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
  name: 'theme_attraction',
  data(){
    return{
      list:[],
      listLoading: false,
    }
  },
  components:{
    Breadcrumb
  },
  created(){
    this.initData();
  },
  methods:{
    initData(){
      this.listLoading = true;
      this.$http.get(`/category`)
        .then(({data})=>{
          if(data.responData.status === 200){
            data.responData.category.filter((item)=>{
              if(item.name.includes('主题景点')){
                this.$http.get(`/category?id=${item.id}`)
                  .then(({data})=>{
                    if(data.responData.status === 200){
                      this.list = data.responData.category;
                      this.listLoading = false;
                    }
                  });
              }
            });
          }
        });
    }
  },
  computed:{
    listCount(){
      return this.list.length;
    }
  }
}
</script>
