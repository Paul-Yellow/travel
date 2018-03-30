<template>
  <div>
    <div class="unit-title-blk bg-slash">
      <Breadcrumb class="breadcrumb"></Breadcrumb>
      <h2 class="unit-title icon-unit-accommodation">{{$route.name}}</h2>
    </div>
    <div class="page-content-wrapper member-wrapper">
      <div class="content-left-blk">
        <div class="news-detail-blk">
          <ol>
              <li>
                <h3 class="static-title">安全用电的注意事项</h3> 
                <h5>随着生活水平的不断提高，生活中用电的地方越来越多了。因此，我们有必要掌握以下最基本的安全用电常识：</h5>
                <ol>
                  <li>
                    <p class="static-desc">
                      认识了解电源总开关，学会在紧急情况下关断总电源。
                    </p>
                  </li>
                  <li>
                    <p class="static-desc">
                      不用手或导电物（如铁丝、钉子、别针等金属制品）去接触、探试电源插座内部。
                    </p>
                  </li>
                  <li>
                    <p class="static-desc">
                      不用湿手触摸电器，不用湿布擦拭电器。
                    </p>
                  </li>
                  <li>
                    <p class="static-desc">
                      电器使用完毕后应拔掉电源插头；插拔电源插头时不要用力拉拽电线，以防止电线的绝缘层受损造成触电；电线的绝缘皮剥落，要及时更换新线或者用绝缘胶布包好。
                    </p>
                  </li>
                  <li>
                    <p class="static-desc">
                      发现有人触电要设法及时关断电源；或者用干燥的木棍等物将触电者与带电的电器分开，不要用手去直接救人；年龄小的同学遇到这种情况，应呼喊成年人相助，不要自己处理，以防触电。
                    </p>
                  </li>
                  <li>
                    <p class="static-desc">
                      不随意拆卸、安装电源线路、插座、插头等。哪怕安装灯泡等简单的事情，也要先关断电源，并在家长的指导下进行。
                    </p>
                  </li>
                </ol>
              </li>
              <li>
                <h3 class="static-title">家庭安全用电常识</h3>
                <ol>
                  <li>
                    <p class="static-desc">
                      入户电源线避免过负荷使用，破旧老化的电源线应及时更换，以免发生意外
                    </p>
                  </li>
                  <li>
                    <p class="static-desc">
                      入户电源总保险与分户保险应配置合理，使之能起到对家用电器的保护作用。
                    </p>
                  </li>
                  <li>
                    <p class="static-desc">
                      接临时电源要用合格的电源线、电源插头、插座要安全可靠。损坏的不能使用，电源线接头要用胶布包好。
                    </p>
                  </li>
                  <li>
                    <p class="static-desc">
                      临时电源线临近高压输电线路时，应与高压输电线路保持足够的安全距离(10KV及以下0.7米；35KV,1米；110KV,1.5米；220KV,3米；500KV,5米)。
                    </p>
                  </li>
                   <li>
                    <p class="static-desc">
                     严禁私自从公用线路上接线。
                    </p>
                  </li>
                  <li>
                    <p class="static-desc">
                    线路接头应确保接触良好，连接可靠。
                    </p>
                  </li>
                  <li>
                    <p class="static-desc">
                    房间装修，隐藏在墙内的电源线要放在专用阻燃护套内，电源线的截面应满足负荷要求。
                    </p>
                  </li>
                  <li>
                    <p class="static-desc">
                    使用电动工具如电钻等，须戴绝缘手套。
                    </p>
                  </li>
                  <li>
                    <p class="static-desc">
                    遇有家用电器着火，应先切断电源再救火。
                    </p>
                  </li>
                   <li>
                    <p class="static-desc">
                    家用电器接线必须确保正确，有疑问应及时询问专业人员。
                    </p>
                  </li>
                  <li>
                    <p class="static-desc">
                    家庭用电应装设带有过电压保护的调试合格的漏电保护器，以保证使用家用电器时的人身安全。
                    </p>
                  </li>
                  <li>
                    <p class="static-desc">
                    家用电器在使用时，应有良好的外壳接地，室内要设有公用地线。
                    </p>
                  </li>
                  <li>
                    <p class="static-desc">
                    湿手不能触摸带电的家用电器，不能用湿布擦拭使用中的家用电器，进行家用电器修理必须先停电源。
                    </p>
                  </li>

                  <li>
                    <p class="static-desc">
                    家用电热设备，暖气设备一定要远离煤气罐、煤气管道，发现煤气漏气时先开窗通风，千万不能拉合电源，并及时请专业人员修理。
                    </p>
                  </li>
                   <li>
                    <p class="static-desc">
                    使用电熨斗、电烙铁等电热器件。必须远离易燃物品，用完后应切断电源，拔下插销以防意外。
                    </p>
                  </li>
                </ol>
                
              </li>
            </ol>
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
