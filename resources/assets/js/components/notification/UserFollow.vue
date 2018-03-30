<template>
  <el-row>
    <el-col :span="24">
      <span>
        <img class="rounded-circle mr-2" width="30" :src="notification.data.avatar">
        {{ notification.data.name }}
      </span>
      <span class="mx-2">关注了你</span>
      <div class="date">{{ notification.created_at }}</div>
    </el-col> 
  </el-row>
</template>

<script>
export default {
  props: {
    notification: {
      type: Object,
      default: null
    }
  }
}
</script>
