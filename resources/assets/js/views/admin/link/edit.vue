<template>
<div class="card">
            <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="signup">
              <el-form-item prop="name" label="链接名称:">
                <el-input type="text" v-model="ruleForm.name"  placeholder="链接名称"></el-input>
              </el-form-item>
              <el-form-item prop="link" label="链接地址:">
                <el-input type="text" v-model="ruleForm.link"  placeholder="链接地址,格式: home"></el-input>
              </el-form-item>
              <el-form-item prop="image" label="图片地址">
                <el-input type="text" v-model="ruleForm.image"  placeholder="图片地址,格式: logo.png"></el-input>
              </el-form-item>
              <el-form-item prop="status" label="是否启用">
                <el-switch
                  v-model="ruleForm.status"
                  on-color="#13ce66"
                  off-color="#ff4949">
                </el-switch>
              </el-form-item>

              <el-form-item>
                <el-button  @click="submitForm('ruleForm')" class="btn-form-submit">创建</el-button>
              </el-form-item>
            </el-form>
  </div>
</template>

<script>
export default {
  name: 'linkedit',
  data() {
   return{
      ruleForm: {
        name: '',
        link: '',
        image: '',
        status: true
      },
      rules: {
        name: [
          { required: true, message: '请输入标签名称', trigger: 'blur,change' }
        ],
        link: [
          { required: true, message: '请输入链接地址', trigger: 'blur,change' }
        ],
        image: [
          { required: true, message: '请输入图片地址', trigger: 'blur,change' }
        ]
      }
    }
  },
  methods: {
   // 编辑分类
    submitForm(formName){
      const formData = this.ruleForm;
      this.$refs[formName].validate((valid)=>{
        if(valid){
          this.$http.put(`/admin/link/${this.$route.params.id}`,formData)
            .then(({data})=>{
              if(data.responData.status === 200){
                this.$message({
                  type: 'success',
                  message: data.responData.messages
                });
                return this.$router.go(-1);
              }
            });
        }
      })
    },
    initData(){
      this.$http.get(`/admin/link/${this.$route.params.id}/edit`)
        .then(({data})=>{
          if(data.responData.status === 200){
            this.ruleForm.name = data.responData.link.data.name;
            this.ruleForm.link = data.responData.link.data.link;
            this.ruleForm.image = data.responData.link.data.image;
            this.ruleForm.status = data.responData.link.data.status;
          }
        });
    }
  },
  mounted(){
    this.initData();
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
