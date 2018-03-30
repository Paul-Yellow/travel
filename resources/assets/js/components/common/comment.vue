<template>
  <div class="comment" style="clear:both" v-if="list">
    <el-row style="margin-top:1.125rem" v-if="isLogged">
       <el-col :span="24" style="margin-top:1.125rem">
        <h4>评论</h4>
        <el-input
          type="textarea"
          :rows="2"
          placeholder="请输入内容"
          v-model="content">
        </el-input>
       </el-col>
        <el-col :span="24" style="margin-top:1.125rem">
          <el-button @click="onCancel">取消</el-button>
          <el-button type="primary" @click="submitComment" v-if="content.trim().length>0">评论</el-button>
          <el-button type="primary" @click="submitComment" v-else disabled>评论</el-button>
        </el-col>
      </el-row>
      <h4 v-else>登入后才能评论</h4>
      <el-row style="margin-top: 1.125rem;background-color: #fff;padding: 1.2rem;" >
        <el-col :span="20">
          <el-col :span="24" v-for="(item,index) in list" :key="index" class="comment_list" style="margin-top:1.125rem;border-bottom:1px solid #666;padding-bottom:.625rem;">
            <avatar :user="item.user" style="float:left"></avatar>
            <time style="
              float: left;
              color: #908f8f;
              position: relative;
              left: -40px;
              top: 0px;">{{item.date_time}}</time>
            <div class="content" style="float:left;.6em">
              {{item.content}}
              <div class="comment-footer">
                <vote-button :item="item" api="/admin/me/voters/comment"></vote-button>
              </div>
            </div>
          </el-col>
        </el-col>
      </el-row>
  </div>
</template>
<script>
import {mapGetters} from 'vuex';
import Avatar from "components/common/Avatar";
import VoteButton from "components/common/VoteButton";
export default {
  data(){
    return{
      content: ''
    }
  },
  components:{
    Avatar,
    VoteButton
  },
  props:{
    list:{
      type:Array,
      default(){
        return []
      }
    },
    api: {
      type: String,
      required: true
    }
  },
  methods:{
    submitComment(){
      let data = {content:this.content};
      this.$http.post(`/admin/${this.api}/${this.$route.params.id}/comment`,data)
        .then(({data})=>{
          if(data.responData.status === 200){
            this.content = '';
            this.list.push(data.responData.comment);
            this.$message({
              type:'success',
              message: data.responData.messages
            });
          }else{
            this.$message({
              type:'warn',
              message: data.responData.messages
            });
          }
        });
    },
    onCancel(){
      this.content = '';
    }
  },
  watch:{
    list(items){
      if(items){
        items.forEach((item) =>{
          item.content = item.content
        });
        return items;
      }
    }
  },
  computed: {
    ...mapGetters(['isLogged'])
  }
}
</script>

