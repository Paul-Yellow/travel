<template>
  <div class="list">
    <el-table :data="dataList" v-loading.body="listLoading" border fit highlight-current-row style="width: 100%">
      <el-table-column align="center" label="序号" >
        <template slot-scope="scope">
          <span>{{scope.row.id}}</span>
        </template>
      </el-table-column>
      <!-- <el-table-column  label="操作用户">
        <template slot-scope="scope">
          <span class="link-type">{{scope.row.user.data.name}}</span>
          <el-tag>{{scope.row.user.data.name}}</el-tag>
        </template>
      </el-table-column> -->

      <el-table-column  align="center" label="操作项目id">
        <template slot-scope="scope">
          <span>{{scope.row.action_id}}</span>
        </template>
      </el-table-column>
      <el-table-column  align="center" label="操作细节">
        <template slot-scope="scope">
          <span>{{scope.row.action}}</span>
        </template>
      </el-table-column>
      <el-table-column  align="center" label="操作模型">
        <template slot-scope="scope">
          <span>{{scope.row.action_type}}</span>
        </template>
      </el-table-column>
      <el-table-column  align="center" label="创建时间">
        <template slot-scope="scope">
          <span>{{scope.row.created_at}}</span>
        </template>
      </el-table-column>
      <el-table-column  align="center" label="更新时间">
        <template slot-scope="scope">
          <span>{{scope.row.updated_at}}</span>
        </template>
      </el-table-column>
    </el-table>
    <div v-show="!listLoading" class="pagination-container">
      <el-pagination @size-change="handleSizeChange" @current-change="handleCurrentChange" :current-page="listQuery.current_page" :page-sizes="[10,20,30, 50]"
        :page-size="listQuery.per_page" layout="total, sizes, prev, pager, next, jumper" :total="listQuery.total">
      </el-pagination>
    </div>
  </div>
</template>
<script>
export default {
  name: 'log',
  data(){
    return {
      listLoading: true,
      showData: {},
      list: null,
      listQuery: {
      },
    }
  },
  methods:{
    handleSizeChange(limit){
     this.$router.push({ path:'/admin/manage/actionlog', query: { limit } })
    },
    handleCurrentChange(page){
      this.$router.push({ path:'/admin/manage/actionlog', query: { page } })
    },
    fetchList(){
      this.listLoading = true;
      this.$http.get(`/admin/log?page=${this.currentPage}&limit=${this.currentLimit}`)
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
  watch: {
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

</script>
