<template>
  <div>
    <transition class="fade">
      <el-breadcrumb class="app-levelbar" separator="/">
        <el-breadcrumb-item v-for="(item,index)  in levelList" :key="index">
          <router-link v-if='item.redirect==="noredirect"||index==levelList.length-1' to="" class="no-redirect">{{item.name}}</router-link>
          <router-link v-else :to="item.path">{{item.name}}</router-link>
        </el-breadcrumb-item>
      </el-breadcrumb>
    </transition>  
  </div>
</template>
<script>
export default {
  name: 'breadcrumb',
  data() {
    return {
      levelList: null
    }
  },
  created() {
    this.getBreadcrumb()
  },
  methods: {
    getBreadcrumb() {
      let matched = this.$route.matched.filter(item => item.name);
      const first = matched[0];
      if (first && (first.name !== '首页' || first.path !== '')) {
        matched = [{ name: '首页', path: '/' }].concat(matched)
      }
      this.levelList = matched;
    }
  },
  watch: {
    $route() {
      this.getBreadcrumb();
    }
  }
}
</script>
<style lang="scss">
.app-levelbar.el-breadcrumb {
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    -webkit-flex-direction: row;
    -webkit-flex-wrap: nowrap;
    -moz-flex-direction: row;
    -moz-flex-wrap: nowrap;
    justify-content: flex-start;
    -moz-justify-content: flex-start;
    -webkit-justify-content: flex-start;
    font-size: 14px;
    line-height: 50px;
    margin-left: 10px;
    .no-redirect{
      color: #97a8be;
      cursor:text;
    }
}
</style>
