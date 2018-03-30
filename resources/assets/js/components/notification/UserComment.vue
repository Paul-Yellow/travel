<template>
  <el-row>
    <el-col :span="24">
      <span>
        <img class="rounded-circle mr-2" width="30" :src="notification.data.user.avatar">
        {{ notification.data.user.name }}
      </span>
      <span class="mx-2">评论了你的文章 《{{ notification.data.post.title  || notification.data.post.name }}》</span>
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
