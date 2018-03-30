<template>
  <div>
    <div class="unit-title-blk bg-slash">
      <Breadcrumb class="breadcrumb"></Breadcrumb>
      <h2 class="unit-title icon-unit-event">{{$route.name}}</h2>
    </div>
    <div class="page-content-wrapper" v-loading.fullscreen.lock="listLoading" v-if="!listLoading">
      <p class="total-nums-blk"> 共有<span class="nums">{{listQuery.total}}</span>个最新活动</p>
      <!-- <div class="filter-sort-blk"> <strong class="title icon-sort">排序：</strong>
        <ul class="filter-sort-list">
          <li class="item"> <a href="/zh-cn/news?page=1&amp;sortby=hits" class="btn-sort " title="最热门"> 最热门 </a> </li>
          <li class="item"> <a href="/zh-cn/news?page=1&amp;sortby=recently" class="btn-sort " title="最近时间"> 最近时间 </a> </li>
          <li class="item"> <a href="/zh-cn/news?page=1&amp;sortby=oldertime" class="btn-sort " title="较旧的时间"> 较旧的时间 </a> </li>
        </ul>
      </div> -->
      <ul class="event-news-card-list">
        <li class="item news" v-for="(item,index) in dataList" :key="index">
          <div class="info-card-item">
            <router-link :to="`/activeevent/detail/${item.id}`" class="link" :title="item.title">
              <span class="thumb-frame">
                <img :src="item.imgUrl"  :alt="item.title" class="thumb lazyloaded"> 
              </span>
              <div class="info-blk">
                <span class="date">活动时间:{{item.date}}</span> <h3 class="info-title">{{item.content_short}}</h3> 
              </div>
            </router-link>
            <div class="func-blk">
              <span class="icon-view-1">最后编辑时间:{{item.date_time}}</span>
              <span class="icon-view">{{item.view_count}}</span>
              <favourite :item="item" type="favorited" api="/admin/activeevents/favourite"></favourite>
              <links :item="item" type="liked" api="/admin/activeevents/links"></links>
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
import Favourite from 'components/common/favourite';
import Links from 'components/common/links';
export default {
  name: 'activeeventlist',
  components:{
    Breadcrumb,
    Favourite,
    Links
  },
  data(){
    return {
      listLoading: false,
      list: null,
      listQuery: {
      },
    }
  },
  methods:{
    handleSizeChange(limit){
     this.$router.push({ path:'/activeevent', query: { limit } })
    },
    handleCurrentChange(page){
      this.$router.push({ path:'/activeevent', query: { page } })
    },
    fetchList(){
      this.listLoading = true;
      this.$http.get(`/activeevent?page=${this.currentPage}&limit=${this.currentLimit}`)
      .then(({data})=>{
        this.list = data.data;
        this.listQuery = data.meta.pagination;
        this.listLoading = false;
      });
    }
  },
  mounted(){
    this.fetchList();
  },
  watch:{
     // when page change, fetch new data
    currentPage: 'fetchList',
    currentLimit: 'fetchList'
  },
  computed: {
    currentPage() {
      return parseInt(this.$route.query.page, 10) || 1
    },
    currentLimit() {
      return parseInt(this.$route.query.limit,10) || 10
    },
    dataList(){
      return this.list;
    }
  }
}
</script>
