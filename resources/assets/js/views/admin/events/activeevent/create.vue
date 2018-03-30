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
        
         <el-form-item  label="主办单位:" prop="sponsor">
          <el-col :span="14">
            <el-input type="text" class="article-textarea" placeholder="请输入内容" v-model="postForm.sponsor">
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
        <el-form-item label="活动区域" prop="region">
          <el-col :span="14">
            <el-select v-model="postForm.region" placeholder="请选择活动区域">
              <el-option :label="item.label" :value="item.value" v-for="(item,key) in eventAddress" :key="key"></el-option>
            </el-select>
          </el-col>
        </el-form-item>
        
        <el-form-item prop="date2" label="活动时间">
          <el-col :span="14">
              <el-date-picker
                  v-model="postForm.date2"
                  type="datetime"
                  format="yyyy-MM-dd HH:mm:ss"
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
        
        <el-form-item label="标签" prop="tags">
          <el-col :span="14">
            <el-select
              v-model="postForm.tags"
              multiple
              filterable
              allow-create
              placeholder="请选择标签" style="width:100%">
              <el-option
                v-for="(item,key) in postForm.tagsAll"
                :key="key"
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
import Moment from 'vendor/moment.min.js';
import {mapState,mapGetters} from 'vuex';
// '114.99077439,28.85911697'
// '114.99001265,28.85896663'
// '114.96660233,28.82711726'
// '115.00548363,28.8694807'
const eventAddress = [{
  label: '邱家街',
  value:'邱家街'
},{
  label: '乡政府广场',
  value:'乡政府广场'
},{
  label: '山坪村',
  value:'山坪村'
},{
  label: '山下村',
  value:'山下村'
}];
export default {
  name: 'ActiveEventCreate',
  components:{
    Tinymce
  },
  data(){
    return {
      eventAddress:eventAddress,
      postForm: {
        title: '', // 文章题目
        content: '', // 文章内容
        content_short: '', // 文章摘要
        region: '',
        date2: '',
        options: [],
        sponsor: '', //主办单位
        pid: {},
        tags: [],
        tagsAll: []
      },
      loading: false,
      rules: {
        title: [{ required: true, message: '标题不能为空', trigger: 'blur,change' }],
        sponsor: [{ required: true, message: '标题不能为空', trigger: 'blur,change' }],
        content: [{ required: true, message: '文章内容不能为空', trigger: 'blur,change' }],
        content_short: [{ required: true, message: '内容简介不能为空', trigger: 'blur,change' },
          {min: 1, max: 20, message: '长度在 1 到 20个字符的内容简介', trigger: 'blur,change'}
        ],
        region: [
          { required: true, message: '请选择活动区域', trigger: 'blur,change' }
        ],
        date2: [
          { type: 'date', required: true, message: '请选择时间', trigger: 'blur,change' }
        ],
        pid:[
          {type:'object', required:true,message:'分类不能为空',trigger:'blur,change'}
        ],
        tags:[
          {type:'array', required: true, message: '请选择标签', trigger: 'blur,change' }
        ]
      }
    }
  },
  computed: {
    ...mapState({
      'imgUrl': state=>state.admin.getUploadImg,
    }),
    ...mapGetters([
      'currentUser'
    ]),
    contentShortLength() {
      return this.postForm.content_short.length
    },
    latitude(){
      switch(this.postForm.region){
        case '邱家街':
          return ['114.99077439','28.85911697'];
          break;
        case '乡政府广场':
          return ['114.99001265','28.85896663'];
          break;
        case '山坪村':
          return ['114.96660233','28.82711726'];
          break;
        case '山下村':
          return ['115.00548363','28.8694807'];
          break;
        default:
          return;
      }
    }
  },
  methods:{
    submitForm(){
      var that = this;
      this.$refs.postForm.validate(valid=>{
        if(valid && that.imgUrl.length>0){
          let totalData = {
            'imgUrl': that.imgUrl[0],
            'latitude': that.latitude,
            'user_id': that.currentUser.id,
            'date2': Moment(that.postForm.date2).format('YYYY-MM-DD HH:mm:ss')
          };
          let data =  Object.assign(that.postForm,totalData);
          this.loading = true;
          this.$http.post('/admin/activeevents',{params:data})
            .then(({data})=>{
              if(data.responData.status === 200 && data.responData.messages){
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
            title: '缺少图片封面',
            message: '请上传最少一个图片封面',
            type: 'info',
            offset: 250,
            duration: 2000
          });
        }
      })
    },
    initData(){
      this.$http.get('/admin/activeevents/create')
        .then(({data})=>{
          if(data.responData.status === 200){
            this.postForm.options = data.responData.categories;
            this.postForm.tagsAll = data.responData.tag;
          }else{
            this.$message({
              type:'error',
              message: data.responData.messages
            });
          }
        });
    },
  },
  mounted(){
    this.initData();
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

