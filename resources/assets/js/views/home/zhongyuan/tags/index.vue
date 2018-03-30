<template>
  <div>
    <div class="unit-title-blk bg-slash">
      <Breadcrumb class="breadcrumb"></Breadcrumb>
      <h2 class="unit-title icon-unit-play">{{$route.name}}</h2>
    </div>
    <div class="page-content-wrapper" v-if="!isLoading">
      <div class="tag-desc-blk">
        <h3 class="title-blk">
          <span class="before">寻找我们的</span>
          <span class="title">中源印象</span>
          <span class="after">ZhongYuan TAG</span>
        </h3>
        <p class="desc"> 
          在中源，您每个所到之处，多样的文化特质都充沛鼓动着─传统的建筑与现代的街道、柔润的温泉与自然的山林、好吃的土特产与风格独具的小店─无论您是短暂停留或是计画长期拜访，
          中源所蕴藏的多样性绝对会让您回味无穷。
        </p>
      </div>
      <ul class="tag-tile-list">
        <li class="item" v-for="(item,index) in tagPath" :key="index">
          <router-link class="link" :to="{path:'/tags/detail',query:{name:item.name}}"  :title="item.name">
            <span class="thumb-frame">
              <img  :alt="item.name" class="thumb lazyloaded" :src=" '/images/tag/'+item.path " style="width:100%;height:100%;"> 
            </span>
            <h3 class="title">
              <span class="name">{{item.name}}</span>
            </h3>
          </router-link>
        </li>
      </ul>
      <h3 class="page-content-title">关键字TAG总表</h3>
      <ul class="tag-text-list"> 
        <li class="item" v-for="(item,index) in tagAll" :key="index">
          <router-link :to="{path:'/tags/detail',query:{name:item.name}}" class="link" :title="item.name">
            <h3 class="title">
              <span class="name">{{item.name}}</span>
            </h3>
          </router-link>
        </li>  
      </ul>
    </div>
  </div>
