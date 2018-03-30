<template>
  <div class="list">
    <search   :linkrouter="create" :list="dataList" v-on:listenList="handleSearch"></search>
    <el-table :data="dataList" v-loading.body="listLoading" border fit highlight-current-row style="width: 100%">
      <el-table-column align="center" label="序号" >
        <template slot-scope="scope">
          <span>{{scope.row.id}}</span>
        </template>
      </el-table-column>
      <el-table-column  label="角色名称">
        <template slot-scope="scope">
          <span class="link-type">{{scope.row.name}}</span>
          <el-tag>{{scope.row.name}}</el-tag>
        </template>
      </el-table-column>

      <el-table-column  align="center" label="角色">
        <template slot-scope="scope">
          <span>{{scope.row.slug}}</span>
        </template>
      </el-table-column>
      <el-table-column  align="center" label="说明">
        <template slot-scope="scope">
          <span>{{scope.row.description}}</span>
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
      <el-table-column  align="center" label="操作" width="280px">
        <template slot-scope="scope">
          <el-button  size="small" type="success" @click="handleRoleEdit(scope.row,'published')">编辑
          </el-button>
          <el-button size="small" type="success"  @click="handleRoleShow(scope.row)">显示角色详情
          </el-button>
          <el-button size="small" type="danger" @click="handleRoleDelete(scope.row,'deleted')">删除
            </el-button>
        </template>
      </el-table-column>
    </el-table>
    <div v-show="!listLoading" class="pagination-container">
      <el-pagination @size-change="handleSizeChange" @current-change="handleCurrentChange" :current-page="listQuery.current_page" :page-sizes="[10,20,30, 50]"
        :page-size="listQuery.per_page" layout="total, sizes, prev, pager, next, jumper" :total="listQuery.total">
      </el-pagination>
    </div>
    <el-dialog
      title="角色权限信息"
      :visible.sync="dialogVisible"
      size="tiny">
      <ul class="rolesinfo">
        <li>角色名称: {{showData.name}}</li>
        <li>角色: {{showData.slug}}</li>
        <li>角色描述: {{showData.description}}</li>
        <li>角色id: {{showData.id}}</li>
        <li>角色创建时间: {{showData.created_ay}}</li>
      </ul>
      <template v-for="(item,key) in showData.permissions">
					<el-tag type="primary" class="tags-module" :key="key" style="margin-right:.5rem;margin-bottom:.8rem;">模块: {{key}}</el-tag>
					<el-tag type="success" class="tags" v-for="v in item" :key="v.id" style="margin-right:.5rem;margin-bottom:.8rem;">{{v.name}}</el-tag>
      </template>
      <span slot="footer" class="dialog-footer">
        <el-button type="primary" @click="dialogVisible = false">确 定</el-button>
      </span>
    </el-dialog>
  </div>
</template>
<script>
import Search from 'components/search/index';
export default {
  name: 'rolelist',
  components:{
    Search
  },
  data(){
    return {
      listLoading: true,
      showData: {},
      list: null,
      listQuery: {
      },
      create: '/admin/setting/roles/create' ,
      dialogVisible:false
    }
  },
  methods:{
     // 搜索
    handleSearch(data){
      this.list = data;
    },
    handleSizeChange(limit){
     this.$router.push({ path:'/admin/setting/roles', query: { limit } })
    },
    handleCurrentChange(page){
      this.$router.push({ path:'/admin/setting/roles', query: { page } })
    },
    // 显示权限详情
    handleRoleShow(e){
      let id = e.id;
      this.$http.get(`/admin/role/${id}`)
        .then((res)=>{
          if(res.status === 200 && res.data.responData.results){
            this.dialogVisible = true;
            this.showData = res.data.responData.results;
          }
        });
    },
    // 编辑权限信息
    handleRoleEdit(e){
      let id = e.id;
      this.$router.push({path:`/admin/setting/roles/${id}/edit`});
    },
    // 删除权限
    handleRoleDelete(e){
      this.$http.delete(`/admin/role/${e.id}`)
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
      this.$http.get(`/admin/role?page=${this.currentPage}&limit=${this.currentLimit}`)
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
<style lang="scss" scoped>
.rolesinfo{
    padding: 1rem;
    >li{
      padding: .8rem;
      border-bottom: 1px solid #ccc;
      >span{
        margin-right: .6rem;
      }
    }
  }
</style>

