<template>
  <div>
    <div class="unit-title-blk bg-slash">
      <Breadcrumb class="breadcrumb"></Breadcrumb>
      <h2 class="unit-title icon-unit-accommodation">{{$route.name}}</h2>
    </div>
    <div class="page-content-wrapper member-wrapper">
      <div class="content-left-blk">
        <div class="news-detail-blk">
          <div class="static-script-blk"> 
            <h3 class="static-title">旅馆双语标示参考表</h3>
            <table cellspacing="0" width="100%" class="static-table" summary="旅馆双语标示参考表">
              <tbody>
                <tr>
                  <th width="12%">中 文</th>
                  <th width="29%">万家山庄</th> 
                  <th width="29%">禹彩山庄</th> 
                  <th width="30%">万家山庄</th> 
                </tr>
                <tr> <td>客房</td> <td>Single/Double</td> <td>Room</td> <td>King / Twin</td> </tr>
                <tr> <td>套房</td> <td>Suite</td> <td>Suite</td> <td>Suite</td> </tr>
                <tr> <td>宽带网</td> <td>Broadband Internet</td> <td>Broadband Internet</td> <td>Broadband Internet</td> </tr> 
                <tr> <td>无线局域网</td> <td>Wireless Internet</td> <td>Wireless Internet</td> <td>Wireless Internet</td> </tr>
                <tr> <td>卫星频道</td> <td>Satellite TV Broadcasting</td> <td>Satellite TV</td> <td>Satellite TV Channels</td> </tr> 
                <tr> <td>有线电视</td> <td>Cable TV </td> <td>Cable TV</td> <td>Cable TV Channels</td> </tr> 
                <tr> <td>冰箱</td> <td>Refrigerator</td> <td>Refrigerator</td> <td>Refrigerator</td> </tr> 
                <tr> <td>客房服务</td> <td>Room Service</td> <td>Room Service</td> <td>Room Service</td> </tr>
                <tr> <td>淋浴</td> <td>Shower</td> <td>Shower</td> <td>Shower</td> </tr> 
                <tr> <td>餐厅</td> <td>Dining Hall</td> <td>Restaurants</td> <td>Restaurants</td> </tr>
                <tr> <td>柜台</td> <td>Front Desk</td> <td>Front Desk</td> <td>Front Desk</td> </tr>
                <tr> <td>停车位</td> <td>Car Park</td> <td>Parking Area</td> <td>Parking</td> </tr>
                <tr> <td>价目表</td> <td>Price List</td> <td>Price List</td> <td>Price List</td> </tr>
                <tr> <td>提供时间</td> <td>Service Time</td> <td>Service Time</td> <td>Service Time</td> </tr>
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