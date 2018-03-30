<template>
  <div>
    <div class="unit-title-blk bg-slash">
      <Breadcrumb class="breadcrumb"></Breadcrumb>
      <h2 class="unit-title icon-unit-event">{{$route.name}}</h2>
    </div>
    <div class="page-content-wrapper" v-loading.fullscreen.lock="listLoading" v-if="!listLoading">
      <p class="total-nums-blk"> 共有<span class="nums">{{listQuery.total}}</span>个文章</p>
      <ul class="event-news-card-list">
        <li class="item news" v-for="(item,index) in dataList" :key="index">
          <div class="info-card-item">
            <router-link :to="`/talent/detail/${item.id}`" class="link" :title="item.explain">
              <span class="thumb-frame">
                <img :src="item.imgUrl"  :alt="item.explain" class="thumb lazyloaded"> 
              </span>
            </router-link>
            <div class="func-blk">
              <span class="icon-view-1">最后编辑时间:{{item.date_time}}</span>
              <span class="icon-view">{{item.view_count}}</span>
              <favourite :item="item" type="favorited" api="/admin/talent/favourite"></favourite>
              <links :item="item" type="liked" api="/admin/talent/links"></links>
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
  name: 'talentlist',
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
     this.$router.push({ path:'/talent', query: { limit } })
    },
    handleCurrentChange(page){
      this.$router.push({ path:'/talent', query: { page } })
    },
    fetchList(){
      this.listLoading = true;
      this.$http.get(`/talent?page=${this.currentPage}&limit=${this.currentLimit}`)
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
