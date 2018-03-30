<template>
<div class="card">
            <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="signup">
              <el-form-item prop="name" label="类型名名:">
                <el-input type="text" v-model="ruleForm.name"  placeholder="类型名"></el-input>
              </el-form-item>
              <el-form-item prop="path" label="标签图片路径:">
                <el-input type="text" v-model="ruleForm.path"  placeholder="标签图片路径"></el-input>
              </el-form-item>
              <el-form-item>
                <el-button  @click="submitForm('ruleForm')" class="btn-form-submit">保存</el-button>
              </el-form-item>
            </el-form>
  </div>
</template>

<script>
import {mapGetters} from 'vuex';
export default {
  name: 'categoryedit',
  data() {
   return{
      ruleForm: {
        name: '',
        path: ''
      },
      rules: {
        name: [
          { required: true, message: '请输入类型名称', trigger: 'blur' }
        ]
      }
    }
  },
  methods: {
   // 编辑分类
    submitForm(formName){
      const formData = Object.assign(this.ruleForm,{'creator_id':this.currentUser.id});
      this.$refs[formName].validate((valid)=>{
        if(valid){
          this.$http.put(`/admin/tag/${this.$route.params.id}`,formData)
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
      this.$http.get(`/admin/tag/${this.$route.params.id}/edit`)
        .then(({data})=>{
          if(data.responData.status === 200){
            this.ruleForm.name = data.responData.tag.data.name;
            this.ruleForm.path = data.responData.tag.data.path;
          }
        });
    }
  },
  mounted(){
    this.initData();
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
