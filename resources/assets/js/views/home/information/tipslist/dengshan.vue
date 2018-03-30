<template>
  <div>
    <div class="unit-title-blk bg-slash">
      <Breadcrumb class="breadcrumb"></Breadcrumb>
      <h2 class="unit-title icon-unit-accommodation">{{$route.name}}</h2>
    </div>
    <div class="page-content-wrapper member-wrapper">
      <div class="content-left-blk">

        <div class="news-detail-blk">
        <p class="static-desc"> 登山具有怡神健身之功用，山中林壑清幽，景色优美，怎样才能使攀登更加轻松容易？专家们总结出了登山窍门：</p>
        <h2> 做好健身运动</h2>　

        <p class="static-desc">如果将攀登的山比较高或者平时较少参加攀登运动，那么，在登山之前做一些热身运动是很必要的。即利用10—20分钟做一些肌肉伸展运动，尽量放松全身肌肉，这样攀登时会觉得轻松许多。</p> 

        <h2> 增加弹跳动作</h2>　

        <p class="static-desc">  向上攀登时，在每一步中都有意增添一些弹跳动作，不仅省力，还会使人显得精神，充满活力。</p>

        <h2> 别总往高处看</h2>　

        <p class="static-desc">   登山时不要总往高处看，尤其是登山之初，因为你的双腿还没有习惯攀登动作，往上看往往使人产生一种疲惫感。一般说，向上攀登时，目光保留在自己前方三五米处最好。如果山路比较陡峭，则可作“Z”字形攀登，这样比较省力。</p>

        <h2>  转移注意力</h2>　

        <p class="static-desc"> 登山时千万不要总是想着山有多高，爬上去还需多少时间之类的事情。不慌不忙，走走停停才能体会到爬山的乐趣，不会错过美丽的风景。在疲惫时，可以多观赏一下周围的景色，也可唱唱歌，转移注意力，倦意会有所消减。</p>

        <h2>下山要放松</h2>

     　 <p class="static-desc"> 下山一定要控制住自己的脚步，切不可冲得太快，这样很容易受伤。同时，注意放松膝盖部位的肌肉，绷得太紧会对腿部关节产生较大的压力，使肌肉疲劳。</p>
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
