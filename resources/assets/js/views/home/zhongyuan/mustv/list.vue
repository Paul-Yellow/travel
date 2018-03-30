<template>
  <div  v-loading="isLoading"
      element-loading-text="拼命加载中" v-if="!isLoading">
    <div class="unit-title-blk bg-slash">
      <Breadcrumb class="breadcrumb"></Breadcrumb>
      <h2 class="unit-title icon-unit-play">{{$route.name}}</h2>
    </div>
    <div class="page-content-wrapper member-wrapper"> 
      <div class=""> 
        <div class="mustvisit-list-blk"> 
          <div class="list-blk" v-for="(item,index) in list" :key="index"> 
            <router-link :to="'/mustv-visit/'+item.link" class="frame" :title="item.name"  style="text-decoration: none;color: #666;">
              <span class="thumb-frame">
                <img :src="'/images/mustv/'+item.image" :alt="item.name" class="thumb lazyloaded">
              </span>
              <span class="list-page-name">{{item.name}}</span>
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Breadcrumb from 'components/layout/breadcrumb';
export default {
  name: 'mustvList',
  components:{
    Breadcrumb
  },
  data(){
    return {
      isLoading: false,
      list: []
    }
  },
  methods:{
    initData(){
      this.isLoading = true;
      this.$http.get('/mustv')
        .then(({data})=>{
            if(data.responData.status === 200){
                this.list = data.responData.list;
                this.isLoading = false;
            }
        });
    }
  },
  mounted(){
    this.initData();
  }
}
</script>
<style lang="scss" scoped>
.thumb-frame {
                position: relative;
                display: block;
                height: 0;
                padding-bottom: 75%;
                background: #a7d3cb;
                background: -owg-linear-gradient(135deg,#4ab9e1 0,#b9e0e6 60%);
                background: -webkit-linear-gradient(135deg,#4ab9e1 0,#b9e0e6 60%);
                background: -moz-linear-gradient(135deg,#4ab9e1 0,#b9e0e6 60%);
                background: -o-linear-gradient(135deg,#4ab9e1 0,#b9e0e6 60%);
                background: linear-gradient(135deg,#4ab9e1 0,#b9e0e6 60%)
            }

            .thumb-frame .thumb,.thumb-frame.smartcrop .crop {
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0
            }

            .thumb-frame .crop {
                display: none
            }

            .thumb-frame .thumb {
                opacity: 0;
                object-fit: cover;
                -webkit-transition: opacity .6s ease;
                -webkit-transition-delay: 0;
                -moz-transition: opacity .6s ease 0;
                -o-transition: opacity .6s ease 0;
                transition: opacity .6s ease 0
            }

            .thumb-frame .thumb.lazyloaded {
                opacity: 1
            }

            .thumb-frame.smartcrop .thumb {
                opacity: 0!important;
                z-index: 100
            }

            .thumb-frame.smartcrop .crop {
                display: block;
                z-index: 0;
                filter: blur(3px);
                opacity: 0;
                -webkit-transition: all .5s;
                -moz-transition: all .5s;
                -o-transition: all .5s;
                transition: all .5s
            }

            .thumb-frame.smartcrop .show {
                filter: blur(0);
                opacity: 1
            }
 .mustvisit-list-blk {
                position: relative;
                width: 100%;
                padding: 0;
                margin: 0 auto;
                display: -webkit-flex;
                display: flex;
                -webkit-flex-flow: row wrap;
                flex-flow: row wrap;
                -webkit-justify-content: space-between;
                justify-content: space-between
            }

            .mustvisit-list-blk .list-blk {
                width: 48%;
                margin-bottom: 36px
            }

            .mustvisit-list-blk .frame {
                color: #333;
                text-decoration: none;
                font-size: .9375em;
                line-height: 1.92em
            }

            .mustvisit-list-blk .frame:hover {
                text-decoration: underline
            }

            .mustvisit-list-blk .frame .list-page-name {
                display: block;
                padding: 0 5px
            }

            .mustvisit-list-blk .thumb-frame {
                padding-bottom: 41%
            }

            @media (min-width: 0) and (max-width:767px) {
                .mustvisit-list-blk .list-blk {
                    width:100%;
                    margin-bottom: 12px
                }
            }

            @media (min-width: 768px) and (max-width:1199px) {
                .mustvisit-list-blk .list-blk {
                    width:48%;
                    margin-bottom: 36px
                }
            }

            @media (min-width: 1200px) {
                .mustvisit-list-blk .list-blk {
                    width:48%;
                    margin-bottom: 36px
                }
            }

            .mustvisit-list-page {
                position: relative;
                width: 100%
            }

            .mustvisit-list-page .list-other {
                display: -webkit-flex;
                display: flex;
                -webkit-flex-flow: row wrap;
                flex-flow: row wrap;
                -webkit-justify-content: space-between;
                justify-content: space-between
            }

            .mustvisit-list-page .title {
                position: relative;
                z-index: 1;
                color: #666;
                font-weight: 800;
                text-align: center
            }

            .mustvisit-list-page .list-blk {
                z-index: 1
            }

            .mustvisit-list-page .frame {
                color: #333;
                text-decoration: none;
                font-size: .9375em;
                line-height: 1.92em
            }

            .mustvisit-list-page .frame:hover {
                text-decoration: underline
            }

            .mustvisit-list-page .frame .list-page-name {
                display: block;
                padding: 0 5px
            }

            .mustvisit-list-page .thumb-frame {
                padding-bottom: 100%
            }

            .mustvisit-list-page:after {
                content: "";
                position: absolute;
                display: block;
                top: 0;
                left: 50%;
                width: 100vw;
                height: 100%;
                background: #eee;
                -webkit-transform: translateX(-50%);
                -moz-transform: translateX(-50%);
                -ms-transform: translateX(-50%);
                -o-transform: translateX(-50%);
                transform: translateX(-50%);
                z-index: 0
            }

            @media (min-width: 0) and (max-width:767px) {
                .mustvisit-list-page .title {
                    font-size:1.25em;
                    line-height: 1.44em;
                    padding: 36px 0 18px
                }

                .mustvisit-list-page .list-blk {
                    width: 49%;
                    margin-bottom: 24px
                }
            }

            @media (min-width: 768px) and (max-width:1199px) {
                .mustvisit-list-page .title {
                    font-size:1.5em;
                    line-height: 1.2em;
                    padding: 48px 0 24px
                }

                .mustvisit-list-page .list-blk {
                    width: 24%;
                    margin-bottom: 36px
                }
            }

            @media (min-width: 1200px) {
                .mustvisit-list-page .title {
                    font-size:1.5em;
                    line-height: 1.2em;
                    padding: 48px 0 24px
                }

                .mustvisit-list-page .list-blk {
                    width: 24%;
                    margin-bottom: 36px
                }
            }
</style>