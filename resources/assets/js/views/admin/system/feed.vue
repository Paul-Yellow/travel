<template>
  <div class="list">
    <el-table :data="dataList" v-loading.body="listLoading" border fit highlight-current-row style="width: 100%">
      <el-table-column align="center" label="序号" >
        <template slot-scope="scope">
          <span>{{scope.row.id}}</span>
        </template>
      </el-table-column>

      <el-table-column  align="center" label="反馈内容">
        <template slot-scope="scope">
          <span>{{scope.row.content}}</span>
        </template>
      </el-table-column>
      <el-table-column  align="center" label="反馈者ip地址">
        <template slot-scope="scope">
          <span>{{scope.row.ip}}</span>
        </template>
      </el-table-column>
      <el-table-column  align="center" label="反馈者用户id">
        <template slot-scope="scope">
          <span>{{scope.row.user_id}}</span>
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
      <el-table-column  align="center" label="操作" width="150">
        <template slot-scope="scope">
          <el-button v-if="scope.row.status!='deleted'" size="small" type="danger" @click="handleDelete(scope.row,'deleted')">删除
            </el-button>
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
  name: 'feed',
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
     this.$router.push({ path:'/admin/manage/feed', query: { limit } })
    },
    handleCurrentChange(page){
      this.$router.push({ path:'/admin/manage/feed', query: { page } })
    },
    // 删除反馈
    handleDelete(e){
      this.$http.delete(`/admin/feed/${e.id}`)
        .then((res)=>{
          if(res.status === 204)
            {
              this.$message({
                type: 'success',
                message: '删除成功'
              });
              this.fetchList();
            }
        });
    },
    fetchList(){
      this.listLoading = true;
      this.$http.get(`/admin/feed?page=${this.currentPage}&limit=${this.currentLimit}`)
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
