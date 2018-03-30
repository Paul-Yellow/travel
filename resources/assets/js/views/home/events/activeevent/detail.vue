<template>
  <div v-loading.fullscreen.lock="isLoading" v-if="!isLoading">
    <div class="unit-title-blk bg-slash">
      <Breadcrumb class="breadcrumb"></Breadcrumb>
      <h2 class="unit-title icon-unit-event">{{$route.name}}</h2>
    </div> 
    <div class="page-content-wrapper" >
       <div class="content-left-blk">
         <div class="total-nums-blk in-content-page">
           <p class="date"> 发布日期：{{activeevent.created_at}} <br>更新日期：{{activeevent.updated_at}} </p>
           <p class="icon-view">{{activeevent.view_count}}</p>
          </div>  
          <div class="news-detail-blk">
            <h2 style="text-align:center;font-size:2rem;margin-bottom:1rem;">发布者:{{users.name}}</h2>
            <avatar :user="users"></avatar>
            <follow-button :item="users" class="d-inline-block btn-xs"></follow-button>
            <h5 style="text-align:center;margin-bottom:1rem;">活动简介:&nbsp;&nbsp;{{activeevent.content_short}}</h5>
            <dl class="event-info-list"> 
              <dt class="info-label"> 活动时间 </dt> 
              <dd class="info"> {{activeevent.date}} </dd>
              <dt class="info-label">主办单位</dt>
              <dd class="info">{{activeevent.sponsor}}</dd>
              <dt class="info-label"> 活动地点 </dt>
              <dd class="info"> 
                <a :href="`https://www.google.com/maps/place/${activeevent.lo},${activeevent.ln}`" class="btn-location-link" target="_blank" :title="activeevent.area">{{activeevent.area}}</a>
              </dd>
            </dl>
            <div class="manual-script-blk" v-html="activeevent.content">
            </div>
            <share :title="activeevent.title" :url="currentUrl" :image="activeevent.imgUrl"></share>
          </div>
           <div class="page-func-blk">
             <router-link to="/activeevent" class="btn-page-direction" target="_self" title="">回列表</router-link>
            </div>
        </div> 
        <div class="content-right-blk"> 
          <div class="right-side-info-blk"> <h3 class="title">近期最新活动</h3>
            <ul class="hot-info-list">
              <li class="item small-info-card-item" v-for="(item,index) in n_limit" :key="index">
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
            <router-link to="/activeevent" class="btn-more" title="更多活动" style="width:auto;">更多活动</router-link>
          </div>
        <div class="right-side-info-blk"> 
          <h3 class="title">近期活动盛事</h3>
          <ul class="hot-info-list">
            <li class="item small-info-card-item" v-for="(item,index) in a_limit" :key="index"> 
              <router-link :to="`/activeevent/detail/${item.id}`" class="link"  :title="item.title">
                <span class="thumb-frame">
                  <img :src="item.imgUrl"  :alt="item.title" class="thumb lazyloaded">
                </span>
                <div class="info-blk vam-blk">
                  <h3 class="info-title vam">
                    <span class="ellipsis">{{item.content_short}} </span>
                  </h3> 
                  <span class="icon-view">{{item.view_count}}</span>
                </div>
              </router-link>
            </li> 
          </ul>
        <router-link to="/activeevent" class="btn-more" title="更多活动盛事" style="width:auto;"> 更多活动盛事</router-link>
      </div>
    </div>
    
    <comment :list="comment_list" api="activeevents"></comment>
  </div>
  </div>
</template>
<script>
import Breadcrumb from 'components/layout/breadcrumb';
import FollowButton from "components/common/FollowButton";
import Comment from "components/common/comment";
import Avatar from "components/common/Avatar";
// 分享
import Share from 'components/common/Share';
export default {
  name: 'detail',
  components:{
    Breadcrumb,
    FollowButton,
    Comment,
    Avatar,
    Share
  },
  data(){
    return{
      activeevent:{},
      users: {},
      isLoading:false,
      n_limit:[],
      a_limit:[],
      comment_list:[],
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
        this.$http.get(`/activeevent/detail/${this.currentPage}`)
          .then(({data})=>{
            if(data.responData.status === 200){
              this.activeevent = data.responData.data;
              this.a_limit = data.responData.activeevent_limit;
              this.users = data.responData.user.data;
              this.n_limit = data.responData.newevent_limit;
              this.comment_list = data.responData.comments;
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
