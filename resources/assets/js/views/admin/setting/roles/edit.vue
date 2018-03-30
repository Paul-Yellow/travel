<template>
<div class="card">
            <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="signup">
              <el-form-item prop="name" label="角色名:">
                <el-input type="text" v-model="ruleForm.name"  placeholder="角色名"></el-input>
              </el-form-item>
              <el-form-item prop="slug" label="角色:">
                <el-input type="text" v-model="ruleForm.slug" placeholder="角色"></el-input>
              </el-form-item>
              <el-form-item prop="desc" label="描述:">
                <el-input type="text" v-model="ruleForm.desc" placeholder="描述"></el-input>
              </el-form-item>
              <el-form-item prop="level" label="等级:">
                <el-input type="text" v-model.number="ruleForm.level" placeholder="等级"></el-input>
              </el-form-item> 
              <el-form-item label="角色权限" prop="permissions">
                <p>为用户添加额外的权限;</p>
                 <el-checkbox-group v-model="ruleForm.permissions" style="border:1px solid #eee;border-radius:4px;padding:.8rem">
                   <ul class="ul-list">
                     <li v-for="(item,key) in permissionsData" :key="key">
                       <el-checkbox :label="item.id" name="permissions"  >{{item.name+'('+item.slug+')'}}</el-checkbox>
                     </li>
                    </ul>
                </el-checkbox-group>
							</el-form-item> 
              <el-form-item>
                <el-button  @click="submitForm('ruleForm')" class="btn-form-submit">保存</el-button>
              </el-form-item>
            </el-form>
  </div>
</template>

<script>
export default {
  name: 'usercreate',
  data() {
    var checkLevel = (rule, value, callback) => {
        if (!value) {
          return callback(new Error('等级不能为空'));
        }
        setTimeout(() => {
          if (!Number.isInteger(value)) {
            callback(new Error('请输入数字值'));
          } else {
            if (value <0 || value >=5) {
              callback(new Error('数值必须大于0并且小于5'));
            } else {
              callback();
            }
          }
        }, 1000);
      };
    return{
      permissionsData: [],
      ruleForm: {
        name: '',
        slug: '',
        desc: '',
        level: '',
        permissions: []
      },
      rules: {
        name: [
          { required: true, message: '请输入角色名称', trigger: 'blur' }
        ],
        slug:[
          {required:true,message:'请输入角色',trigger:'blur'}
        ],
        desc:[
          {required:true,message:'请输入说明信息',trigger:'blur'}
        ],
        level:[
          { validator: checkLevel, trigger: 'blur' }
        ]
      }
    }
  },
  methods: {
    // 添加角色 
    submitForm(formName){
      const formData = this.ruleForm;
      this.$refs[formName].validate((valid)=>{
        if(valid){
          this.$http.put(`/admin/role/${this.$route.params.id}`,formData)
            .then((res)=>{
               if(res.status === 200 && res.data.responData.status === 200){
                this.$message({
                  type: 'success',
                  message: res.data.responData.messages
                });
                return this.$router.go(-1);
              }
            });
        }
      })
    },
    // 获取权限跟角色信息
    fetchData(id){
      this.$http.get('/admin/role/'+id+'/edit')
      .then(({data})=>{
        if(data.permissions.length >0 && data.responData.role){
          this.permissionsData = data.permissions;
          // 设置角色数据
          this.ruleForm.name = data.responData.role.data.name;
          this.ruleForm.slug = data.responData.role.data.slug;
          this.ruleForm.level = data.responData.role.data.level;
          this.ruleForm.desc = data.responData.role.data.description;
        }else{
          this.$message({
            type: 'error',
            message:'空的数据'
          });
        }
      });
    }
  },
  created () {
    this.fetchData(this.$route.params.id);
  }
}
</script>
<style lang="scss" scoped>
.ul-list{
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: flex-start;
  -moz-flex-direction: row;
  -moz-flex-wrap: wrap;
  -moz-justify-content: flex-start;
  -webkit-flex-direction: row;
  -webkit-flex-wrap: wrap;
  -webkit-justify-content: flex-start;
  >li{
    padding: .6rem;
  }
}
.tags-module{
			display:block;
		}
.tags{
	margin: 5px;
}
</style>
