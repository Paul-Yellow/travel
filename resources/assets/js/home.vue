<template>
  <div class="wrapper">
    <div id="nb-global-spinner" class="spinner" :style="!isLoading ? 'display:none' : '' ">
           <div class="blob blob-0"></div>
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
            <div class="blob blob-3"></div>
            <div class="blob blob-4"></div>
            <div class="blob blob-5"></div>
    </div>
    <transition class="fade">
        <router-view></router-view>
    </transition>
    <feed-back></feed-back>
    <BackTop :defaultProps="55" :date="1000" :color="'#FF7F50'"></BackTop>
  </div>
</template>
<script>
import BackTop from 'components/backtop';
import FeedBack from 'components/common/Feedback';
import {mapState} from 'vuex';
export default {
  name: 'home',
  components:{
      BackTop,
      FeedBack
  },
  mounted(){
    let elm = document.querySelector('body > #nb-global-spinner');
    if(elm){
      elm.setAttribute('style','display:none');
    }
  },
  computed:{
    ...mapState({
        error: state=>state.auth.message.error,
        success: state=>state.auth.message.success,
        validation: state=>state.auth.message.validation,
        isLoading: state=>state.auth.loadingStatus
    })
  },
  watch:{
    error(val){
      if(val){
         this.$message({
            type: 'error',
            message: val
        });
      }
    },
    success(val){
      if(val){
        this.$message({
          type:'success',
          message:val
        });
      }
    },
    validation(val){
      if(val){
        this.$message({
          type:'info',
          message:val
        });
      }
    }
  }
}
</script>
