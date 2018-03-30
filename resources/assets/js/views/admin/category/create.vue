<template>
<div class="card">
            <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="signup">
              <el-form-item prop="name" label="类型名名:">
                <el-input type="text" v-model="ruleForm.name"  placeholder="类型名"></el-input>
              </el-form-item>
              <el-form-item prop="pid" label="类型层级:">
                  <el-select v-model.number="ruleForm.pid" placeholder="请选择分类">
                    <el-option :value="0" :label="'顶层分类'">
                    </el-option>
                    <el-option v-for="(item,key) in ruleForm.options" :key="key" :label="item.name+'('+'父级分类:'+'pid:'+ item.pid + ')' " :value="item.id">
                    </el-option>
                  </el-select>
              </el-form-item>
              <el-form-item prop="desc" label="描述:">
                <el-input type="text" v-model="ruleForm.desc" placeholder="描述"></el-input>
              </el-form-item>
              <el-form-item prop="path" label="路径">
                <el-input type="text" v-model="ruleForm.path" placeholder="路径"></el-input>
              </el-form-item> 
              <el-form-item>
                <el-button  @click="submitForm('ruleForm')" class="btn-form-submit">创建</el-button>
              </el-form-item>
            </el-form>
  </div>
</template>

<script>
export default {
  name: 'categorycreate',
  data() {
    return{
      ruleForm: {
        name: '',
        desc: '',
        path: '',
        pid: null,
        options: []
      },
      rules: {
        name: [
          { required: true, message: '请输入类型名称', trigger: 'blur,change' }
        ],
        desc:[
          {required:true,message:'请输入说明信息',trigger:'blur,change'}
        ],
        pid:[
          {type:'number', required:true,message:'请输入层级信息',trigger:'blur,change'}
        ]
      }
    }
  },
  methods: {
    // 添加分类
    submitForm(formName){
      const formData = this.ruleForm;
      this.$refs[formName].validate((valid)=>{
        if(valid){
          this.$http.post(`/admin/category`,formData)
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
      this.$http.get('/admin/category/create')
        .then(({data})=>{
          if(data.responData.status === 200){
            this.ruleForm.options = data.responData.categories;
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
