<template>
<div class="card">
            <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="signup">
              <el-form-item prop="name" label="标签名称:">
                <el-input type="text" v-model="ruleForm.name"  placeholder="标签名称"></el-input>
              </el-form-item>
              <el-form-item prop="path" label="标签图片路径:">
                <el-input type="text" v-model="ruleForm.path"  placeholder="标签图片路径"></el-input>
              </el-form-item>
              <el-form-item>
                <el-button  @click="submitForm('ruleForm')" class="btn-form-submit">创建</el-button>
              </el-form-item>
            </el-form>
  </div>
</template>

<script>
import {mapGetters} from 'vuex';
export default {
  name: 'tagcreate',
  data() {
    return{
      ruleForm: {
        name: '',
        path: ''
      },
      rules: {
        name: [
          { required: true, message: '请输入标签名称', trigger: 'blur,change' }
        ]
      }
    }
  },
  methods: {
    // 添加分类
    submitForm(formName){
      const formData = Object.assign(this.ruleForm,{'creator_id':this.currentUser.id});
      this.$refs[formName].validate((valid)=>{
        if(valid){
          this.$http.post(`/admin/tag`,formData)
            .then(({data})=>{
              if(data.responData.status === 200){
                this.$message({
                  type: 'success',
                  message: data.responData.messages
                });
                return this.$router.go(-1);
              };
            });
        }
      })
    }
  },
  computed:{
    ...mapGetters([
      'currentUser'
    ])
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
