<template>
<aside class="sidebar">
  <el-menu  mode="vertical"  :default-active="$route.path" style="height:100%"  :collapse="isCollapse" background-color="#304156" text-color="#bfcbd9" active-text-color="#409EFF">
        <template v-for="(item,index) in permissionRoutes" v-if="!item.hidden">
            <el-submenu :index="item.name" v-if="!item.noDropdown" :key="index">
                <template slot="title">
                    <i v-bind:class="item.iconname"></i>
                    <span class="is-name">{{item.name}}</span>
                </template>
                <el-menu-item-group>
                    <span slot="title">
                        <router-link v-for="child in item.children" :key="child.path" v-if="!child.hidden"
                                class="title-link" :to="item.path+'/'+child.path">
                            <el-menu-item :index="item.path+'/'+child.path">
                                <i v-bind:class="child.iconname"></i>
                                <span class="is-name">{{child.name}}</span>
                            </el-menu-item>
                        </router-link>
                    </span>
                </el-menu-item-group>
            </el-submenu>
            <router-link v-if="item.noDropdown&&item.children.length>0" class="title-link"
                         :to="item.path+'/'+item.children[0].path" :key="index">
                <el-menu-item
                        :index="item.path+'/'+item.children[0].path">
                        <i v-bind:class="item.iconname"></i>
                    <span slot="title" class="is-name" v-if="item.children[0].name&&item.children[0].name">{{item.children[0].name}}</span>
                </el-menu-item>
            </router-link>
        </template>
  </el-menu>
</aside>
</template>
<script>
import permissionRoutes from 'store/permission';
import {mapGetters} from 'vuex';
export default {
  name: 'sidebar',
  data () {
      return{
        permissionRoutes: permissionRoutes.get()
      }
  },
  computed:{
    ...mapGetters(['getIsOpen']),
    isCollapse() {
        return this.getIsOpen
    }
  }
}
</script>

