<template>
  <div>
    <div class="unit-title-blk bg-slash">
      <Breadcrumb class="breadcrumb"></Breadcrumb>
      <h2 class="unit-title icon-unit-attraction">{{$route.name}}</h2>
    </div>
    <div class="page-content-wrapper" v-loading.fullscreen.lock="listLoading" v-if="!listLoading">
      <p class="total-nums-blk"> 共有<span class="nums">{{listCount}}</span>个景点</p>
      <ul class="event-news-card-list">
        <li class="item news" v-for="(item,index) in dataList" :key="index">
          <div class="info-card-item">
            <router-link :to="`/attraction/detail/${item.id}`" class="link" :title="item.title">
              <span class="thumb-frame">
                <img :src="item.imgUrl"  :alt="item.title" class="thumb lazyloaded"> 
              </span>
              <div class="info-blk">
                <span class="date">开放时间:{{item.date}}</span> <h3 class="info-title">{{item.content_short}}</h3> 
              </div>
            </router-link>
            <div class="func-blk">
              <span class="icon-view-1">最后编辑时间:{{item.date_time}}</span>
              <span class="icon-view">{{item.view_count}}</span>
            </div>
          </div>
        </li>
      </ul>
      <div v-show="!listLoading" class="pagination-container">
        <el-pagination @size-change="handleSizeChange" @current-change="handleCurrentChange" :current-page="listQuery.current_page" :page-sizes="[10,20,30, 50]"
          :page-size="listQuery.per_page" layout="total, sizes, prev, pager, next, jumper" :total="listQuery.total">
        </el-pagination>
      </div>
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
      listQuery: {
      },
    }
  },
  components:{
    Breadcrumb
  },
  created(){
    this.initData();
  },
  methods:{
    handleSizeChange(limit){
     this.$router.push({ path:'/attraction/list', query: { limit } })
    },
    handleCurrentChange(page){
      this.$router.push({ path:'/attraction/list', query: { page } })
    },
    initData(){
      this.listLoading = true;
      if(this.currentPageId){
        this.$http.get(`/attraction/list?pid=${this.currentPageId}&page=${this.currentPage}&limit=${this.currentLimit}`)
          .then(({data})=>{
            if(data.data.length>0){
              this.list = data.data;
            }else{
              this.$message({
                type: 'info',
                message: '没有数据'
              });
            }
            this.listQuery = data.meta.pagination;
            this.listLoading = false;
          });
      }else{
         this.$http.get(`/attraction/list?page=${this.currentPage}&limit=${this.currentLimit}`)
          .then(({data})=>{
            if(data.data.length>0){
              this.list = data.data;
            }else{
              this.$message({
                type: 'info',
                message: '没有数据'
              });
            }
            this.listQuery = data.meta.pagination;
            this.listLoading = false;
          });
      }
    }
  },
   watch:{
     // when page change, fetch new data
    currentPage: 'initData',
    currentLimit: 'initData'
  },
  computed:{
    currentPageId(){
      return parseInt(this.$route.query.pid);
    },
    dataList(){
      return this.list;
    },
    currentPage() {
      return parseInt(this.$route.query.page, 10) || 1
    },
    currentLimit() {
      return parseInt(this.$route.query.limit,10) || 10
    },
    listCount(){
      return this.list.length;
    }
  }
}
</script>
