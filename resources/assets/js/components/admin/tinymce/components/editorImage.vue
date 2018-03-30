<template>
    <div class="upload-container">
        <el-button icon='upload' :style="{background:color,borderColor:color}" @click=" dialogVisible=true" type="primary">上传图片
        </el-button>
        <el-dialog :visible.sync="dialogVisible">
            <el-upload
                    class="editor-slide-upload"
                    action="/admin/uploadimg"
                    :multiple="true"
                    :file-list="fileList"
                    :show-file-list="true"
                    list-type="picture-card"
                    :on-remove="handleRemove"
                    :before-upload="beforeUpload"
                    :http-request="uploadImg">
                <el-button size="small" type="primary">点击上传</el-button>
            </el-upload>
            <el-button @click="dialogVisible = false">取 消</el-button>
            <el-button type="primary" @click="handleSubmit">确 定</el-button>
        </el-dialog>
    </div>
</template>
<script>
    import { mapGetters,mapActions } from 'vuex';
  // 由于七牛云配置太麻烦了。所以还是上传到本地;
    export default {
      name: 'editorSlideUpload',
      props: {
        color: {
          type: String,
          default: '#20a0ff'
        }
      },
      computed: {
        ...mapGetters([
          'currentUser'
        ]),
       
      },
      data() {
        return {
          dialogVisible: false,
          fileList: []
        };
      },
      methods: {
        ...mapActions([
          'getUploadImg'
        ]),
        handleSubmit() {
          const arr = this.fileList.map(v => v.url);
          this.getUploadImg(arr);
          this.$emit('successCBK', arr);
          this.fileList = [];
          this.dialogVisible = false;
        },
        handleRemove(file) {
          let url = file.url;
          let id = file.id;
          this.$http.delete(`/admin/uploadimg/${id}`)
            .then((res)=>{
              if(res.status === 200){
                this.$message({
                  type: 'success',
                  message: '删除成功'
                });
                this.fileList.pop({url:url});
              }
            });
        },
        uploadImg(request){
          let formData = new FormData();
          formData.append('file',request.file);
          //当前上传的用户名
          formData.append('author',this.currentUser.name);
          this.$http.post(request.action,formData)
            .then((res)=>{
              if(res.status === 200 && res.data.responData.status === 200){
                this.$message({
                  type: 'success',
                  message: '上传成功'
                });
                this.fileList.push({id:res.data.data.id,url:res.data.data.url,author:res.data.data.author});
              }
            });
        },
        beforeUpload(file) {
           const isJPG = file.type === 'image/jpeg' || file.type === 'image/png' || file.type === 'image/gif';
            const isLt2M = file.size / 1024 / 1024 < 2;

            if (!isJPG) {
            this.$message.error('上传图片只能是 JPG或png或gif格式!');
            }
            if (!isLt2M) {
            this.$message.error('上传图片大小不能超过 2MB! ');
            }
            return isJPG && isLt2M;
        }
      }
    };
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
    .upload-container {
        .editor-slide-upload {
            margin-bottom: 20px;
        }
    }
</style>
