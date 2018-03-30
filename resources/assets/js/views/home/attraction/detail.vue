<template>
  <div v-loading.fullscreen.lock="isLoading" v-if="!isLoading">
    <div class="unit-title-blk bg-slash">
      <Breadcrumb class="breadcrumb"></Breadcrumb>
      <h2 class="unit-title icon-unit-event">{{$route.name}}</h2>
    </div> 
    <div class="page-content-wrapper" >
       <div class="content-left-blk">
         <div class="total-nums-blk in-content-page">
           <p class="date"> 发布日期：{{attraction.created_at}} <br>更新日期：{{attraction.updated_at}} </p>
           <p class="icon-view">{{attraction.view_count}}</p>
          </div>  
          <div class="news-detail-blk">
            <h2 style="text-align:center;font-size:2rem;margin-bottom:1rem;">发布者:{{users.name}}</h2>
            <avatar :user="users"></avatar>
            <h5 style="text-align:center;margin-bottom:1rem;">景点简介:&nbsp;&nbsp;{{attraction.content_short}}</h5>
        
            <div class="manual-script-blk" v-html="attraction.content">
            </div>
            <share :title="attraction.title" :url="currentUrl" :image="attraction.imgUrl"></share>
          </div>
           <div class="page-func-blk">
             <router-link to="/attraction" class="btn-page-direction" target="_self" title="">回列表</router-link>
            </div>
        </div> 
        <div class="content-right-blk"> 
          <div class="right-side-info-blk"> <h3 class="title">周边景点</h3>
            <ul class="hot-info-list">
              <li class="item small-info-card-item" v-for="(item,index) in list" :key="index">
                <router-link :to="`/newevent/detail/${item.id}`" class="link" :title="item.title"> 
                  <span class="thumb-frame">
                   <img :src="item.imgUrl"  :alt="item.title" class="thumb lazyloaded">
                  </span>
                  <div class="info-blk vam-blk">
                    <h3 class="info-title vam"> <span class="ellipsis"> {{item.content_short}}</span> </h3>
                    <span class="icon-view">{{item.view_count}}</span> </div>
                </router-link>
              </li> 
            </ul>
            <router-link to="/attraction" class="btn-more" title="更多活动" style="width:auto;">更多活动</router-link>
          </div>
    </div>
  </div>
  </div>
</template>
<script>
import Breadcrumb from 'components/layout/breadcrumb';
import Avatar from "components/common/Avatar";
// 分享
import Share from 'components/common/Share';
export default {
  name: 'detail',
  components:{
    Breadcrumb,
    Avatar,
    Share
  },
  data(){
    return{
      attraction:{},
      users: {},
      isLoading:false,
      list: [],
      currentUrl: ''
    }
  },
  created(){
    this.initData();
    this.currentUrl = 'http://www.keep-wan.me'+this.$route.path;
  },
  methods:{
    initData(){
        this.isLoading = true;
        this.$http.get(`/attraction/detail/${this.currentPage}`)
          .then(({data})=>{
            if(data.responData.status === 200){
              this.attraction = data.responData.data;
              this.users = data.responData.user.data;
              this.list = data.responData.list;
              this.isLoading = false;
            }else{
              this.$message({
                type: 'error',
                message: data.responData.messages
              });
            }
          });
    }
  },
  watch:{
    currentPage: 'initData'
  },
  computed:{
    currentPage(){
      return parseInt(this.$route.params.id);
    }
  }
}
</script>
<style lang="scss" scoped>
.d-inline-block{
  display: inline-block !important;
}
</style>
