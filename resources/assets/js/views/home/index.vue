<template>
<div v-loading.fullscreen.lock="isLoading" v-if="!isLoading">
  <div class="bg-slash index-slider-wrapper">
      <div class="index-banner-slider flickity-enabled is-draggable" id="index-banner-slider" >
        <el-carousel :interval="4000" indicator-position="none">
          <el-carousel-item v-for="item in sidebar" :key="item.id">
            <h3 style="position: absolute;display: flex;flex-direction: row;-webkit-flex-direction: row;-moz-flex-direction: row;font-size: 26px;color: rgb(255, 255, 255);justify-content: center;align-items: center;-webkit-justify-content: center;-webkit-align-items: center;-moz-justify-content: center;-moz-align-items: center;height: 100%;width: 100%;" >{{item.name}}</h3>
            <img :src="item.url" style="height:100%;width:100%">
          </el-carousel-item>
        </el-carousel>
      </div>
  </div>
  <div class="event-promote-blk" >
     <div class="desktop-wrapper">
       <div class="event-promote-left-blk"  > 
          <transition-group name="bounce" tag="ul" class="event-promote-list" id="event-promote-list"  v-if="!isPcOrMobile"> 
             <!-- <ul class="event-promote-list" id="event-promote-list">  -->
                <li class="item" v-for="(item,index) in hot" :key="index"> 
                  <router-link  :to="item.link" class="link" target="_blank" :title="item.title"> 
                    <span class="thumb-frame"><img :src="item.url"  alt="item.title" class="thumb lazyloaded"> </span> 
                  </router-link>
                </li> 
             <!-- </ul>   -->
          </transition-group>
           <ul class="event-promote-list" id="event-promote-list" v-if="isPcOrMobile">  
                <li class="item" v-for="(item,index) in hot" :key="index"> 
                  <router-link  :to="item.link" class="link" target="_blank" :title="item.title"> 
                    <span class="thumb-frame"><img :src="item.url"  alt="item.title" class="thumb lazyloaded"> </span> 
                  </router-link>
                </li> 
            </ul>    
        <a href="javascript:void(0)" class="btn-more" id="btn-more-recommend" title="更多推荐" v-on:click.prevent="onMore">更多推荐</a>
       </div> 
     </div> 
  </div>
  <div class="index-recent-news-wrapper">
    <div class="index-recent-news-blk">
      <h2 class="title">最新活动</h2>
      <ul class="index-recent-news-card-list"> 
        <li class="item" v-for="(item,index) in newevent" :key="index">
          <div class="recent-news-card"> 
            <router-link :to="`/newevent/detail/${item.id}`" class="link" :title="item.title">
              <span class="thumb-frame">
                <img  :alt="item.title" class="thumb lazyloaded" :src="item.imgUrl" style="width:70px;height:70px;"> 
              </span>
              <div class="info-blk">
                <span class="date">活动时间:{{item.date}}</span>
                <h3 class="info-title">{{item.title}}</h3>
              </div>
            </router-link>
          </div>
        </li> 
      </ul>
      <router-link to="/newevent" class="btn-more-text" title="更多最新活动" style="color: #9e9e9e;font-size: .875em;line-height: 1.71429em;">更多最新活动</router-link>
    </div>
    <div class="index-recent-news-blk">
      <h2 class="title">活动盛事</h2>
      <ul class="index-recent-news-card-list">
        <li class="item" v-for="(item,index) in activeevent" :key="index">
          <div class="recent-news-card"> 
            <router-link :to="`/activeevent/detail/${item.id}`" class="link" :title="item.title">
              <span class="thumb-frame">
                <img  :alt="item.title" class="thumb lazyloaded" :src="item.imgUrl" style="width:70px;height:70px;"> 
              </span>
              <div class="info-blk">
                <span class="date">活动时间:{{item.date}}</span>
                <h3 class="info-title">{{item.title}}</h3>
              </div>
            </router-link>    
          </div>
        </li> 
      </ul>
      <router-link to="/activeevent" class="btn-more-text" title="更多最新活动" style="color: #9e9e9e;font-size: .875em;line-height: 1.71429em;">更多最新活动盛事</router-link>
    </div>
  </div>
  <!--未完成  -->
  <div class="index-day-tour">
    <section class="daytour-title-blk">
      <h1 class="title">好好玩中源</h1>
      <p class="subtitle">选择特色的半日游、有趣的一日游、或是悠闲的多日游，用自己的步调，体验迷人的中源风情吧!</p>
    </section>
    <ul class="day-tour day-box-move" id="day-tour-list">
      <li class="list">
        <router-link to="tags/detail?name=半日游" class="day-link day-01" title="半日游">半日游</router-link>
      </li>
      <li class="list">
        <router-link to="tags/detail?name=一日游" class="day-link day-02" title="一日游">一日游</router-link>
      </li>
      <li class="list">
        <router-link to="tags/detail?name=多日游" class="day-link day-03" title="多日游">多日游</router-link>
      </li>
    </ul>
  </div>
  <div class="recommend-link-blk">
    <ul class="recommend-link-list">
      <li class="item"> 
        <a href="/zh-cn/featured" class="link" title="照片欣赏"> 
          <span class="frame">
            <img src="/images/svg/recommend-01.svg"  alt="照片欣赏" class="thumb lazyloaded"> 
          </span>
          <h3 class="title">照片欣赏</h3>
          <p class="desc"> 过去，现在，未来<br> 更多美丽照片 </p>
        </a>
      </li>
      <li class="item">
        <a href="/zh-cn/2017-festival" class="link" title="大型活动">
          <span class="frame">
            <img src="/images/svg/recommend-05.svg"  alt="大型活动" class="thumb lazyloaded">
          </span>
          <h3 class="title">大型活动</h3>
          <p class="desc"> 丰富多元的热情活动<br> 就是现在，一起FUN中源!! </p>
        </a>
      </li>
      <li class="item">
        <a href="/zh-cn/fun/tour" class="link" title="主题游程">
          <span class="frame">
            <img src="/images/svg/recommend-03.svg"  alt="主题游程" class="thumb lazyloaded"> 
          </span>
          <h3 class="title">主题游程</h3>
          <p class="desc"> 中原大小事<br> 生活休闲及观光旅游议题!! </p>
        </a>
      </li>
    </ul>
  </div>
  <!--未完成处理 -->
  <div class="index-spot-recommend-blk">
    <h2 class="title">推荐景点</h2>
    <ul class="index-spot-recommend-list">
      <li class="item" v-for="(item,index) in attraction" :key="index">
        <div class="spot-recommend-card">
          <router-link :to="'/attraction/detail/'+item.id" class="link" :title="item.name">
            <span class="thumb-frame">
              <img  :alt="item.name" class="thumb lazyloaded" :src="item.imgUrl"> 
            </span>
            <div class="info-blk">
              <h3 class="info-title">{{item.name}}</h3>
            </div>
          </router-link>
        </div>
      </li>
    </ul>
    <router-link to="/attraction" class="btn-more full" title="更多景点">更多景点</router-link>
  </div>
