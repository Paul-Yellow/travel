<template>
  <div>
    <div class="unit-title-blk bg-slash">
      <Breadcrumb class="breadcrumb"></Breadcrumb>
      <h2 class="unit-title icon-unit-accommodation">{{$route.name}}</h2>
    </div>
    <div class="page-content-wrapper member-wrapper">
      <div class="content-left-blk">
        <el-row>
          <el-col :span="24">
            <el-collapse v-model="activeNames">
              <el-collapse-item title="旅游服务" name="1">
                <div>在中源旅游可以找我父亲。他是个中源通。各个地方都很熟悉.遇到需要导引的可以联系他.</div>
                <div>联系电话:13755869377 &nbsp;微信:wxid_f6jdb1elq9rc21&nbsp;&nbsp;&nbsp;微信名字:蓝天白云</div>
              </el-collapse-item>
              <el-collapse-item title="网站服务" name="2">
                <div>网站中景点及商家的「推荐指数」从何而来？</div>
                <div>全新改版上线的中源旅游网，从游客的角度与需求作为出发点，整合现有中源旅游网资料库，提供完善便利的搜寻机制，并与国际知名全球最大评论网站合作。除了提供中源旅游观光住宿、景点与商家评价，还可协助游客更快速了解其品质与内容，让游客可以更快找到北市最热门、最具话题性的去处，规划属於自己独特风格的旅行计划。</div>
              </el-collapse-item>
              <el-collapse-item title="旅行住宿" name="3">
                <div>如何选择中源住宿的地点呢？有无参考资讯？</div>
                <div>本网站「旅馆住宿」提供中源旅馆参考资讯，您可依各个行政区分类，搭配检索功能，找到适合的旅馆。

                  请参考「住宿快搜」https://www.keep-wan.me/acc</div>
              </el-collapse-item>
              <el-collapse-item title="需要注意事项" name="4">
                <div>由于海拔地势较高。自驾的游客需要注意行驶安全;气温较低需要注意保暖;</div>
                <div>来之前先查询天气情况。如果雷雨或者雨雪天最好避开。因为道路比较陡峭;</div>
              </el-collapse-item>
            </el-collapse>
          </el-col>
        </el-row>
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
  data() {
    return {
      activeNames: ['1']
    };
  },
  methods:{
    backPages(){
      return this.$router.go(-1);
    }
  }
}
</script>
