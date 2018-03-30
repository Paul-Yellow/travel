<template>
  <div class="list">
    <search  :linkrouter="create" :list="userList" v-on:listenList="handleSearch"></search>
    <el-table   :data="userList" v-loading.body="listLoading" border fit highlight-current-row style="width: 100%">
      <el-table-column align="center" label="序号" width="65">
        <template slot-scope="scope">
          <span>{{scope.row.id}}</span>
        </template>
      </el-table-column>
      <el-table-column  label="用户名称" width="150px">
        <template slot-scope="scope">
          <span class="link-type" @click="handleUserShow(scope.row)">{{scope.row.name}}
            <el-tag>查看权限信息</el-tag>
          </span>
        </template>
      </el-table-column>
      <el-table-column  align="center" label="用户邮箱">
        <template slot-scope="scope">
          <span>{{scope.row.email}}</span>
        </template>
      </el-table-column>
      <el-table-column  align="center" label="用户性别">
        <template slot-scope="scope">
          <span>{{scope.row.sex}}</span>
        </template>
      </el-table-column>
      <el-table-column  align="center" label="注册手机">
        <template slot-scope="scope">
          <span>{{scope.row.iphone}}</span>
        </template>
      </el-table-column>
      <el-table-column width="110px" align="center" label="用户状态">
        <template slot-scope="scope">
          <span v-if="scope.row.status !== 1">账户禁用'</span>
          <span v-else>账户启用</span>
        </template>
      </el-table-column>
      <el-table-column  align="center" label="是否验证邮箱">
        <template slot-scope="scope">
          <span v-if="scope.row.confirm_email !==1">邮箱未验证</span>
          <span v-else>邮箱已验证</span>
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
          <el-button  size="small" type="success" @click="handleUserEdit(scope.row)">编辑
          </el-button>
          <el-button  size="small" type="success" @click="handleUserStatus(scope.row,2)" v-if="scope.row.status ===1">
            禁用用户
          </el-button>
          <el-button  size="small" type="success" @click="handleUserStatus(scope.row,1)" v-if="scope.row.status ===2">
            启用用用户
          </el-button>
          <el-button  size="small" type="danger" @click="handleUserDelete(scope.row,'deleted')">删除
            </el-button>
        </template>
      </el-table-column>
    </el-table>
    <div v-show="!listLoading" class="pagination-container">
      <el-pagination @size-change="handleSizeChange" @current-change="handleCurrentChange" :current-page="listQuery.current_page" :page-sizes="[10,20,30, 50]"
        :page-size="listQuery.per_page" layout="total, sizes, prev, pager, next, jumper" :total="listQuery.total">
      </el-pagination>
    </div>
    <!--显示用户信息 -->
    <el-dialog
      title="用户角色与权限"
      :visible.sync="dialogVisible"
      size="tiny">
      <ul class="userinfo" v-if="userData.roles">
        <li v-for="(item,key) in userData.roles" :key="key"><span>角色:</span>{{item}}</li> 
      </ul>
      <h3>用户权限</h3>
      <template v-for="(item,key) in userData.permission">
					<!-- <el-tag type="primary" class="tags-module" :key="key">模块: {{key}}</el-tag> -->
					<el-tag type="success" class="tags" :key="key" style="margin-right:.5rem;margin-bottom:.8rem;">{{item}}</el-tag>
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
      create: '/admin/setting/users/create',
      dialogVisible:false,
      userData:{}
    }
  },
  methods:{
    // 搜索
    handleSearch(data){
      this.list = data;
    },
    // 改变页码
    handleSizeChange(limit){
     this.$router.push({ path:'/admin/setting/users', query: { limit } })
    },
    handleCurrentChange(page){
      this.$router.push({ path:'/admin/setting/users', query: { page } })
    },
    // 显示用户信息
    handleUserShow(e){
      let id = e.id;
      this.$http.get(`/admin/users/${id}`)
        .then((res)=>{
          if(res.status === 200 && res.data.responData.roles.length>0 && res.data.responData.permission.length >0){
            this.dialogVisible = true;
            this.userData = res.data.responData;
          }
        });
    },
    // 编辑用户信息
    handleUserEdit(e){
      let id = e.id;
      // 跳到编辑页面
      this.$router.push({path:`/admin/setting/users/${id}/edit`});
    },
    // 改变用户状态
    handleUserStatus(e,val){
      let id = e.id;
      this.$http.put(`/admin/updatestatus/${id}`,{status:val})
        .then((res)=>{
          if(res.status === 200 && res.data.responData.message){
            this.$message({
              type: 'success',
              message: res.data.responData.message
            });
            setTimeout(()=>{
                window.location.href = '/admin/setting/users';
              },1000);
          }
        });
    },
    // 删除用户
    handleUserDelete(e){
      this.$http.delete(`/admin/users/${e.id}`)
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
      this.$http.get(`/admin/users?page=${this.currentPage}&limit=${this.currentLimit}`)
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
    userList(){
      return this.list;
    }
  }
}
</script>
<style lang="scss" scoped>
  .link-type{
    cursor: pointer;
  }
  .userinfo{
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
