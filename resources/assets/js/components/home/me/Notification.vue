<template>
  <el-row type="flex">
    <el-col :span="24" style="margin:.625rem;">
      <el-card class="box-card">
        <div slot="header" class="clearfix">
          <span style="line-height: 36px;">通知消息</span>
          <el-button style="float: right;" type="primary" @click="markAllRead">全部标记为已读</el-button>
        </div>
        <ul class="notification-list" v-if="!isLoading">
          <template v-if="notifications.length > 0">
            <li v-for="(notification, index) in notifications" :key="index" :class="{read: notification.read_at}" @click="markOneRead(notification, index)" class="text item"> 
              <keep-alive>
                <component :is="notification.type.split('_').join('-')" :notification="notification"></component>
              </keep-alive>
            </li>
          </template>
          <h6 v-else class="text-center">无新的通知</h6>
        </ul>
      </el-card>
    </el-col>
  </el-row>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';

import Like from 'components/notification/LikePost';
import UserFollow from 'components/notification/UserFollow';
import Comment from 'components/notification/UserComment';
import Favorite from 'components/notification/FavoritePost';

export default {
  components: {
    UserFollow,
    'like-talent':Like,
    'favorite-talent':Favorite,
    'talent-comment': Comment,
    'like-offers':Like,
    'favorite-offers':Favorite,
    'offers-comment': Comment,
    'like-post':Like,
    'favorite-post':Favorite,
    'user-comment': Comment,
    'like-active-event':Like,
    'favorite-active-event':Favorite,
    'active-event-comment': Comment
  },
  data() {
    return {
      notifications: [],
      isLoading: false
    }
  },
  computed: {
    ...mapGetters(['currentUser']),
  },
  created() {
    this.loadNotifications();
  },
  methods: {
    ...mapActions(['redOneNot', 'redAllNot']),
    markOneRead(item, index) {
      if (item.read_at == null) {
        this.$http.post(`/admin/me/notifications/read/${item.id}`)
            .then(() => {
              this.notifications[index].read_at = new Date()
              this.redOneNot();
            })
      }
    },
    markAllRead() {
      if (this.currentUser.unread_count) {
        this.$http.post('/admin/me/notifications/read')
            .then(() => {
              this.redAllNot();
              this.loadNotifications();
            })
      }
    },
    loadNotifications() {
      this.isLoading = true;
      this.$http.get('/admin/me/notifications')
          .then((res) => {
            console.log(res.data);
            this.notifications = res.data.data;
            this.isLoading = false;
          })
    }
  }
}
</script>

<style lang="scss" scoped>
h6 {
  color: #999;
}
.readable {
  border-bottom: 1px solid #f8f8f8;
}
.read {
  color: #888;
}
.text {
    font-size: 14px;
  }

  .item {
    padding: 18px 0;
  }

  .clearfix:before,
  .clearfix:after {
      display: table;
      content: "";
  }
  .clearfix:after {
      clear: both
  }

ul.notification-list {
  font-size: .8rem;
  line-height: 30px;

  li {
    list-style: none;

    .content a {
      color: #666;
      font-size: .9rem;
      font-weight: 500;
    }

    &:last-child {
      margin-bottom: 0 !important;
    }
  }
}
</style>
