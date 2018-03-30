<template>
    <div class="dashboard-editor-container">
        <div class="header-count">
            <PanThumb :image="currentUser.avatar || '' "> 你的权限:
                <span class="pan-info-roles" v-for="item in getRoles" :key="item.id">{{item}}</span>
            </PanThumb>
            <div class="info-container">
                <span class="display_name">{{currentUser.name}}</span>
                <div class="info-wrapper">
                    <div class="info-item" :to="'/article/wscnlist?uid='">
                         <countTo class="info-item-num" :startVal='0' :endVal='currentUser.post_count' :duration='3400'></countTo>
                        <span class="info-item-text">发布文章量</span>
                    
                    </div>
                    <div class="info-item" style="cursor: auto">
                        <countTo class="info-item-num"  :startVal='0' :endVal='currentUser.credit_count' :duration='3600'></countTo>
                        <span class="info-item-text">文章热度</span>
                      
                    </div>
                    <!-- <div class="info-item" :to="'/comment/commentslist?res_author_id='">
                         <countTo class="info-item-num" ref='countTo3' :startVal='0' :endVal='statisticsData.comment_count' :duration='3800'></countTo>
                        <span class="info-item-text">评论</span>
                    </div> -->
                </div>
            </div>
        </div>
        <div class=" main-dashboard-container el-row">
            <div class="chart-container el-col el-col-16">
                <MonthKpi style="border-bottom: 1px solid #DEE1E2;"
                          :articlesComplete='statisticsData.month_article_count'></MonthKpi>
                <ArticlesChart :listData='statisticsData.week_article'></ArticlesChart>
            </div>
           <div class="upload-sidebar el-col el-col-8">
               <el-upload
                    class="upload-demo"
                    action="/admin/dashborde"
                    :on-preview="handlePreview"
                    :multiple="true"
                    :show-file-list="true"
                    :on-remove="handleRemove"
                    :drag="true"
                    :file-list="fileList2"
                    :before-upload="beforeSlideUpload"
                    list-type="picture"
                    :http-request="uploadSlide">
                    <el-button size="small" type="primary">点击上传轮播图</el-button>
                    <div slot="tip" class="el-upload__tip">只能上传jpg/png/gif文件，且不超过2MB,预览管理轮播图</div>
                </el-upload>
           </div>
        </div>
        <!-- 测试权限按钮 -->
        <el-button v-permission="'permission-btn'">权限测试按钮</el-button>
        
        <el-dialog title="查看轮播图" v-model="dialogVisible" size="large">
            <img class="pan-img" :src="ewizardClap" style="width:100%;height:auto;">
        </el-dialog>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    import PanThumb from 'components/admin/PanThumb';
    import MonthKpi from './monthKpi';
    import ArticlesChart from './articlesChart';
    import countTo from 'vue-count-to';
    export default {
      name: 'dashboard-editor',
      components: { PanThumb, MonthKpi, ArticlesChart, countTo },
      data() {
        return {
          chart: null,
          statisticsData: {
            // article_count: 1024,
            // comment_count: 102400,
            latest_article: [],
            month_article_count: 28,
            pageviews_count: 1024,
            week_article: [
               { count: 30, week: '20              console.log(err);1716' },
                { count: 26, week: '201715' },
                { count: 31, week: '201714' },
                { count: 28, week: '201713' },
                { count: 40, week: '201712' },
                { count: 41, week: '201711' },
                { count: 50, week: '201710' },
                { count: 42, week: '201709' },
                { count: 36, week: '201708' },
                { count: 32, week: '201707' },
                { count: 40, week: '201706' },
                { count: 41, week: '201705' }
            ]
          },
          ewizardClap: '',
          dialogVisible:false,
          fileList2: []
        }
      },
      computed: {
        ...mapGetters([
          'currentUser',
          'getRoles'
        ]),
       
      },
      created(){
        this.initData();
      },
      methods: {
        initData(){
            this.$http.get('/admin/dashborde')
            .then((res)=>{
                if(res.status=== 200 && res.data.data){
                    this.fileList2 = res.data.data;
                }else{
                    this.fileList2 = [];    
                }
            });
        },
        beforeSlideUpload(file) {
            const isJPG = file.type === 'image/jpeg' || file.type === 'image/png' || file.type === 'image/gif';
            const isLt2M = file.size / 1024 / 1024 < 2;

            if (!isJPG) {
            this.$message.error('上传图片只能是 JPG或png或gif格式!');
            }
            if (!isLt2M) {
            this.$message.error('上传图片大小不能超过 2MB! ');
            }
            return isJPG && isLt2M;
        },
        handleRemove(file) {
            const {id} = file;
            this.$http.delete(`/admin/dashborde/${id}`)
                .then((res)=>{
                    if(res.status === 200)
                    {
                        this.$message({
                            type: 'success',
                            message: '删除成功'
                        });
                        this.initData();
                    }
                });
        },
        handlePreview(file) {
           this.dialogVisible = true;
           this.ewizardClap = file.url;
        },
        uploadSlide(request){
            let formData = new FormData();
            formData.append('file',request.file);
            formData.append('author',this.currentUser.name);
            this.$http.post(request.action,formData)
                .then((res)=>{
                    if(res.status === 200 && res.data.result.success){
                        this.$message({
                            type: 'success',
                            message: '上传成功'
                        });
                        this.initData();  
                    }
                });
        }
      }
    }
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
    .header-count{
        display: flex;
        flex-direction: row;
        -moz-flex-direction: row;
        -webkit-flex-direction: row;
        flex-wrap: wrap;
        -moz-flex-wrap: wrap;
        -webkit-flex-wrap: wrap;
        justify-content: space-between;
        -moz-justify-content: space-between;
        -webkit-justify-content: space-between;
    }
    .recent-articles-emptyTitle {
        font-size: 16px;
        color: #95A5A6;
        padding-top: 20px;
        text-align: center;
    }

    .dashboard-editor-container {
        padding: 30px 50px;
        .pan-info-roles {
            font-size: 12px;
            font-weight: 700;
            color: #333;
            display: block;
        }
        .info-container {
            padding-top: 18px;
            .display_name {
                font-size: 48px;
                line-height: 48px;
                color: #212121;
            }
            .info-wrapper {
                line-height: 40px;
                .info-item {
                    cursor: pointer;
                    display: inline-block;
                    margin-right: 95px;
                    .info-item-num {
                        color: #212121;
                        font-size: 24px;
                        display: inline-block;
                        padding-right: 5px;
                    }
                    .info-item-text {
                        color: #727272;
                        font-size: 14px;
                        padding-right: 5px;
                        display: inline-block;
                    }
                }
            }
            .dashboard-editor-icon {
                width: 22px;
                height: 22px;
            }
        }

        .btn-group {
            margin: 30px 36px 30px 0;
        }
        .main-dashboard-container {
            width: 100%;
            position: relative;
            border: 1px solid #DEE1E2;
            padding: 0 10px;
        }
        .chart-container {
            position: relative;
            padding-right: 10px;
            border-right: 1px solid #DEE1E2;
        }
        .recent-articles-container {
            padding: 12px 12px 0px;
            position: relative;
            .recent-articles- {
                &title {
                    font-size: 16px;
                    color: #95A5A6;
                    letter-spacing: 1px;
                    padding-left: 15px;
                    padding-bottom: 10px;
                    border-bottom: 1px solid #DEE1E2;
                }
                &more {
                    color: #2C3E50;
                    font-size: 12px;
                    float: right;
                    margin-right: 25px;
                    line-height: 40px;
                    &:hover {
                        color: #3A71A8;
                    }
                }
                &wrapper {
                    padding: 0 20px 0 22px;
                    .recent-articles- {
                        &item {
                            cursor: pointer;
                            padding: 16px 100px 16px 16px;
                            border-bottom: 1px solid #DEE1E2;
                            position: relative;
                            &:before {
                                content: "";
                                height: 104%;
                                width: 0px;
                                background: #30B08F;
                                display: inline-block;
                                position: absolute;
                                opacity: 0;
                                left: 0px;
                                top: -2px;
                                transition: 0.3s ease all;
                            }
                            &:hover {
                                &:before {
                                    opacity: 1;
                                    width: 3px;
                                }
                            }
                        }
                        &status {
                            font-size: 12px;
                            display: inline-block;
                            color: #9B9B9B;
                            padding-right: 6px;
                        }
                        &content {
                            font-size: 13px;
                            color: #2C3E50;
                            &:hover {
                                color: #3A71A8;
                            }
                        }
                        &time {
                            position: absolute;
                            right: 16px;
                            top: 16px;
                            color: #9B9B9B;
                        }
                    }
                }
            }

        }
    }
</style>
