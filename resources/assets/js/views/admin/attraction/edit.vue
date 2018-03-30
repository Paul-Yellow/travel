<template>
  <div class="create">
    <el-row>
      <el-form class="form-container" :model="postForm" :rules="rules" ref="postForm" label-width="100px">
        <el-form-item  label="景点标题:" prop="title">
          <el-col :span="14">
            <el-input type="text" class="article-textarea" placeholder="请输入内容" v-model="postForm.title">
            </el-input>
          </el-col>
        </el-form-item>
      
         <el-form-item prop="pid" label="所属分类:">
          <el-col :span="14">
             <el-select v-model="postForm.pid" placeholder="请选择分类"  value-key="id">
                <el-option v-for="(item,key) in postForm.options" :key="key" :label="item.pid === 0 ? item.name+'('+'父级分类:'+'pid='+ item.pid + ')' : item.name+'('+'子级分类:'+'pid='+ item.pid + ')' "  :value="item">
                </el-option>
              </el-select>
          </el-col>
        </el-form-item>
        
        <el-form-item prop="date2" label="发布时间">
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
        <el-form-item label="景点内容" prop="content">
          <el-col :span="24">    
            <Tinymce :height=400 ref="editor" v-model="postForm.content" style="margin-bottom: 40px;"></Tinymce>
          </el-col>
        </el-form-item>
        
        <el-form-item label="标签" prop="tags">
          <el-col :span="14">
            <el-select
              v-model="postForm.tags"
              multiple
              filterable
              allow-create
              placeholder="请选择标签" style="width:100%">
              <el-option
                v-for="item in postForm.tagsAll"
                :key="item.id"
                :label="item.name"
                :value="item.id">
              </el-option>
            </el-select>
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
  name: 'attractionCreate',
  components:{
    Tinymce,
  },
  data(){
    return {
      postForm: {
        title: '', // 文章题目
        content: '', // 文章内容
        content_short: '', // 文章摘要
        date2: '',
        options: [],
        pid: {},
        tags: [],
        tagsAll: [
        ]
      },
      imgTmp: '',
      loading: false,
      rules: {
        title: [{ required: true, message: '店家名字不能为空', trigger: 'blur,change' }],
       content: [{ required: true, message: '文章内容不能为空', trigger: 'blur,change' }],
        content_short: [{ required: true, message: '内容简介不能为空', trigger: 'blur,change' },
          {min: 1, max: 20, message: '长度在 1 到 20个字符的内容简介', trigger: 'blur,change'}
        ],
        date2: [
          { type: 'date', required: true, message: '请选择时间', trigger: 'blur,change' }
        ],
        pid:[
          {type:'object',required:true,message:'分类不能为空',trigger:'blur,change'}
        ],
        tags:[
          {type:'array', required: true, message: '请选择标签', trigger: 'blur,change' }
        ]
      }
    }
  },
  created(){
    this.$http.get(`/admin/attraction/${this.$route.params.id}/edit`)
      .then(({data})=>{
        if(data.responData.status === 200 ){
          this.postForm.content = data.responData.data.data.content;
          this.postForm.title = data.responData.data.data.title;
          this.postForm.pid = Object.assign({},{id:data.responData.data.data.id,name:data.responData.data.data.category_name,pid:data.responData.data.data.category_id});
          this.postForm.options = data.responData.category.data;
          this.postForm.tagsAll = data.responData.tagAll;
          this.postForm.content_short = data.responData.data.data.content_short;
          this.imgTmp = data.responData.data.data.imgUrl;
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
          this.$http.put(`/admin/attraction/${this.$route.params.id}`,{params:data})
            .then(({data})=>{
              if(data.responData.status === 200){
                this.$message({
                  type: 'success',
                  message: data.responData.messages
                });
                return this.$router.go(-1);
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

