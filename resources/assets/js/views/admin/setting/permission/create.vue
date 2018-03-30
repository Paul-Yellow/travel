<template>
<div class="card">
            <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="signup">
              <el-form-item prop="name" label="权限名:">
                <el-input type="text" v-model="ruleForm.name"  placeholder="权限名"></el-input>
              </el-form-item>
              <el-form-item prop="slug" label="权限:">
                <el-input type="text" v-model="ruleForm.slug" placeholder="权限"></el-input>
              </el-form-item>
              <el-form-item prop="desc" label="描述:">
                <el-input type="text" v-model="ruleForm.desc" placeholder="描述"></el-input>
              </el-form-item>
              <el-form-item prop="model" label="模型">
                <el-input type="text" v-model="ruleForm.model" placeholder="模型"></el-input>
              </el-form-item> 
              <el-form-item>
                <el-button  @click="submitForm('ruleForm')" class="btn-form-submit">创建</el-button>
              </el-form-item>
            </el-form>
  </div>
</template>

<script>
export default {
  name: 'usercreate',
  data() {
    return{
      ruleForm: {
        name: '',
        slug: '',
        desc: '',
        model: ''
      },
      rules: {
        name: [
          { required: true, message: '请输入权限名称', trigger: 'blur' }
        ],
        slug:[
          {required:true,message:'请输入权限',trigger:'blur'}
        ],
        desc:[
          {required:true,message:'请输入说明信息',trigger:'blur'}
        ]
      }
    }
  },
  methods: {
    // 添加权限
    submitForm(formName){
      const formData = this.ruleForm;
      this.$refs[formName].validate((valid)=>{
        if(valid){
          this.$http.post(`/admin/permission`,formData)
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
    }
  },
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
