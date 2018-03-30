<template>
  <div>
    <div class="unit-title-blk bg-slash">
      <Breadcrumb class="breadcrumb"></Breadcrumb>
      <h2 class="unit-title icon-unit-accommodation">{{$route.name}}</h2>
    </div>
    <div class="page-content-wrapper member-wrapper">
      <div class="content-left-blk">
        <h1 style=""><a href="/images/minpaku_leaf_chn.pdf" target="_blank" title="点我查看住宿安全手册" class="click-show">点我查看住宿安全手册</a></h1>
        <div class="page-func-blk"> <a href="javascript:void(0);" class="btn-page-direction" title="回前页" @click="backPages">回前页</a> </div>
      </div>
      <slide-bar></slide-bar>
    </div>
  </div>
</template>
<script>
import Breadcrumb from 'components/layout/breadcrumb';
import Slidebar from './slide';
export default {
  components:{
    Breadcrumb,
    'slide-bar':Slidebar
  },
  methods:{
    backPages(){
      return this.$router.go(-1);
    }
  }
}
</script>
<style lang="scss" scoped>
.click-show{
    display: flex;
    padding: 18rem 0rem;
    justify-content: center;
    -webkit-justify-content: center;
    -moz-justify-content: center;
    align-items: center;
    -webkit-align-items: center;
    -moz-align-items: center;
}
</style>

