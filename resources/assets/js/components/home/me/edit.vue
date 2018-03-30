<template>
  <div class="create">
    <el-row>
      <el-form class="form-container" :model="postForm" :rules="rules" ref="postForm" label-width="100px">
        <el-form-item  label="标题:" prop="title">
          <el-col :span="14">
            <el-input type="text" class="article-textarea" placeholder="请输入内容" v-model="postForm.title">
            </el-input>
          </el-col>
        </el-form-item>
        
        <el-form-item prop="date2" label="时间">
          <el-col :span="14">
              <el-date-picker
                  v-model="postForm.date2"
                  format="yyyy-MM-dd HH:mm:ss"
                  type="datetime"
                  placeholder="选择日期时间">
              </el-date-picker>
          </el-col>
        </el-form-item>
        
        <el-form-item style="margin-bottom: 40px;" label="摘要:" prop="content_short">
          <el-col :span="14">
            <el-input type="textarea" class="article-textarea" :rows="1" autosize placeholder="请输入内容" v-model="postForm.content_short">
            </el-input>
            <span class="word-counter" v-show="contentShortLength">{{contentShortLength}}字</span>
          </el-col>
        </el-form-item>
        <el-form-item label="文章内容" prop="content">
          <el-col :span="24">    
            <Tinymce :height=400 ref="editor" v-model="postForm.content" style="margin-bottom: 40px;"></Tinymce>
          </el-col>
        </el-form-item>
        <el-col :span="12">
          <el-button v-loading="loading" type="success" @click="submitForm" style="width:100%;margin-left:100px;">发布
          </el-button>      
        </el-col>
      </el-form>
    </el-row>
  </div>
</template>
<script>
import Tinymce from 'components/admin/tinymce';
import {mapState,mapGetters} from 'vuex';
import Moment from 'vendor/moment.min.js';
export default {
  name: 'ActiveEventEdit',
  components:{
    Tinymce,
  },
  data(){
    return {
      postForm: {
        title: '', // 文章题目
        content: '', // 文章内容
        content_short: '', // 文章摘要
        date2: ''
      },
      imgTmp: '',
      loading: false,
      rules: {
       title: [{ required: true, message: '标题不能为空', trigger: 'blur,change' }],
        content: [{ required: true, message: '文章内容不能为空', trigger: 'blur,change' }],
        content_short: [{ required: true, message: '内容简介不能为空', trigger: 'blur,change' },
          {min: 1, max: 20, message: '长度在 1 到 20个字符的内容简介', trigger: 'blur,change'}
        ],
        date2: [
          { type: 'date', required: true, message: '请选择时间', trigger: 'blur,change' }
        ],
      }
    }
  },
  created(){
    this.$http.get(`/admin/talent/${this.$route.params.id}/edit`)
      .then(({data})=>{
        if(data.responData.status === 200 ){
          this.postForm.content = data.responData.talent.data.content;
          this.postForm.title = data.responData.talent.data.title;
          this.postForm.content_short = data.responData.talent.data.content_short;
          this.imgTmp = data.responData.talent.data.imgUrl;
        }else{
            this.$message({
            type: data.responData.messages,
            message:err
          });
        }
      });
  },
  computed: {
    ...mapState({
      'imgUrl': state=>state.admin.getUploadImg
    }),
    ...mapGetters([
      'currentUser'
    ]),
    contentShortLength() {
      return this.postForm.content_short.length
    }
  },
  methods:{
    submitForm(){
      var that = this;
      this.$refs.postForm.validate(valid=>{
        if(valid){
          let totalData = {
            'imgUrl': that.imgTmp?that.imgTmp:that.imgUrl[0],
            'user_id': that.currentUser.id,
            'date2': Moment(that.postForm.date2).format('YYYY-MM-DD HH:mm:ss')
          };
          let data =  Object.assign(that.postForm,totalData);
          this.loading = true;
          this.$http.put(`/admin/talent/${this.$route.params.id}`,{params:data})
            .then(({data})=>{
              if(data.responData.status === 200){
                this.$message({
                  type: 'success',
                  message: data.responData.messages
                });
                return this.$router.go(-1);
              }else{
                this.$message({
                  type: 'error',
                  message:data.responData.messages
                });
              }
              this.loading = false;
            }); 
        }else{
          this.$notify({
            title: '输入框不能为空',
            message: '请检查输入!!!!!',
            type: 'info',
            offset: 250,
            duration: 2000
          });
        }
      })
    }
  }
}
</script>
<style lang="scss" scoped>
.create{
  padding: 1.5rem;
  border: 1px solid #ccc;
  border-radius: 4px;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  background-color: #fff; 
}
.word-counter {
    width: 40px;
    position: absolute;
    right: -10px;
    top: 0px;
}
</style>

