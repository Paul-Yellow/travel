<template>
  <div>
    <div class="unit-title-blk bg-slash">
      <Breadcrumb class="breadcrumb"></Breadcrumb>
      <h2 class="unit-title icon-unit-accommodation">{{$route.name}}</h2>
    </div>
    <div class="page-content-wrapper member-wrapper">
      <div class="content-left-blk">
        <h1>暂时没有数据</h1>
        <div class="page-func-blk"> <a href="javascript:void(0);" class="btn-page-direction" title="回前页" @click="backPages">回前页</a> </div>
      </div>
      <slide-bar></slide-bar>
    </div>
  </div>
</template>
<script>
import Breadcrumb from 'components/layout/breadcrumb';
import Slidebar from './slidebar';
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
<template>
  <div>
    <div class="unit-title-blk bg-slash">
      <Breadcrumb class="breadcrumb"></Breadcrumb>
      <h2 class="unit-title icon-unit-accommodation">{{$route.name}}</h2>
    </div>
    <div class="page-content-wrapper member-wrapper">
      <div class="content-left-blk">
        <div class="news-detail-blk">
          <div class="manual-script-blk static-script-blk"> 
            <ol>
              <li>
                <h3 class="static-title">高铁信息</h3> 
                <h5>第一步:乘坐高铁到南昌西站</h5>
                <p class="static-desc"> 
                  <a title="高铁信息|弹出窗口" href="https://kyfw.12306.cn/otn/czxx/init" target="_blank">高铁信息</a>
                  <br> 
                </p>
              </li>
              <li>
                <h3 class="static-title">公交车查询</h3>
                <h5>第二步:换乘公交车到汽车站</h5> 
                <p class="static-desc">
                  <a title="市区公交车换乘查询|弹出窗口" href="http://www.ncgj.com.cn/mainpages/default.aspx" target="_blank">市区公交车换乘查询</a>
                </p>
              </li>
              <li>
                <h3 class="static-title">汽车查询</h3>
                <h5>第三步:乘坐前往中源的汽车或者乘坐前往靖安的汽车</h5> 
                <p class="static-desc">
                  <a title="汽车换乘查询|弹出窗口" href="http://www.jxlwsp.com/ " target="_blank">汽车换乘查询</a>
                  <!-- http://www.jxlwsp.com/ -->
                  <span>通过微信搜索关注"南昌长途汽车站"即可以查找到中源的汽车版班次</span>
                </p>
              </li>
            </ol>
          </div>
        </div>
        <div class="page-func-blk"> <a href="javascript:void(0);" class="btn-page-direction" title="回前页" @click="backPages">回前页</a> </div>
      </div>
      <slide-bar></slide-bar>
    </div>
  </div>
</template>
<script>
import Breadcrumb from 'components/layout/breadcrumb';
import Slidebar from './slidebar';
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
