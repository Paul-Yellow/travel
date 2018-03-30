<template>
  <div>
    <img :src="user.avatar" :alt="user.name" class="avatar rounded-circle" >
    <span>{{user.name}}</span>
  </div>
</template>

<script>
export default {
    props: {
      user: {
        type: Object,
        default: function(){
          return {
            avatar: '/images/default-avatar.png'
          }
        }
      }
    },
}
</script>

<style lang="scss" scoped>
.avatar{
  width: 45px;
  height: 45px;
  border-radius: 50%;
}
</style>

