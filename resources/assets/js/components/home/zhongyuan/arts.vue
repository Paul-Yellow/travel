<template>
  <div>
    <div class="unit-title-blk bg-slash">
      <Breadcrumb class="breadcrumb"></Breadcrumb>
      <h2 class="unit-title icon-unit-play">人文艺术</h2>
    </div>
     <div class="page-content-wrapper member-wrapper">
      <div class="content-left-blk">
        <div class="news-detail-blk">
          <div class="manual-script-blk static-script-blk">
            <h3 class="static-title">民风纯朴</h3>
            <p class="static-desc"> 中原的民风极为纯朴, 民众特别好客.</p>
          </div>
          <div class="manual-script-blk static-script-blk">
            <h3 class="static-sub-title">民众图集</h3>
            <h4 class="static-title">图集</h4>
            <sub class="static-desc shine">图集</sub>
            <p class="static-desc">
              纯朴的民众
            </p>
            <div class="col">
              <img class="static-img" src="/images/fengmian/cun.jpg" alt="纯朴的民众">
              <span class="static-img-alt">纯朴的民众</span>
            </div>
            <br>
            <h4 class="static-title">图集</h4>
            <sub class="static-desc shine">图集</sub>
            <p class="static-desc">
              纯朴的民众
            </p>
            <div class="col">
              <img class="static-img" src="/images/fengmian/cun1.jpg" alt="纯朴的民众">
              <span class="static-img-alt">纯朴的民众</span>
            </div>
          </div>
        </div>
        <div class="page-func-blk"> <a href="javascript:void(0);" class="btn-page-direction" title="回前页" @click="backPages">回前页</a> </div>
      </div>
      <!--侧边栏  -->
      <sidebar></sidebar>
    </div>
  </div>
</template>
<script>
import Breadcrumb from 'components/layout/breadcrumb';
import sidebar from 'components/home/zhongyuan/sidebar';
export default {
  name: 'arts',
  components:{
    Breadcrumb,
    sidebar
  },
  methods:{
    backPages(){
      return this.$router.go(-1);
    }
  }
}
</script>