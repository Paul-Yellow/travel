<template>
  <div v-loading.fullscreen.lock="isLoading" v-if="!isLoading">
    <div class="unit-title-blk bg-slash">
      <Breadcrumb class="breadcrumb"></Breadcrumb>
      <h2 class="unit-title icon-unit-event">{{$route.name}}</h2>
    </div>  
    <div class="page-content-wrapper" >
       <div class="content-left-blk">
         <div class="total-nums-blk in-content-page">
           <p class="date"> 发布日期：{{talent.created_at}} <br>更新日期：{{talent.updated_at}} </p>
           <p class="icon-view">{{talent.view_count}}</p>
          </div>  
          <div class="news-detail-blk">
            <h2 style="text-align:center;font-size:2rem;margin-bottom:1rem;">发布者:{{users.name}}</h2>
            <avatar :user="users"></avatar>
            <follow-button :item="users" class="d-inline-block btn-xs"></follow-button>
            <h5 style="text-align:center;margin-bottom:1rem;">简介:&nbsp;&nbsp;{{talent.content_short}}</h5>
            <dl class="event-info-list"> 
              <dt class="info-label">游玩时间 </dt> 
              <dd class="info">{{talent.date}}</a></dd>
            </dl>
            <div class="manual-script-blk" v-html="talent.content">
            </div>
            <share :title="talent.name" :url="currentUrl" :image="talent.imgUrl"></share>
          </div>
           <div class="page-func-blk">
             <router-link to="/talent" class="btn-page-direction" target="_self" title="">回列表</router-link>
            </div>
        </div> 
        <div class="content-right-blk"> 
          <div class="right-side-info-blk" v-if="users.id === currentUser.id">
            <h3 class="title">
              编辑或删除文章
            </h3>
            <div class="spot-map-blk" style="padding:1.5rem;">
              <span>
                <el-button type="info" @click="handleEdit(talent.id)">编辑文章</el-button>
              </span>
              <span>
                <el-button type="danger" @click="hanDeltel(talent.id)">删除文章</el-button>
              </span>
            </div>
          </div>
          <div class="right-side-info-blk" v-if="!users.id && !currentUser.id">
            <h3 class="title">
              请登入后操作
            </h3>
            <div class="spot-map-blk" style="padding:1.5rem;">
              <span>
                什么都没有
              </span>
            </div>
          </div>
    </div>
    
    <comment :list="comment_list" api="talent"></comment>
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
import {mapGetters} from 'vuex';
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
      talent:{},
      users: {},
      isLoading:false,
      // n_limit:[],
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
        this.$http.get(`/talent/detail/${this.currentPage}`)
          .then(({data})=>{
            if(data.responData.status === 200){
              this.talent = data.responData.talent;
              // this.n_limit = data.responData.talent_limit;
              this.users = data.responData.user.data;
              this.comment_list = data.responData.comments;
              this.isLoading = false;
            }else{
              this.$message({
                type: 'error',
                message: data.responData.messages
              });
            }
          });
    },
    handleEdit(id){
      this.$router.push({path:`/me/${id}/edit`});
    },
    hanDeltel(id){
     this.$http.delete(`/admin/talent/${id}`)
        .then((res)=>{
          if(res.status === 204)
            {
              this.$message({
                type: 'success',
                message: '删除成功'
              });
              return this.$router.go(-1);
            }
        });
   }
  },
  watch:{
    currentPage: 'initData'
  },
  computed:{
    ...mapGetters(['currentUser']),
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
