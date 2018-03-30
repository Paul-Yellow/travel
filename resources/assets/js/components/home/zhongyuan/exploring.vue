<template>
  <div>
    <div class="unit-title-blk bg-slash">
      <Breadcrumb class="breadcrumb"></Breadcrumb>
      <h2 class="unit-title icon-unit-play">户外探索</h2>
    </div>
     <div class="page-content-wrapper member-wrapper">
      <div class="content-left-blk">
        <div class="news-detail-blk">
          <div class="manual-script-blk static-script-blk">
            <h3 class="static-title">户外探索注意事项</h3>
            <p class="static-desc">由于地处山区，为了你的安全请阅读安全事项</p>
          </div>
          <div class="manual-script-blk static-script-blk">
            <h3 class="static-sub-title">注意事项</h3>
            <p class="static-desc">
              <ol>
                <li>1:要注意天气。了解此段时间内的天气变化情况；</li>
                <li>2:了解同行人是不是志同道合，是否有丰富的相关经验；</li>
                <li>3:要量力而行，根据自身体力来</li>
                <li>4: 找寻对当地地貌特征熟悉的人作向导；</li>
                <li>5: 对所要去地方的地域情况应该充分了解，并作好各种不测的准备。比方说，登山时要作好山体滑坡等情况的紧急处理；</li>
                <li>6: 除了要带足常用的药品外，还要有相应的急救药品，要掌握一定的急救方法</li>
                <li>7: 熟记当地救援电话。自己所在位置;</li>
              </ol>
            </p>
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
  name: 'exploring',
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
<style lang="scss" scoped>
ol > li
{
  padding: 13px;
}
</style>
