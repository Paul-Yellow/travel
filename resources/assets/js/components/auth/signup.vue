<template>
  <div class="page-content-wrapper member-wrapper">
    <div class="member-left-blk">
      <div class="member-slogan-blk">
        <h2 class="title">中原一遊未盡</h2>
        <p class="desc">申請會員，開始收藏中原</p>
      </div>
      <div class="member-login-panel">
        <div class="center-blk">
          <h3 class="title icon-avatar-circle">加入中原旅游网</h3>
          <div class="member-form-blk">
            <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="signup" :label-position="labelPosition">
              <el-form-item prop="email" label="邮箱:">
                <el-input type="email" v-model="ruleForm.email"  placeholder="邮箱作为以后找会密码的依据"></el-input>
              </el-form-item>
              <el-form-item prop="password" label="密码:">
                <el-input type="password" v-model="ruleForm.password" placeholder="密码最少6位数"></el-input>
              </el-form-item>
              <el-form-item prop="checkPass" label="再次输入密码:">
                <el-input type="password" v-model="ruleForm.checkPass" placeholder="密码最少6位数"></el-input>
              </el-form-item>
              <el-form-item label="性别" prop="sex">
                <el-radio-group v-model="ruleForm.sex">
                  <el-radio label="先生"></el-radio>
                  <el-radio label="女士"></el-radio>
                </el-radio-group>
              </el-form-item>
              <el-form-item prop="username" label="姓名:">
                <el-input type="text" v-model="ruleForm.username" placeholder="你的姓名"></el-input>
              </el-form-item>
              <el-form-item prop="iphone" label="手机号码:">
                <el-input type="text" v-model="ruleForm.iphone" placeholder="你的手机号码"></el-input>
              </el-form-item>
              <el-form-item  label="选择地区">
                <v-distpicker @province="selectProvince" @city="selectCity" @area="selectArea"></v-distpicker>
              </el-form-item>
              <el-form-item>
                <el-button  @click="submitForm('ruleForm')" class="btn-form-submit">申請會員</el-button>
              </el-form-item>
            </el-form>
          </div>
        </div>
      </div>
    </div>
    <sidebar></sidebar>
  </div>
</template>
<script>
import VDistpicker from 'v-distpicker';
import {mapActions} from 'vuex';
import Sidebar from 'components/layout/home/sidebar';
export default {
  name: 'signup',
  components:{
    VDistpicker,
    Sidebar
  },
  data() {
    const validatePass = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('请输入密码'));
        } else {
          if (this.ruleForm.checkPass !== '') {
            this.$refs.ruleForm.validateField('checkPass');
          }
          callback();
        }
      };
      const validatePass2 = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('请再次输入密码'));
        } else if (value !== this.ruleForm.password) {
          callback(new Error('两次输入密码不一致!'));
        } else {
          callback();
        }
      };
    return{
      labelPosition: 'top',
      // select: { province: '', city: '', area: '' },
      ruleForm: {
        email: '',
        password: '',
        checkPass: '',
        sex: '',
        username: '',
        iphone: '',
        province: '', 
        city: '', 
        area: ''
      },
      rules: {
        email: [
          { required: true, message: '请输入正确的账户名，账户名不能为空', trigger: 'blur' },
          { type: 'email', message: '请输入正确的邮箱地址', trigger: 'blur,change' }
        ],
        password: [
          { validator: validatePass, trigger: 'blur' },
          { min: 6, max: 16, message: '长度在 6 到  16个字符', trigger: 'blur,change' }
        ],
        checkPass: [
          {validator: validatePass2, trigger: 'blur'},
          { min: 6, max: 16, message: '长度在 6 到  16个字符', trigger: 'blur,change' }
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
    ...mapActions([
      'register'
    ]),
    submitForm(formName){
      const user = this.ruleForm;
      this.$refs[formName].validate((valid)=>{
        if(valid){
          this.register(user);
        }
      })
    },
    selectProvince(value) {
      this.ruleForm.province = value
    },
    selectCity(value) {
      this.ruleForm.city = value
    },
    selectArea(value) {
      this.ruleForm.area = value
    }
  }
}
</script>
