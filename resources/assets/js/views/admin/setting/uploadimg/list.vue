<template>
  <div class="list">
    <el-table   :data="dataList" v-loading.body="listLoading" border fit highlight-current-row style="width: 100%">
      <el-table-column align="center" label="序号" >
        <template slot-scope="scope">
          <span>{{scope.row.id}}</span>
        </template>
      </el-table-column>
      <el-table-column  label="标题">
        <template slot-scope="scope">
          <span class="link-type" @click="handleUpdate(scope.row)">{{scope.row.name}}</span>
        </template>
      </el-table-column>
       <el-table-column  label="图片地址">
        <template slot-scope="scope">
          <span class="link-type" @click="handleUpdate(scope.row)">{{scope.row.url}}</span>
        </template>
      </el-table-column>
      <el-table-column  align="center" label="上传作者">
        <template slot-scope="scope">
          <span>{{scope.row.author}}</span>
        </template>
      </el-table-column>

      <el-table-column  align="center" label="操作">
        <template slot-scope="scope">
          <el-button  size="small" type="success" @click="handleImgShow(scope.row)">显示图片
          </el-button>
          <el-button v-if="scope.row.status!='deleted'" size="small" type="danger" @click="handleUploadImgDelete(scope.row,'deleted')">删除
          </el-button>
        </template>
      </el-table-column>
    </el-table>
    <div v-show="!listLoading" class="pagination-container">
      <el-pagination @size-change="handleSizeChange" @current-change="handleCurrentChange" :current-page="listQuery.current_page" :page-sizes="[10,20,30, 50]"
        :page-size="listQuery.per_page" layout="total, sizes, prev, pager, next, jumper" :total="listQuery.total">
      </el-pagination>
    </div>
    <el-dialog title="查看轮播图" v-model="dialogVisible" size="large">
        <img class="pan-img" :src="ewizardClap" style="width:100%;height:auto;">
    </el-dialog>
  </div>
</template>
<script>

export default {
  name: 'uploadimglist',
  components:{
  },
  data(){
    return {
      listLoading: true,
      list: null,
      listQuery: {
      },
      dialogVisible:false,
      ewizardClap: ''
    }
  },
  methods:{
    handleSizeChange(limit){
     this.$router.push({ path:'/admin/setting/uploadimg', query: { limit } })
    },
    handleCurrentChange(page){
      this.$router.push({ path:'/admin/setting/uploadimg', query: { page } })
    },
    handleImgShow(e){
      this.dialogVisible = true;
      this.ewizardClap = e.url;
    },
    // 删除图片
    handleUploadImgDelete(e){
      let id = e.id;
      this.$http.delete(`/admin/uploadimg/${e.id}`)
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
      this.$http.get(`/admin/uploadimg?page=${this.currentPage}&limit=${this.currentLimit}`)
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
