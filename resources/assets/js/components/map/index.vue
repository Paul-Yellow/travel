<template>
  <section id="map">
    <el-amap vid="amapDemo" :zoom="zoom" :center="center" class="amap-demo"  :plugin="plugin">
        <el-amap-marker v-for="(marker, index) in markers" :key="index"   :position="marker.position" :events="marker.events" :visible="marker.visible" :draggable="marker.draggable" :vid="index"></el-amap-marker>
    </el-amap>
  </section>
</template>
<script>
export default {
  data() {
    return {
        // zoom: 18,
        // center: [this.ln,this.lo],
        // events: {
        //   init: (o) => {
        //     o.getCity(result => {
        //       // console.log(result)
        //     })
        //   },
        //   'moveend': () => {
        //   },
        //   'zoomchange': () => {
        //   }
        // },
        // plugin: ['ToolBar', {
        //   pName: 'MapType',
        //   defaultType: 0,
        //   events: {
        //     init(o) {
        //       // console.log(o);
        //     }
        //   }
        // }],
        // markers: [
        //   {
        //     position: [this.ln,this.lo],
        //     events: {
        //       click: () => {
        //         this.$notify({
        //           title: '欢迎到万家山庄农家乐',
        //           message: '我们地址就在中源超市的后面',
        //           offset: 250,
        //           type: 'info'
        //         });
        //       },
        //       dragend: (e) => {
        //         this.markers[0].position = [e.lnglat.lng, e.lnglat.lat];
        //       }
        //     },
        //     visible: true,
        //     draggable: false
        //   }
        // ]
          count: 1,
          slotStyle: {
            padding: '2px 8px',
            background: '#eee',
            color: '#333',
            border: '1px solid #aaa'
          },
          zoom: 18,
          center: [this.ln,this.lo],
          plugin: ['ToolBar', {
            pName: 'MapType',
            defaultType: 0,
            events: {
              init(o) {
                console.log(o);
              }
            }
          }],
          markers: [
            {
              position: [this.ln,this.lo],
              events: {
                click: () => {
                  this.$notify({
                    title: '欢迎到万家山庄农家乐',
                    message: '我们地址就在中源超市的后面',
                    offset: 250,
                    type: 'info'
                  });
                },
                dragend: (e) => {
                  console.log('---event---: dragend')
                  this.markers[0].position = [e.lnglat.lng, e.lnglat.lat];
                }
              },
              visible: true,
              draggable: false,
              template: '<span>1</span>',
            }
          ]
      };
  },
  props:{
    lo:{
      type: [Number,String],
      required: true
    },
    ln:{
      type:[Number,String],
      required:true
    }
  }
}
</script>
<style lang="scss" scoped>
 .amap-demo {
      height: 300px;
}
</style>

