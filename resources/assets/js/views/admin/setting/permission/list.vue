<template>
  <div class="list">
    <search   :linkrouter="create" :list="dataList" v-on:listenList="handleSearch"></search>
    <el-table   :data="dataList" v-loading.body="listLoading" border fit highlight-current-row style="width: 100%">
      <el-table-column align="center" label="序号" width="65">
        <template slot-scope="scope">
          <span>{{scope.row.id}}</span>
        </template>
      </el-table-column>
      <el-table-column min-width="300px" label="权限名称">
        <template slot-scope="scope">
          <span class="link-type">{{scope.row.name}}</span>
          <el-tag>{{scope.row.name}}</el-tag>
        </template>
      </el-table-column>

      <el-table-column width="110px" align="center" label="权限">
        <template slot-scope="scope">
          <span>{{scope.row.slug}}</span>
        </template>
      </el-table-column>
      <el-table-column width="110px" align="center" label="说明">
        <template slot-scope="scope">
          <span>{{scope.row.description}}</span>
        </template>
      </el-table-column>
      <el-table-column width="110px" align="center" label="创建时间">
        <template slot-scope="scope">
          <span>{{scope.row.created_at}}</span>
        </template>
      </el-table-column>
      <el-table-column width="110px" align="center" label="更新时间">
        <template slot-scope="scope">
          <span>{{scope.row.updated_at}}</span>
        </template>
      </el-table-column>
      <el-table-column  align="center" label="操作" width="150">
        <template slot-scope="scope">
          <el-button v-if="scope.row.status!='published'" size="small" type="success" @click="handlePermissionEdit(scope.row)">编辑
          </el-button>
          <el-button v-if="scope.row.status!='deleted'" size="small" type="danger" @click="handlePermissionDelete(scope.row,'deleted')">删除
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
import Search from 'components/search/index';
export default {
  name: 'uploadimglist',
  components:{
    Search
  },
  data(){
    return {
      listLoading: true,
      list: null,
      listQuery: {
      },
      create: '/admin/setting/permission/create' ,
      dialogVisible:false
    }
  },
  methods:{
    // 搜索
    handleSearch(data){
      this.list = data;
    },
    handleSizeChange(limit){
     this.$router.push({ path:'/admin/setting/permission', query: { limit } })
    },
    handleCurrentChange(page){
      this.$router.push({ path:'/admin/setting/permission', query: { page } })
    },
    // 编辑权限信息
    handlePermissionEdit(e){
      let id = e.id;
      this.$router.push({path:`/admin/setting/permission/${id}/edit`});
    },
    // 删除权限
    handlePermissionDelete(e){
      this.$http.delete(`/admin/permission/${e.id}`)
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
      this.$http.get(`/admin/permission?page=${this.currentPage}&limit=${this.currentLimit}`)
      .then(({data})=>{
        if(data.data){
          this.list = data.data;
          this.listQuery = data.meta.pagination;
          this.listLoading = false;
        }
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
