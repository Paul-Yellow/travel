<template>
  <div>
    <div class="unit-title-blk bg-slash">
      <Breadcrumb class="breadcrumb"></Breadcrumb>
      <h2 class="unit-title icon-unit-play">{{$route.query.name}}</h2>
    </div>
    <div class="page-content-wrapper" v-if="!isLoading">
      <div class="content-left-blk">
        <el-tabs v-model="activeName" @tab-click="handleClick" v-if="n.length!==0||a.length!==0||o.length!==0">
          <el-tab-pane label="最新活动" name="first" v-if="n.length >0">
            <ul class="img-card-list bdtn">
              <li class="item" v-for="(item,index) in n" :key="index">
                <div class="img-card-item">
                  <router-link :to=" '/newevent/detail/'+item.id " class="link" :title="item.title">
                    <div class="thumb-frame">
                      <img :alt="item.title" class="thumb lazyloaded" :src="item.imgUrl" style="width:100%;height:100%;">
                    </div>
                    <div class="info-blk">
                      <span class="type">最新活动</span>
                      <h2 class="card-title line-2" v-text="item.title"></h2>
                      <div class="service-center-info-list hide-at-mobile">
                        <div class="row">
                          <span class="title dim">活动地点</span>
                          <span class="desc" v-text="item.area"></span>
                        </div>
                        <div class="row">
                          <span class="title dim">活动时间</span>
                          <span class="desc" v-text="item.date"></span>
                        </div>
                        <div class="row">
                          <span class="title dim">活动简介</span>
                          <span class="desc" v-text="item.content_short"></span>
                        </div>
                      </div>
                    </div>
                  </router-link>
                </div>
              </li>
            </ul>
          </el-tab-pane>
          <el-tab-pane label="活动盛事" name="second" v-if="a.length >0">
             <ul class="img-card-list bdtn">
              <li class="item" v-for="(item,index) in a" :key="index">
                <div class="img-card-item">
                  <router-link :to=" '/activeevent/detail/'+item.id " class="link" :title="item.title">
                    <div class="thumb-frame">
                      <img :alt="item.title" class="thumb lazyloaded" :src="item.imgUrl" style="width:100%;height:100%;">
                    </div>
                    <div class="info-blk">
                      <span class="type">活动盛事</span>
                      <h2 class="card-title line-2" v-text="item.title"></h2>
                      <div class="service-center-info-list hide-at-mobile">
                        <div class="row">
                          <span class="title dim">活动地点</span>
                          <span class="desc" v-text="item.area"></span>
                        </div>
                        <div class="row">
                          <span class="title dim">主办单位</span>
                          <span class="desc" v-text="item.sponsor"></span>
                        </div>
                        <div class="row">
                          <span class="title dim">活动时间</span>
                          <span class="desc" v-text="item.date"></span>
                        </div>
                        <div class="row">
                          <span class="title dim">活动简介</span>
                          <span class="desc" v-text="item.content_short"></span>
                        </div>
                      </div>
                    </div>
                  </router-link>
                </div>
              </li>
            </ul>
          </el-tab-pane>
          <el-tab-pane label="活动优惠" name="third" v-if="o.length >0">
            <ul class="img-card-list bdtn">
              <li class="item" v-for="(item,index) in o" :key="index">
                <div class="img-card-item">
                  <router-link :to=" '/offers/detail/'+item.id " class="link" :title="item.name">
                    <div class="thumb-frame">
                      <img :alt="item.name" class="thumb lazyloaded" :src="item.imgUrl" style="width:100%;height:100%;">
                    </div>
                    <div class="info-blk">
                      <span class="type">活动优惠</span>
                      <h2 class="card-title line-2" v-text="item.name"></h2>
                      <div class="service-center-info-list hide-at-mobile">
                        <div class="row">
                          <span class="title dim">活动地点</span>
                          <span class="desc" v-text="item.area"></span>
                        </div>
                        <div class="row">
                          <span class="title dim">活动名称</span>
                          <span class="desc" v-text="item.explain"></span>
                        </div>
                        <div class="row">
                          <span class="title dim">店家电话</span>
                          <span class="desc" v-text="item.phone"></span>
                        </div>
                        <div class="row">
                          <span class="title dim">活动时间</span>
                          <span class="desc" v-text="item.date"></span>
                        </div>
                        <div class="row">
                          <span class="title dim">活动简介</span>
                          <span class="desc" v-text="item.content_short"></span>
                        </div>
                      </div>
                    </div>
                  </router-link>
                </div>
              </li>
            </ul>
          </el-tab-pane>
        </el-tabs>
        <div v-else style="text-align:center;">
            <h3 style="font-size:32px;display:inline-block;">没有数据</h3>
        </div>
      </div>
      <div class="content-right-blk"> <div class="right-side-info-blk"> <h3 class="title">热门景点</h3> <ul class="hot-info-list"> <li class="item small-info-card-item"> <a href="/zh-cn/attraction/details/90" class="link" title="林安泰古厝民俗文物馆"> <span class="thumb-frame"> <img src="/image/64149/50x50" data-src="/image/64149/50x50" alt="林安泰古厝民俗文物馆" class="thumb lazyloaded">  </span> <div class="info-blk vam-blk"> <h3 class="info-title vam"> <span class="ellipsis"> 林安泰古厝民俗文物馆 </span> </h3> <span class="icon-view">5.5万</span> </div> </a> </li> <li class="item small-info-card-item"> <a href="/zh-cn/attraction/details/112" class="link" title="树河"> <span class="thumb-frame"> <img src="/image/64243/50x50" data-src="/image/64243/50x50" alt="树河" class="thumb lazyloaded">  </span> <div class="info-blk vam-blk"> <h3 class="info-title vam"> <span class="ellipsis"> 树河 </span> </h3> <span class="icon-view">3.6万</span> </div> </a> </li> <li class="item small-info-card-item"> <a href="/zh-cn/attraction/details/176" class="link" title="五指山系-大仑头尾山亲山步道"> <span class="thumb-frame"> <img src="/image/64324/50x50" data-src="/image/64324/50x50" alt="五指山系-大仑头尾山亲山步道" class="thumb lazyloaded">  </span> <div class="info-blk vam-blk"> <h3 class="info-title vam"> <span class="ellipsis"> 五指山系-大仑头尾山亲山步道 </span> </h3> <span class="icon-view">3万</span> </div> </a> </li> <li class="item small-info-card-item"> <a href="/zh-cn/attraction/details/218" class="link" title="糖廍文化园区"> <span class="thumb-frame"> <img src="/image/64617/50x50" data-src="/image/64617/50x50" alt="糖廍文化园区" class="thumb lazyloaded">  </span> <div class="info-blk vam-blk"> <h3 class="info-title vam"> <span class="ellipsis"> 糖廍文化园区 </span> </h3> <span class="icon-view">1.7万</span> </div> </a> </li> <li class="item small-info-card-item"> <a href="/zh-cn/attraction/details/1540" class="link" title="五分埔-成衣街"> <span class="thumb-frame"> <img src="/image/66200/50x50" data-src="/image/66200/50x50" alt="五分埔-成衣街" class="thumb lazyloaded">  </span> <div class="info-blk vam-blk"> <h3 class="info-title vam"> <span class="ellipsis"> 五分埔-成衣街 </span> </h3> <span class="icon-view">1.5万</span> </div> </a> </li> </ul> <a href="/zh-cn/attraction" class="btn-more" title="更多景点">更多</a> </div> <div class="right-side-info-blk"> <h3 class="title">热门美食</h3> <ul class="hot-info-list"> <li class="item small-info-card-item"> <a href="/zh-cn/shop/details/5" class="link" title="鼎泰丰"> <span class="thumb-frame"> <img src="/image/54299/50x50" data-src="/image/54299/50x50" alt="鼎泰丰" class="thumb lazyloaded"> <noscript> &lt;img src="/image/54299/50x50" alt="" class="thumb"&gt; </noscript> </span> <div class="info-blk vam-blk"> <h3 class="info-title vam"> <span class="ellipsis"> 鼎泰丰 </span> </h3> <span class="icon-view">32.5万</span> </div> </a> </li> <li class="item small-info-card-item"> <a href="/zh-cn/shop/details/51" class="link" title="台北犁记"> <span class="thumb-frame"> <img src="/image/7471/50x50" data-src="/image/7471/50x50" alt="台北犁记" class="thumb lazyloaded">  </span> <div class="info-blk vam-blk"> <h3 class="info-title vam"> <span class="ellipsis"> 台北犁记 </span> </h3> <span class="icon-view">4.2万</span> </div> </a> </li> <li class="item small-info-card-item"> <a href="/zh-cn/shop/details/93" class="link" title="金仙鱼丸卤肉饭"> <span class="thumb-frame"> <img src="/image/7593/50x50" data-src="/image/7593/50x50" alt="金仙鱼丸卤肉饭" class="thumb lazyloaded">  </span> <div class="info-blk vam-blk"> <h3 class="info-title vam"> <span class="ellipsis"> 金仙鱼丸卤肉饭 </span> </h3> <span class="icon-view">3万</span> </div> </a> </li> <li class="item small-info-card-item"> <a href="/zh-cn/shop/details/95" class="link" title="牛易馆"> <span class="thumb-frame"> <img src="/image/7599/50x50" data-src="/image/7599/50x50" alt="牛易馆" class="thumb lazyloaded">  </span> <div class="info-blk vam-blk"> <h3 class="info-title vam"> <span class="ellipsis"> 牛易馆 </span> </h3> <span class="icon-view">7539</span> </div> </a> </li> <li class="item small-info-card-item"> <a href="/zh-cn/shop/details/451" class="link" title="MINIPARK"> <span class="thumb-frame"> <img src="/image/8675/50x50" data-src="/image/8675/50x50" alt="MINIPARK" class="thumb lazyloaded">  </span> <div class="info-blk vam-blk"> <h3 class="info-title vam"> <span class="ellipsis"> MINIPARK </span> </h3> <span class="icon-view">6825</span> </div> </a> </li> </ul> <a href="/zh-cn/shop/gourmet" class="btn-more" title="更多美食">更多</a> </div> <div class="right-side-info-blk"> <h3 class="title">热门住宿</h3> <ul class="hot-info-list"> <li class="item small-info-card-item"> <a href="/zh-cn/accommodation/details/3836" class="link" title="枫の微笑会馆"> <span class="thumb-frame"> <img src="/content/images/not-found/50x50.jpg" data-src="/content/images/not-found/50x50.jpg" alt="枫の微笑会馆" class="thumb lazyloaded">  </span> <div class="info-blk vam-blk"> <h3 class="info-title vam"> <span class="ellipsis"> 枫の微笑会馆 </span> </h3> <span class="icon-view">2979</span> </div> </a> </li> <li class="item small-info-card-item"> <a href="/zh-cn/accommodation/details/1401" class="link" title="景美大旅社"> <span class="thumb-frame"> <img src="/image/25488/50x50" data-src="/image/25488/50x50" alt="景美大旅社" class="thumb lazyloaded">  </span> <div class="info-blk vam-blk"> <h3 class="info-title vam"> <span class="ellipsis"> 景美大旅社 </span> </h3> <span class="icon-view">2837</span> </div> </a> </li> <li class="item small-info-card-item"> <a href="/zh-cn/accommodation/details/3838" class="link" title="泊居旅店"> <span class="thumb-frame"> <img src="/content/images/not-found/50x50.jpg" data-src="/content/images/not-found/50x50.jpg" alt="泊居旅店" class="thumb lazyloaded">  </span> <div class="info-blk vam-blk"> <h3 class="info-title vam"> <span class="ellipsis"> 泊居旅店 </span> </h3> <span class="icon-view">2693</span> </div> </a> </li> <li class="item small-info-card-item"> <a href="/zh-cn/accommodation/details/3852" class="link" title="号子青旅"> <span class="thumb-frame"> <img src="/image/54265/50x50" data-src="/image/54265/50x50" alt="号子青旅" class="thumb lazyloaded">  </span> <div class="info-blk vam-blk"> <h3 class="info-title vam"> <span class="ellipsis"> 号子青旅 </span> </h3> <span class="icon-view">2369</span> </div> </a> </li> <li class="item small-info-card-item"> <a href="/zh-cn/accommodation/details/3854" class="link" title="城市商旅昆明馆"> <span class="thumb-frame"> <img src="/content/images/not-found/50x50.jpg" data-src="/content/images/not-found/50x50.jpg" alt="城市商旅昆明馆" class="thumb lazyloaded">  </span> <div class="info-blk vam-blk"> <h3 class="info-title vam"> <span class="ellipsis"> 城市商旅昆明馆 </span> </h3> <span class="icon-view">2284</span> </div> </a> </li> </ul> <a href="/zh-cn/accommodation" class="btn-more" title="更多住宿">更多</a> </div> </div>
    </div>
  </div>
