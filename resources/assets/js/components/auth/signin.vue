<template>
  <div class="page-content-wrapper member-wrapper">
    <div class="member-left-blk">
      <div class="member-slogan-blk">
        <h2 class="title">中原一游未尽</h2>
        <p class="desc">收藏中原，从登入开始</p>
      </div>
      <div class="member-login-panel">
        <div class="divide-blk">
          <h3 class="title icon-fb-circle">使用 微信帐号登入</h3>
          <a href="javascript:void(0);" class="btn-fb-login" @click="weixinMessage">使用微信登入</a>
          <p class="fb-desc">使用微信登入不用另外注册帐号!!!!</p>
        </div>
        <p class="or-blk"><em class="or">或</em></p>
        <div class="divide-blk last">
          <h3 class="title icon-avatar-circle">使用本站会员帐号登入</h3>
          <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="signin " :label-position="labelPosition"  @submit.native.prevent="submitForm('ruleForm')">
            <el-form-item prop="iphone" label="帐号:">
              <el-input type="text" v-model="ruleForm.iphone"  placeholder="使用手机号码作为登入帐号"></el-input>
            </el-form-item>
            <el-form-item prop="password" label="密码:">
              <el-input type="password" v-model="ruleForm.password" placeholder="密码"></el-input>
            </el-form-item>
            <el-form-item prop="cap" label="验证码">
              <div id="captcha">
                  <canvas id="canvas" width="200" height="50" @click="updateCaptcha"/>
              </div>
              <el-input type="text" v-model="ruleForm.cap"></el-input>
            </el-form-item>
            <el-form-item>
              <el-button  class="btn-form-submit" native-type="submit">登入</el-button>
            </el-form-item>
            <el-form-item>
              <router-link :to="'/forpassword'" class="btn-apply">忘记密码</router-link>
              <router-link :to="'/signup'" class="btn-apply">注册账户</router-link>
            </el-form-item>
          </el-form>
        </div>
      </div>
    </div>
    <!--侧边栏-->
    <sidebar></sidebar>
  </div>
</template>
<script>
import {mapActions} from 'vuex';
import CaptchaCanvas from 'helps/captcha_canvas';
import sidebar from 'components/layout/home/sidebar';
export default {
  components:{
    sidebar
  },
  data() {
      return {
      labelPosition: 'top',
      ruleForm: {
        iphone: '',
        password: '',
        captcha: null,
        cap:''
      },
      rules: {
        iphone: [
          { required: true, message: '请输入正确的手机号', trigger: 'blur,change' },
          { min: 11, max: 12, message: '长度在 11 到 12个字符的手机号', trigger: 'blur,change' }
        ],
        password: [
          { required: true, message: '密码不能为空', trigger: 'blur,change' },
          { min: 6, max: 16, message: '长度在 6 到  16个字符', trigger: 'blur,change' }
        ],
        cap:[
          { required: true, message: '验证码不能为空', trigger: 'blur,change' },
           { min: 4, max: 4, message: '长度在4个字符之间', trigger: 'blur,change' }
        ]
      }
    };
  },
  beforeRouteEnter(to,from,next){
    if(localStorage.getItem('USER_TOKEN')){
      next('/me')
    }else{
      next();
    }
  },
  mounted(){
      this.captcha = new CaptchaCanvas();
      this.captcha.graphicVerification();
  },
  methods: {
    ...mapActions([
      'attempLogin'
    ]),
    updateCaptcha(){
      this.captcha.graphicVerification()
    },
    weixinMessage(){
      this.$notify({
        title: '错误',
        message: '由于微信登入需要营业执照申请接口,所以这块暂时没做!!!',
        type: 'error',
        offset: 250,
        duration: 2000
      });
    },
    submitForm(formName) {
      const {iphone,password,cap} = this.ruleForm;
      let canvasCode = this.captcha.strArray.join("").toLowerCase();
      this.$refs[formName].validate((valid) => {
        if (valid && (cap.toLowerCase() === canvasCode)) {
          this.attempLogin({iphone,password});
        } else {
          this.$confirm('验证码或帐号输入有误', '错误提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning'
          }).then(() => {
            this.captcha.graphicVerification()
          })
          return false;
        }
      });
    }
  }
}
</script>

