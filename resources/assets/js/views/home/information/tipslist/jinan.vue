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
            <table class="static-table" summary="常用服务专线"> 
              <caption>急难救治电话</caption> 
              <tbody>
                <tr> <th><p>单 位 名 称</p></th> <th><p>电 话 </p></th> </tr> 
                <tr> <td><p>火警、消防</p></td> <td><p>119</p></td> </tr> 
                <tr> <td><p>救护</p></td> <td><p>120</p></td> </tr> 
                <tr> <td><p>报警</p></td> <td><p>110</p></td> </tr>  
                <tr> <td><p>查号台</p></td> <td><p>114</p></td> </tr> 
                <tr> <td><p>气象局</p></td> <td><p>96121</p></td> </tr> 
                <tr> <td><p>交通路况报导</p></td> <td><p>122</p></td> </tr> 
                <tr> <td><p>靖安县政府热线</p></td> <td><p>0795-4662252</p></td> </tr>
              </tbody>
            </table> 
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
