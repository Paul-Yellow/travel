<template>
  <div class="footer-wrapper">
        <div class="fat-footer-wrapper show-at-desktop">
          <div class="fat-footer">
            <div class="fat-footer-item" v-for="(item,index) in Menu" :key="index">
                  <h3 class="title">{{item.name}}</h3>
                  <ul class="menu-list" v-for="(i,key) in item.menuSub" :key="key">
                    <li class="item">
                      <router-link :to="i.url" class="link" :title="i.name">{{i.name}}</router-link>
                    </li>
                </ul>
            </div>
            <div class="fat-footer-item">
              <h3 class="title">官方社群</h3>
              <ul class="menu-list">
                <li class="item">
                  <a href="https://weibo.com/u/5530559065?refer_flag=1001030102_" class="link icon-weibo" target="_blank" title="微博|打开窗口">微博</a>
                </li>
                <li class="item line-qrcode">
                  <a href="javascript:void(0)" class="link icon-line" target="_blank" title="农家乐微信群">LINE</a>
                  <div class="line-qrcode-blk">
                      <img src="/images/weixin.jpg" alt="官方微信群" class="qrcode">
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div> 
      <div class="footer">
        <a href="http://www.jxjaxzf.gov.cn" class="btn-taipei-logo" target="_blank" title="靖安政府|弹出窗口">x靖安政府</a>
        <div class="visitor-blk">
          <p class="link-blk">扫码加我</p>
          <p>
            <img src="/images/weixin.jpg" style="width:200px;height:auto;">
          </p>
        </div>
        <div class="contact-info-blk">
          <h2 class="title">
            <a href="https://www.keep-wan.me" class="link" target="_blank" title="中原旅游">中原旅游</a>
          </h2>
          <p class="info">地址 :靖安县中原乡邱家村中原超市后面</p>
          <p class="info adj">电话 : <a href="tel:+13755869377" class="tel-link" title="连络电话+13755869377">+13755869377</a> 联系QQ: <a href="415494857" class="tel-link" target="_blank" title="联系QQ">415494857</a></p>
          <p class="info link-blk">
            <a href="/zh-cn/security-policy" class="link" title="网站安全政策">网站安全政策</a>
            <a href="/zh-cn/privacy-policy" class="link" title="隐私权政策">隐私权政策</a>
            <a href="/zh-cn/open-data" class="link" title="政府资料开放">政府资料开放</a> 
            <a href="/zh-cn/precautions" class="link" title="资料使用须知">资料使用须知</a>
            <a href="/zh-cn/contact-us" class="link" title="联络我们">联络我们</a>
          </p>
        </div>
      </div>
<!--地图  -->
    <a-map :lo="lo" :ln="ln"></a-map>
    <div class="copyright-info-blk" id="copyright-info-blk">
      <p class="info"> Copyright © 2017 </p>
      <p class="info show-at-desktop">最佳浏览状态为 IE10.0 以上 ‧ Google Chrome ‧ Firefox6 以上 1024*768 以上屏幕分辨率</p>
    </div>
</div>
</template>
<script>
import AMap from 'components/map/index';
import {Menu} from 'utils/mock';
export default {
  name: 'appfooter',
  components:{
    AMap
  },
  data(){
    return{
      lo:28.8583182720,
      ln:114.9882584810,
      Menu:Menu
    }
  }
}
</script>
