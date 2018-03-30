<template>
  <div class="content">
    <div style="padding:1.5rem;">
    <!--面包屑导航  -->
    <Breadcrumb></Breadcrumb>
    <transition class="fade">
      <!--路由  -->
      <router-view></router-view>
    </transition>
    </div>
  </div>
</template>
<script>
import Breadcrumb from 'components/layout/breadcrumb';
export default {
  name: 'adminmain',
  components:{
    Breadcrumb
  }
}
</script>


