<template>
    <div class="page-content-wrapper member-wrapper">
        <div class="member-left-blk">
            <div class="member-crop">
              <PanThumb :image="imgDataUrl||currentUser.avatar"> 你的权限:
                <span class="pan-info-roles" v-for="(item,index) in getRoles" :key="index">{{item}}</span>
              </PanThumb>
              <el-button type="primary" icon="upload"  @click="toggleShow">修改头像
              </el-button>
            </div>
            <div class="member-login-panel">
                <div class="center-blk">
                    <h3 class="title icon-avatar-circle tal">修改个人资料</h3>
                    <div class="member-form-blk">
                        <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="signup" :label-position="labelPosition">
                            <el-form-item prop="email" label="邮箱:">
                                <el-input type="email" v-model="ruleForm.email"  placeholder="邮箱作为以后找会密码的依据"></el-input>
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
                            <el-form-item  label="选择地区">
                                <v-distpicker @province="selectProvince" @city="selectCity" @area="selectArea"></v-distpicker>
                            </el-form-item>
                            <el-form-item>
                                <el-button  @click="submitForm('ruleForm')" class="btn-form-submit">修改资料</el-button>
                            </el-form-item>
                        </el-form>
                    </div>
                </div>
            </div>
        </div>
        <image-crop-upload field="img"
            @crop-success="cropSuccess"
            @crop-upload-success="cropUploadSuccess"
            @crop-upload-fail="cropUploadFail"
            v-model="show"
            :width="300"
            :height="300"
            url="/admin/me"
            img-format="png">
        </image-crop-upload>
        <sidebar></sidebar>
    </div>
</template>
<script>
    import VDistpicker from 'v-distpicker';
    import {mapActions,mapGetters} from 'vuex';
    import sidebar from 'components/layout/home/sidebar';
    import ImageCropUpload from './upload-2';
    import PanThumb from 'components/admin/PanThumb';
    export default{
      components: {  PanThumb,'image-crop-upload':ImageCropUpload,VDistpicker,sidebar },
      data() {
        return {
          labelPosition: 'top',
          show: false,
		  imgDataUrl: '',
          ruleForm: {
            email: '',
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
            sex: [
                { required: true, message: '请选择性别', trigger: 'change' }
            ],
            username:[
            {required:true,message:'请输入你的姓名',trigger:'blur'},
            {min:2,max:6,message:'长度在3到6个字符之间',trigger:'blur,change'}
            ]
          }
		}
      },
      computed: {
        ...mapGetters([
            'currentUser',
            'getRoles'
        ])
      },
      methods: {
		toggleShow() {
			this.show = !this.show;
	    },
		cropSuccess(imgDataUrl){
			this.$message({
                message: '头像裁剪成功',
                type: 'success'
            });
			this.imgDataUrl = imgDataUrl;
		},
				/**
				 * upload success
				 *
				 * [param] jsonData  server api return data, already json encode
				 * [param] field
				 */
		cropUploadSuccess(jsonData){
            this.$alert(`文件大小:${jsonData.data.result.size}`, '上传成功', {
                confirmButtonText: '确定',
                callback: action => {
                    this.$message({
                        type: 'info',
                        message: `图片地址: ${jsonData.data.result.real_path}`
                    });
                    this.imgDataUrl = jsonData.data.result.url;
                }
            });
		},
				/**
				 * upload fail
				 *
				 * [param] status    server api return error status, like 500
				 * [param] field
				 */
		cropUploadFail(status){
            this.$message({
                message: status,
                type: 'error'
            });
			// console.log(status);
		},
        submitForm(formName){
          const user = this.ruleForm;
          this.$refs[formName].validate((valid)=>{
            if(valid){
                this.$http.put(`/admin/me/${this.currentUser.id}`,user)
                    .then((res)=>{
                        if(res.status === 200 || res.status === 201)
                        {
                            this.$alert('修改成功', {
                                confirmButtonText: '确定',
                                callback: action => {
                                    this.$router.push({path: '/'});
                                }
                            });
                        }
                    }).catch(err=>{
                        this.$alert('修改失败即将退出', {
                            confirmButtonText: '确定',
                            callback: action => {
                                this.$message({
                                    type: 'error',
                                    message: '修改失败'
                                });  
                            }
                        });
                    });
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

<style rel="stylesheet/scss" lang="scss" scoped>
.member-crop
{
    width: 280px;
    margin: 0px auto;
    padding: 15px 0px;
    border-bottom: 1px solid #ff9b74;
}
</style>
