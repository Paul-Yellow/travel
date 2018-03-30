<template>
  <div class="list">
    <search   :linkrouter="create" :list="dataList" v-on:listenList="handleSearch"></search>
    <el-table   :data="dataList" v-loading.body="listLoading" border fit highlight-current-row style="width: 100%">
      <el-table-column align="center" label="序号" width="65">
        <template slot-scope="scope">
          <span>{{scope.row.id}}</span>
        </template>
      </el-table-column>
      <el-table-column min-width="300px" label="类型名字">
        <template slot-scope="scope">
          <span class="link-type">{{scope.row.name}}</span>
          <el-tag>{{scope.row.name}}</el-tag>
        </template>
      </el-table-column>

      <el-table-column width="110px" align="center" label="类型关系">
        <template slot-scope="scope">
          <span>{{scope.row.pid===0?'父级分类':'子级分类'}}</span>
        </template>
      </el-table-column>
      <el-table-column width="110px" align="center" label="说明">
        <template slot-scope="scope">
          <span>{{scope.row.desc}}</span>
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
          <el-button v-if="scope.row.status!='published'" size="small" type="success" @click="handleCategoryEdit(scope.row)">编辑
          </el-button>
          <el-button v-if="scope.row.status!='deleted'" size="small" type="danger" @click="handleCategoryDelete(scope.row,'deleted')">删除
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
      create: '/admin/category/create' ,
      dialogVisible:false
    }
  },
  methods:{
    // 搜索
    handleSearch(data){
      this.list = data;
    },
    handleSizeChange(limit){
     this.$router.push({ path:'/admin/category', query: { limit } })
    },
    handleCurrentChange(page){
      this.$router.push({ path:'/admin/category', query: { page } })
    },
    // 编辑类型信息
    handleCategoryEdit(e){
      let id = e.id;
      this.$router.push({path:`/admin/category/${id}/edit`});
    },
    // 删除类型
    handleCategoryDelete(e){
      this.$http.delete(`/admin/category/${e.id}`)
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
      this.$http.get(`/admin/category?page=${this.currentPage}&limit=${this.currentLimit}`)
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