</template>
<script>
import Breadcrumb from 'components/layout/breadcrumb';
export default {
  components:{
    Breadcrumb
  },
  data(){
    return{
      activeName: 'first',
      isLoading: false,
      n: [],
      a: [],
      o: []
    }
  },
  created(){
    this.initData(this.$route.query.name);
  },
  methods:{
    initData(name){
      this.isLoading = true;
      this.$http.get(`/tags?name=${this.$route.query.name}`)
        .then(({data})=>{
          if(data.responData.status === 200){
            this.n = data.responData.newevent;
            this.a = data.responData.activeevent;
            this.o = data.responData.offers;
            if(data.responData.newevent.length >0){
              this.activeName = 'first';
            }else if(data.responData.activeevent.length >0){
              this.activeName = 'second';
            }else if(data.responData.offers.length > 0){
              this.activeName = 'third';
            }
            this.isLoading = false;
          }else{
            this.$message({
              type: 'wran',
              message: data.responData.messages
            });  
          }
        });
    },
    handleClick(tab,event){
      console.log(tab,event);
    }
  }
}
</script>
<style lang="scss" scoped>
.img-card-item .frame:after,.img-card-item .link:after {
                content: "";
                display: table;
                clear: both
            }

            .img-card-item {
                position: relative;
                border-bottom: 1px #d9d9d9 solid
            }

            .img-card-list {
                border-top: 1px #d9d9d9 solid
            }

            .img-card-list.bdtn {
                border-top: none
            }

            .img-card-item .frame,.img-card-item .link {
                display: block;
                padding: 16px;
                text-decoration: none
            }

            .img-card-item .thumb-frame {
                float: left;
                padding-bottom: 0
            }

            .img-card-item .card-title {
                color: #212121;
                font-size: 1em;
                line-height: 1.425em
            }

            .img-card-item .line-1,.img-card-item .line-2,.img-card-item .line-3 {
                overflow: hidden;
                display: block;
                display: -webkit-box;
                max-height: 24px;
                -webkit-line-clamp: 1;
                -webkit-box-orient: vertical;
                text-overflow: ellipsis
            }

            .img-card-item .line-2 {
                max-height: 48px;
                -webkit-line-clamp: 2
            }

            .img-card-item .line-3 {
                max-height: 72px;
                -webkit-line-clamp: 3
            }

            .img-card-item .info {
                color: #343434;
                font-size: .875em;
                line-height: 1.71429em
            }

            .img-card-item .ellipsis {
                white-space: nowrap;
                overflow: hidden;
                -ms-text-overflow: ellipsis;
                -o-text-overflow: ellipsis;
                text-overflow: ellipsis
            }

            .img-card-item .shine {
                color: #8c71bd
            }

            .img-card-item .dim {
                color: #8c8c8c
            }

            .img-card-item .date {
                color: #999
            }

            .img-card-item .type {
                display: inline-block;
                padding: 0 8px;
                margin-bottom: 8px;
                color: #eee;
                background: grey;
                font-size: .8125em;
                line-height: 1.84615em
            }

            .img-card-item .btn-download,.img-card-item .btn-link-out {
                margin-right: 10px;
                margin-bottom: 4px
            }

            .img-card-item .tag-list {
                height: 30px;
                overflow: hidden
            }

            .img-card-item .tag-list .btn-tag {
                float: left;
                margin-right: 8px;
                margin-bottom: 8px;
                color: #000
            }

            .img-card-item .tag-list .btn-tag:focus,.img-card-item .tag-list .btn-tag:hover {
                color: #000;
                background: #fff
            }

            .img-card-item .btn-add-diamond {
                display: none;
                position: absolute;
                top: 40px;
                left: 178px;
                margin-top: -16px
            }

            .img-card-item.tour {
                position: relative
            }

            @media (min-width: 0) and (max-width:767px) {
                .img-card-item .tag-list,.img-card-item.info .thumb-frame,.img-card-item.schedule .thumb-frame {
                    display:none
                }

                .img-card-item .frame,.img-card-item .link {
                    padding-left: 0;
                    padding-right: 0
                }

                .img-card-item .thumb-frame {
                    width: 100px;
                    height: 75px;
                    padding-bottom: 0
                }

                .img-card-item .info-blk {
                    margin-left: 8px;
                    padding-left: 100px
                }

                .img-card-item.publication .detail-blk {
                    clear: both;
                    width: 100%;
                    margin-top: 8px
                }

                .img-card-item.publication .detail-blk .info:not(:last-child) {
                    margin-bottom: 4px
                }

                .img-card-item.schedule .link {
                    padding-left: 0;
                    border: none
                }

                .img-card-item.schedule .info-blk {
                    padding-left: 0
                }

                .img-card-item.info .card-title {
                    margin-bottom: 8px;
                    font-size: 1.125em;
                    line-height: 1.33333em
                }

                .img-card-item.info .info-blk {
                    margin-left: 0;
                    padding-left: 0;
                    padding-right: 0
                }
            }

            @media (min-width: 768px) and (max-width:1199px) {
                .img-card-item .frame,.img-card-item .link {
                    padding:16px 0
                }

                .img-card-item .card-title {
                    margin-bottom: 8px;
                    font-size: 1.125em;
                    line-height: 1.33333em
                }

                .img-card-item .info {
                    font-size: .9375em;
                    line-height: 1.44em
                }

                .img-card-item .info.line-3.adj {
                    max-height: 96px;
                    -webkit-line-clamp: 4
                }

                .img-card-item .info:not(:last-child) {
                    margin-bottom: 4px
                }

                .img-card-item .thumb-frame {
                    width: 200px;
                    height: 150px
                }

                .img-card-item .info-blk,.img-card-item.publication .detail-blk {
                    padding-left: calc(200px + 16px)
                }
            }

            @media (min-width: 1200px) {
                .img-card-item .frame,.img-card-item .link {
                    padding:16px 0
                }

                .img-card-item .card-title {
                    margin-bottom: 8px;
                    font-size: 1.125em;
                    line-height: 1.33333em
                }

                .img-card-item .info {
                    font-size: .9375em;
                    line-height: 1.44em
                }

                .img-card-item .info.line-3.adj {
                    max-height: 96px;
                    -webkit-line-clamp: 4
                }

                .img-card-item .info:not(:last-child) {
                    margin-bottom: 4px
                }

                .img-card-item .thumb-frame {
                    width: 200px;
                    height: 150px
                }

                .img-card-item .info-blk,.img-card-item.publication .detail-blk {
                    padding-left: calc(200px + 16px)
                }

                .img-card-item {
                    padding: 0 16px
                }

                .img-card-item:not(.publication):not(.info):hover {
                    background: #fff
                }

                .img-card-item:not(.publication):not(.info):hover .card-title {
                    color: #00a8c1
                }

                .img-card-item:not(.publication):not(.info):hover .btn-edit {
                    box-shadow: 0 0 1px #888
                }

                .img-card-item:not(.publication):not(.info):hover .btn-edit:hover {
                    box-shadow: 0 0 5px 2px #ccc
                }

                .img-card-item .btn-edit {
                    display: block;
                    position: absolute;
                    right: 40px;
                    top: 50%;
                    -webkit-transform: translate(50%,-50%);
                    -moz-transform: translate(50%,-50%);
                    -ms-transform: translate(50%,-50%);
                    -o-transform: translate(50%,-50%);
                    transform: translate(50%,-50%)
                }

                .img-card-item .btn-add-diamond {
                    display: block
                }

                .index-banner-slider.has-video {
                    display: none
                }
            }


            .service-center-info-list {
                font-size: .9375em;
                line-height: 1.6em
            }

            .service-center-info-list .row {
                display: -webkit-flex;
                display: flex;
                -webkit-flex-flow: row wrap;
                flex-flow: row wrap
            }

            .service-center-info-list .title {
                padding-right: 12px
            }

            .service-center-info-list .desc {
                color: #343434
            }

            .service-center-info-list .link-out {
                color: #2d5190
            }

            .service-center-info-list .link-out:after {
                font-style: normal;
                content: "";
                display: inline-block;
                font-size: 12px;
                margin-left: 4px;
                vertical-align: middle
            }
</style>
