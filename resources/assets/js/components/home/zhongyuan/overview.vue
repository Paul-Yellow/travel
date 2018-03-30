<template>
  <div class="">
    <div class="unit-title-blk bg-slash">
      <Breadcrumb class="breadcrumb"></Breadcrumb>
      <h2 class="unit-title icon-unit-play">中原概述</h2>
    </div>
    <div class="page-content-wrapper member-wrapper">
      <div class="content-left-blk">
        <div class="news-detail-blk">
          <div class="manual-script-blk static-script-blk">
            <h3 class="static-title">中原的多元样貌</h3>
            <p class="static-desc"> 中原拥有丰富的生态资源，众多的动植物，造就了中原多姿多彩景观。完好的生态系统让你回归天然的氧吧，中原拥有对生态环境要求极高的萤火虫每到夏日，听着知了，看萤火虫享受放松心情的生活!冬天吃着各种土特产区欣赏美丽的雪景 </p>
          </div>
          <div class="manual-script-blk static-script-blk">
            <h3 class="static-sub-title">九岭尖</h3>
            <h4 class="static-title">九岭尖美景</h4>
            <sub class="static-desc shine">体验挑战自我</sub>
            <p class="static-desc">
              九岭尖,总面积1266.16公顷，主峰九岭尖海拔1794米,森林覆盖率达80%以上，年平均气温15.8℃，年降水量776mm，年平均相对湿度60－70%，被原国家林业部列为天然母树林基地之一，享誉全国的珍贵树种“爪源杉”即产于此地
            </p>
            <div class="col">
              <img class="static-img" src="/images/fengmian/jiuling.jpg" alt="九岭尖美景">
              <span class="static-img-alt">九岭尖美景</span>
            </div>
            <br>
            <h4 class="static-title">九岭尖云海日出</h4>
            <sub class="static-desc shine">完全不输五岳的存在</sub>
            <p class="static-desc"> 九岭尖的云海日出完全不输五岳般的存在。如果需在在上面看日出看云海。需要做好安全防备。由于还未被开发; </p>
            <div class="col">
              <img class="static-img" src="/images/fengmian/yunhai.jpg" alt="总统府">
              <span class="static-img-alt">九岭尖云海日出</span>
            </div>
            <br>
            <h4 class="static-title">九岭尖石窝</h4>
            <sub class="static-desc shine">九岭尖石窝</sub>
            <p class="static-desc">九岭尖石窝,</p>
            <div class="col">
              <img class="static-img" src="/images/fengmian/shi.jpg" alt="总统府">
              <span class="static-img-alt">九岭尖石窝</span>
            </div>
          </div>
          <div class="manual-script-blk static-script-blk">
            <h3 class="static-sub-title">白崖山</h3>
            <h4 class="static-title">白崖山杜鹃花</h4>
            <sub class="static-desc shine">想看看真正的花海吗? 那就来白崖山把</sub>
            <p class="static-desc">漫山遍野的杜鹃花体验过吗? 那就一起相约春季来赏花,带上你的那个他(她)来一起浪漫. </p>
            <div class="col">
              <img class="static-img" src="/images/fengmian/tujuan.jpg" alt="白崖山杜鹃花">
              <span class="static-img-alt">白崖山杜鹃花</span>
            </div>
            <br>
            <div class="col">
              <img class="static-img" src="/images/fengmian/tujuan1.jpg" alt="白崖山杜鹃花">
              <span class="static-img-alt">白崖山杜鹃花</span>
            </div>
            <br>
           <div class="col">
              <img class="static-img" src="/images/fengmian/tujuan2.jpg" alt="白崖山杜鹃花">
              <span class="static-img-alt">白崖山杜鹃花</span>
            </div>
          </div>
          <div class="manual-script-blk static-script-blk">
            <h3 class="static-sub-title">西岭梯田</h3>
            <h4 class="static-title">西岭梯田</h4>
            <sub class="static-desc shine">不用跑去云南也能欣赏梯田的美色</sub>
            <p class="static-desc">虽然没有云南的梯田那么壮观。但也别有一番风味。相信您会喜欢的</p>
            <div class="col">
              <img class="static-img" src="/images/fengmian/titian.jpg" alt="中正纪念堂">
              <span class="static-img-alt">西岭梯田</span>
            </div>
            <br>
           <h4 class="static-title">西岭梯田</h4>
            <sub class="static-desc shine">不用跑去云南也能欣赏梯田的美色</sub>
            <p class="static-desc">西岭梯田</p>
            <div class="col">
              <img class="static-img" src="/images/fengmian/titian1.jpg" alt="中正纪念堂">
              <span class="static-img-alt">西岭梯田</span>
            </div>
            <br>
            <h4 class="static-title">西岭梯田</h4>
            <sub class="static-desc shine">不用跑去云南也能欣赏梯田的美色</sub>
            <p class="static-desc">西岭梯田</p>
            <div class="col">
              <img class="static-img" src="/images/fengmian/titian2.jpg" alt="中正纪念堂">
              <span class="static-img-alt">西岭梯田</span>
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
  name: 'overview',
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