</template>
<script>
import Breadcrumb from 'components/layout/breadcrumb';
export default {
  name: 'tags',
  components:{
    Breadcrumb
  },
  data(){
    return{
      isLoading: false,
      tagPath: [],
      tagAll: []
    }
  },
  mounted(){
    this.initData();
  },
  methods:{
    initData(){
      this.isLoading = true;
      this.$http.get('/tagsAll')
        .then(({data})=>{
          if(data.responData.status === 200){
            this.tagPath = data.responData.data;
            this.tagAll = data.responData.tag;
            this.isLoading = false;
          }else{
            this.$message({
              type: 'wran',
              message: data.responData.message
            })
          }
        });
    }
  }
}
</script>
<style lang="scss" scoped>
.tag-desc-blk {
                margin-bottom: 40px;
                background: #deecef
            }

            .tag-desc-blk .title-blk {
                display: -webkit-flex;
                display: flex;
                -webkit-flex-flow: row wrap;
                flex-flow: row wrap;
                -webkit-align-items: center;
                align-items: center;
                height: 170px;
                padding-left: 40px;
                padding-top: 32px;
                padding-bottom: 32px;
                color: #fff;
                background: url(/images/tag/tag-desc-title-bg.png) right top no-repeat #403564
            }

            .tag-desc-blk .after,.tag-desc-blk .before,.tag-desc-blk .title {
                display: block;
                width: 100%;
                overflow: hidden;
                text-overflow: ellipsis
            }

            .tag-desc-blk .before {
                font-size: 1.125em;
                line-height: 1.33333em
            }

            .tag-desc-blk .title {
                font-size: 2.25em;
                line-height: 1em
            }

            .tag-desc-blk .after {
                font-size: 1.75em;
                line-height: 1em
            }

            .tag-desc-blk .desc {
                color: #212121
            }

            @media (min-width: 0) and (max-width:767px) {
                .tag-desc-blk {
                    margin-left:-3.7931%;
                    margin-right: -3.7931%;
                    padding: 16px 16px 24px
                }

                .tag-desc-blk .title-blk {
                    margin-bottom: 16px
                }

                .tag-desc-blk .desc {
                    padding-left: 8px;
                    padding-right: 8px;
                    font-size: 1em;
                    line-height: 1.5em
                }
            }

            @media (min-width: 768px) and (max-width:1199px) {
                .tag-desc-blk {
                    display:-webkit-flex;
                    display: flex;
                    -webkit-flex-flow: row nowrap;
                    flex-flow: row nowrap;
                    padding: 24px;
                    margin-left: -2.12766%;
                    margin-right: -2.12766%
                }

                .tag-desc-blk .title-blk {
                    -webkit-flex: 0 0 300px;
                    flex: 0 0 300px
                }

                .tag-desc-blk .desc {
                    display: -webkit-flex;
                    display: flex;
                    -webkit-align-items: center;
                    align-items: center;
                    padding-left: 16px;
                    font-size: 1.125em;
                    line-height: 1.66667em
                }
            }

            @media (min-width: 1200px) {
                .tag-desc-blk {
                    display:-webkit-flex;
                    display: flex;
                    -webkit-flex-flow: row nowrap;
                    flex-flow: row nowrap
                }

                .tag-desc-blk .title-blk {
                    -webkit-flex: 0 0 300px;
                    flex: 0 0 300px
                }

                .tag-desc-blk .desc {
                    display: -webkit-flex;
                    display: flex;
                    -webkit-align-items: center;
                    align-items: center;
                    padding-left: 16px;
                    font-size: 1.125em;
                    line-height: 1.66667em;
                    max-width: 760px
                }

                .tag-desc-blk {
                    -webkit-justify-content: space-around;
                    justify-content: space-around;
                    padding: 36px;
                    background: url(/Content/images/content/tag-desc-bg.png) right bottom no-repeat #deecef
                }
            }

            .tag-text-list .link:before {
                font-family: iconfont;
                font-weight: 400;
                text-decoration: none
            }

            .tag-text-list:after {
                content: "";
                display: table;
                clear: both
            }

            .tag-text-list .link,.tag-text-list .link:before {
                display: -webkit-flex;
                -webkit-flex-flow: row nowrap
            }

            .tag-text-list .link,.tag-text-list .title {
                font-family: Roboto,-apple-system,"Microsoft JhengHei",sans-serif
            }

            .tag-text-list {
                padding: 0 12px;
                margin-bottom: 40px
            }

            .tag-text-list .item:not(:last-child) {
                margin-bottom: 12px
            }

            .tag-text-list .link {
                display: flex;
                flex-flow: row nowrap;
                -webkit-align-items: center;
                align-items: center;
                min-width: 0;
                height: 40px;
                text-decoration: none;
                font-size: 1.125em;
                line-height: 1.33333em
            }

            .tag-text-list .link:before {
                display: flex;
                flex-flow: row nowrap;
                -webkit-justify-content: center;
                justify-content: center;
                -webkit-align-items: center;
                align-items: center;
                -webkit-flex: 0 0 20px;
                flex: 0 0 20px;
                content: "";
                width: 20px;
                height: 20px;
                margin-right: 8px;
                background: #1c74cd;
                border-radius: 50%;
                font-size: 11px;
                color: #fff
            }

            .tag-text-list .title {
                display: -webkit-flex;
                display: flex;
                -webkit-flex-flow: row nowrap;
                flex-flow: row nowrap;
                -webkit-align-items: center;
                align-items: center;
                min-width: 0;
                color: #1976d2;
                font-size: 1.125em;
                line-height: 1.33333em
            }

            .tag-text-list .title .name {
                overflow: hidden;
                text-overflow: ellipsis;
                -webkit-flex: 0 1 auto;
                flex: 0 1 auto
            }

            .tag-text-list .title .num {
                margin-left: 8px;
                -webkit-flex: 1 0 auto;
                flex: 1 0 auto
            }

            @media (min-width: 768px) and (max-width:1199px) {
                .tag-text-list .item {
                    float:left;
                    width: calc((100% - 16px * 2)/ 3);
                    margin-right: 16px
                }

                .tag-text-list .item:nth-child(3n) {
                    float: right;
                    margin-right: 0
                }
            }

            @media (min-width: 1200px) {
                .tag-text-list {
                    padding:0 16px
                }

                .tag-text-list .item {
                    float: left;
                    width: calc((100% - 16px * 3)/ 4);
                    margin-right: 16px
                }

                .tag-text-list .item:nth-child(4n) {
                    float: right;
                    margin-right: 0
                }

                .tag-text-list .link:hover:before {
                    background: #11508e
                }

                .tag-text-list .link:hover .name {
                    text-decoration: underline
                }

                .tag-text-list .link:hover .name,.tag-text-list .link:hover .num {
                    color: #11508e
                }
            }

            .tag-tile-list .title:before {
                font-family: iconfont;
                font-weight: 400;
                text-decoration: none
            }

            .tag-tile-list:after {
                content: "";
                display: table;
                clear: both
            }

            .tag-tile-list {
                margin-bottom: 40px;
                border-bottom: 5px #efefef solid
            }

            .tag-tile-list .link {
                position: relative;
                display: block
            }

            .tag-tile-list .title {
                font-family: Roboto,-apple-system,"Microsoft JhengHei",sans-serif;
                display: -webkit-flex;
                display: flex;
                -webkit-flex-flow: column wrap;
                flex-flow: column wrap;
                -webkit-justify-content: center;
                justify-content: center;
                -webkit-align-items: center;
                align-items: center;
                position: absolute;
                top: 0;
                left: 0;
                z-index: 100;
                width: 100%;
                height: 100%;
                padding: 0 16px;
                color: #fff;
                font-size: 1.5em;
                line-height: 1.25em
            }

            .tag-tile-list .title:before {
                display: -webkit-flex;
                display: flex;
                -webkit-flex-flow: row nowrap;
                flex-flow: row nowrap;
                -webkit-justify-content: center;
                justify-content: center;
                -webkit-align-items: center;
                align-items: center;
                content: "";
                width: 55px;
                height: 55px;
                margin-bottom: 16px;
                background: #1c74cd;
                border-radius: 50%;
                font-size: 35px
            }

            .tag-tile-list .title .name {
                width: 100%;
                text-align: center
            }

            .tag-tile-list .thumb-frame {
                padding-bottom: 0;
                height: 245px
            }

            .tag-tile-list .thumb-frame:before {
                content: "";
                display: block;
                width: 100%;
                height: 100%;
                position: absolute;
                top: 0;
                left: 0;
                z-index: 100;
                background: rgba(64,53,100,.65);
                -webkit-transition: opacity .3s;
                -moz-transition: opacity .3s;
                -o-transition: opacity .3s;
                transition: opacity .3s
            }

            @media (min-width: 0) and (max-width:767px) {
                .tag-tile-list {
                    display:none
                }
            }

            @media (min-width: 768px) and (max-width:1199px) {
                .tag-tile-list .item {
                    float:left;
                    width: calc((100% - 16px * 2)/ 3);
                    margin-right: 16px;
                    margin-bottom: 16px
                }

                .tag-tile-list .item:nth-child(3n) {
                    float: right;
                    margin-right: 0
                }

                .tag-tile-list .item:nth-child(4),.tag-tile-list .item:nth-child(6),.tag-tile-list .item:nth-child(8),.tag-tile-list .item:nth-child(9) {
                    width: calc((100% - 16px * 3)/ 4)
                }

                .tag-tile-list .item:nth-child(5),.tag-tile-list .item:nth-child(7) {
                    width: calc((100% - 16px * 1)/ 2)
                }
            }

            @media (min-width: 1200px) {
                .tag-tile-list .item {
                    float:left;
                    width: calc((100% - 4px * 2)/ 3);
                    margin-right: 4px;
                    margin-bottom: 4px
                }

                .tag-tile-list .item:nth-child(3n) {
                    float: right;
                    margin-right: 0
                }

                .tag-tile-list .item:nth-child(4),.tag-tile-list .item:nth-child(6),.tag-tile-list .item:nth-child(8),.tag-tile-list .item:nth-child(9) {
                    width: calc((100% - 4px * 3)/ 4)
                }

                .tag-tile-list .item:nth-child(5),.tag-tile-list .item:nth-child(7) {
                    width: calc((100% - 4px * 1)/ 2)
                }

                .tag-tile-list .title {
                    font-size: 1.875em;
                    line-height: 1.6em
                }

                .tag-tile-list .link:hover .thumb-frame:before {
                    opacity: 0
                }

                .tag-tile-list .link:hover .name {
                    color: #fff;
                    text-shadow: 0 0 4px #000
                }
            }
</style>

