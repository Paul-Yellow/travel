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
            <ul class="link-exchange-list"> 
              <li class="item">
                <div class="link-exchange-card"> 
                  <a href="http://www.jxjaxzf.gov.cn/" class="link" target="_blank" title="Justaiwantour(打开窗口)">
                   <span class="thumb-frame"> 
                     <img src="http://www.jxjaxzf.gov.cn/Template/Default/Skin/images/bg-005.jpg" alt="Justaiwantour(打开窗口)"  class="thumb lazyloaded">
                    </span>
                    <div class="info-blk"> 
                      <h3 class="title">靖安县政府</h3> <div class="desc"> 靖安县政府网站为您提供各种公共服务; 以及了节本地人文风情</div>
                    </div>
                  </a>
                </div>
              </li>
            </ul>
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
