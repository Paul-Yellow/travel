<template>
  <div class="info">
    <el-tabs type="border-card">
      <el-tab-pane label="系统信息">
        <div class="systeminfo">
          <h2>系统</h2>
          <table class="table table-hover">
            <thead>
              <tr>
                <th class="pk-table-width-150">配置</th>
                <th>值</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>服务:</td>
                <td>{{ info.server }}</td>
              </tr>
              <tr>
                <td>地址:</td>
                <td>{{ info.http_host }}</td>
              </tr>
              <tr>
                <td>IP:</td>
                <td>{{ info.remote_host }}</td>
              </tr>
              <tr>
                <td>User Agent: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>{{ info.user_agent }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </el-tab-pane>
      <el-tab-pane label="php信息">
        <div class="systeminfo">
          <h2>php</h2>
          <table class="table table-hover">
            <thead>
              <tr>
                <th class="pk-table-width-150">配置</th>
                <th>值</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="width:100px;">php版本:</td>
                <td>{{ info.php }}</td>
              </tr>
              <tr>
                <td style="width:100px;">句柄:</td>
                <td>{{ info.sapi_name }}</td>
              </tr>
              <tr>
                <td style="width:100px;">扩展:</td>
                <td>{{ info.extensions }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </el-tab-pane>
      <el-tab-pane label="数据库信息">
        <div class="systeminfo">
          <h2>数据库</h2>
          <table class="table table-hover">
            <thead>
              <tr>
                <th class="pk-table-width-150">配置</th>
                <th>值</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="width:100px;">驱动:</td>
                <td>{{ info.db_connection }}</td>
              </tr>
              <tr>
                <td style="width:100px;">数据库:</td>
                <td>{{ info.db_database }}</td>
              </tr>
              <tr>
                <td style="width:100px;">版本:</td>
                <td>{{ info.db_version }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </el-tab-pane>
      
    </el-tabs>
  </div>
</template>
<script>
export default {
  name: 'systeminfo',
  data(){
    return {
      info: {}
    }
  },
  mounted(){
    this.initData();
  },
  methods:{
    initData(){
      this.$http.get('/admin/systeminfo')
        .then(({data})=>{
          if(data){
            this.info = data;
          }else{
            this.$message({
              type: 'error',
              message: '数据是空的'
            })
          }
        });
    }
  }
}
</script>
