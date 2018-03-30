<template>
  <div class="content">
    <transition class="fade">
        <router-view></router-view>
    </transition>
  </div>
</template>
<script>
export default {
  name: 'appmain'
}
</script>