</div>
</template>
<script>
export default {
  name: 'homeindex',
  data(){
    return{
      'sidebar': '',
      count: 0,
      newevent: [],
      activeevent: [],
      attraction:[],
      isLoading:false
    }
  },
  created(){
    this.isLoading = true;
    this.$http.get('/index')
      .then((res)=>{
        if(res.data.responData.status=== 200){
          this.sidebar = res.data.responData.dash;
          this.newevent = res.data.responData.newevent;
          this.activeevent = res.data.responData.activeevent;
          this.attraction = res.data.responData.attraction;
          this.isLoading = false;
        }
      });
  },
  methods:{
    // 由于只有几个数据所以没有建立数据库直接模拟数据,后续如果游数据直接加入switch 内
    onMore(){
      this.count +=1
    }
  },
  computed:{
    hot(){
      switch(this.count){
        case 0:
          return [{
            id:1,
            title:'中原必吃美食',
            url: '/images/hot/hot.jpg',
            link: '/mustv-visit/bichi'
          },{
            id:2,
            title: '游乐中源',
            url: '/images/hot/hot1.jpg',
            link: '/mustv-visit'
          },{
            id:3,
            title: '周边风景',
            url: '/images/hot/hot2.jpg',
            link: '/mustv-visit/biyou'
          },{
            id:4,
            title: '特色小吃',
            url: '/images/hot/hot3.jpg',
            link: '/'
          }];
          break;
        case 1:
          this.count =-1;
          return [{id:5,title: '景点top10',url: '/images/hot/hot4.jpg',link: '/attraction/top'}];
          break;
        default:
          return [{
            id:1,
            title:'中原必吃美食',
            url: '/images/hot/hot.jpg',
            link: '/'
          },{
            id:2,
            title: '游乐中源',
            url: '/images/hot/hot1.jpg',
            link: '/'
          },{
            id:3,
            title: '周边风景',
            url: '/images/hot/hot2.jpg',
            link: '/'
          },{
            id:4,
            title: '特色小吃',
            url: '/images/hot/hot3.jpg',
            link: '/'
          }];
      }
    },
     // 判断是否为i是移动端
    isPcOrMobile(){
      let userAgentInfo = window.navigator.userAgent;
      let Agents = ['Android','iPhone','SymbianOS','Windows Phone','iPad','iPod'];
      let flag = true;
      for(let i = 0;i<Agents.length;i++){
        if(userAgentInfo.indexOf(Agents[i]) >0){
          flag = false;
          break;
        }
      }
      return flag;
    }
  }
}
</script>
<style lang="scss">
@media (min-width:1200px){
  #index-banner-slider .el-carousel__container{
    height: 650px;
  }
}
@media (min-width:768px) and(max-width:1200px) {
  #index-banner-slider .el-carousel__container{
    height: 450px;
  }
}
@media(max-width:768px){
  #index-banner-slider .el-carousel__container{
    height: 400px;
  }
}
.bounce-enter-active {
  animation: bounce-in .5s;
}
.bounce-leave-active {
  animation: bounce-in .5s reverse;
}
@keyframes bounce-in {
  0% {
    transform: scale(0);
  }
  50% {
    transform: scale(1.5);
  }
  100% {
    transform: scale(1);
  }
}
// 动画
// .slide-fade-enter-active {
//   transition: all .3s ease;
//   -moz-transition: all .3s ease;
//   -webkit-transition: all .3s ease;
// }
// .slide-fade-leave-active {
//   transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
//   -moz-transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
//   -webkit-transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
// }
// .slide-fade-enter, .slide-fade-leave-to
// /* .slide-fade-leave-active for below version 2.1.8 */ {
//   transform: translateX(10px);
//   -moz-transform: translateX(10px);
//   -webkit-transform: translateX(10px);
//   opacity: 0;
// }
</style>
