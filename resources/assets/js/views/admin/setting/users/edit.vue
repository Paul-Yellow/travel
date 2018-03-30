<template>
<div class="card">
            <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="signup">
              <el-form-item prop="email" label="邮箱:">
                <el-input type="email" v-model="ruleForm.email"  placeholder="邮箱作为以后找会密码的依据"></el-input>
              </el-form-item>
              <el-form-item label="性别" prop="sex">
                <el-radio-group v-model="ruleForm.sex">
                  <el-radio label="先生" name="sex"></el-radio>
                  <el-radio label="女士" name="sex"></el-radio>
                </el-radio-group>
              </el-form-item>
               <el-form-item label="角色" prop="roles">
                <el-radio-group v-model="ruleForm.roles" class="inline-radio" >
                  <p v-for="(item,key) in rolesData" :key="key">
                    <el-radio :label="item.id"  name="roles">{{item.name}}</el-radio>
                    <el-tag @click.native="onShowPermission(item.id)" style="cursor:pointer">查看权限</el-tag>
                  </p>
                </el-radio-group>
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
              <el-form-item prop="username" label="姓名:">
                <el-input type="text" v-model="ruleForm.username" placeholder="你的姓名"></el-input>
              </el-form-item>
              <el-form-item prop="iphone" label="手机号码:">
                <el-input type="text" v-model="ruleForm.iphone" placeholder="你的手机号码"></el-input>
              </el-form-item>
              <el-form-item>
                <el-button  @click="submitForm('ruleForm')" class="btn-form-submit">保存</el-button>
              </el-form-item>
            </el-form>

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
					<el-tag type="primary" class="tags-module" :key="key">模块: {{key}}</el-tag>
					<el-tag type="success" class="tags" v-for="v in item" :key="v.id">{{v.name}}</el-tag>
      </template>
      <span slot="footer" class="dialog-footer">
        <el-button type="primary" @click="dialogVisible = false">确 定</el-button>
      </span>
    </el-dialog>
  </div>
</template>

<script>
export default {
  name: 'usercreate',
  data() {
    return{
      rolesData: [],
      permissionsData: [],
      showData: {},
      dialogVisible:false,
      ruleForm: {
        email: '',
        sex: '',
        username: '',
        iphone: '',
        permissions: [],
        roles:1
      },
      rules: {
        email: [
          { required: true, message: '请输入正确的账户名，账户名不能为空', trigger: 'blur' },
          { type: 'email', message: '请输入正确的邮箱地址', trigger: 'blur,change' }
        ],
        sex: [
            { required: true, message: '请选择性别', trigger: 'change' }
        ],
        username:[
          {required:true,message:'请输入你的姓名',trigger:'blur'},
          {min:2,max:6,message:'长度在3到6个字符之间',trigger:'blur,change'}
        ],
        iphone:[
          {required:true,message:'请输入你的手机号码',trigger:'blur'},
          {min:11,max:12,message:'长度在11到12个字符之间',trigger:'blur,change'}
        ]
      }
    }
  },
  methods: {
    // 编辑用户
    submitForm(formName){
      const formData = this.ruleForm;
      this.$refs[formName].validate((valid)=>{
        if(valid){
          this.$http.put(`/admin/users/${this.$route.params.id}`,formData)
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
      this.$http.get('/admin/users/'+id+'/edit')
      .then(({data})=>{
        if(data.roles.length >0 && data.permissions.length >0){
          // roles 跟permission数据
          this.rolesData = data.roles;
          this.permissionsData = data.permissions;
          // 设置用户的数据值
          this.ruleForm.sex = data.responData.user.data.sex;
          this.ruleForm.username = data.responData.user.data.name;
          this.ruleForm.iphone = data.responData.user.data.iphone;
          this.ruleForm.email = data.responData.user.data.email;
          this.ruleForm.roles = data.responData.rolesId[0];
        }else{
          this.$message({
            type: 'error',
            message:'空的数据'
          });
        }
      });
    },
    // 显示角色权限
    onShowPermission(id) {
      // 查看角色对应的权限s
      this.$http.get(`/admin/role/${id}`)
        .then((res)=>{
            if(res.status === 200 && res.data){
              this.dialogVisible = true;
              this.showData = res.data.responData.results;
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
.inline-radio{
  display: inline-flex;
  flex-direction: row;
  flex-wrap: nowrap;
  justify-content: space-around;
  -webkit-flex-direction: row;
  -webkit-flex-wrap: nowrap;
  -webkit-justify-content: space-around;
  -moz-flex-direction: row;
  -moz-flex-wrap: nowrap;
  -moz-justify-content: space-around;
  >p{
    padding: 0rem .6rem;
  }
}
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
