<template>
  <button v-if="enabled" class="btn-follow btn" :class="{'btn-outline-primary': !item[checkField], 'btn-primary': item[checkField]}" @click="action"><slot>{{ label }}</slot></button>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {
  props: {
    item: {
      type: Object,
      required: true
    },
    api: {
      type: String,
      default: ''
    },
    type: {
      type: String,
      default: 'follow'
    },
    checkField: {
      type: String,
      default: 'is_following'
    },
    endpoint: {
      type: String,
      default: 'followers'
    },
    labels: {
      type: Object,
      default() {
        return {
          positive: '关注',
          negative: '已关注',
        }
      }
    },
  },
  computed: {
    ...mapGetters(['isLogged', 'currentUser']),
    enabled() {
      return !this.isLogged || this.currentUser.id != this.item.id
    },
    label() {
      return this.item[this.checkField] ? this.labels.negative : this.labels.positive
    }
  },
  methods: {
    action() {
      // followers
      this.$http.post('/admin/me/followers', {id: this.item.id}).then(() => {
        this.toggleStatus()
      }).catch(err => {
        if(err.response.status === 401){
						this.$alert('登入之后才能关注', '请先登入', {
							confirmButtonText: '确定',
							callback: action => {
								this.$router.replace({path:'/login'});
							}
						});
					}else{
						this.$message({
							type: 'wran',
							message: '发生错误，骚后再试'
						});
					}
      })
    },
    toggleStatus() {
      this.item[this.checkField] = !this.item[this.checkField]
    }
  }
}
</script>
<style lang="scss" scoped>
.btn{
  font-weight:normal;
  display: block;
  line-height: 1.25;
  text-align: center;
  white-space: normal;
  vertical-align: middle;
  user-select: none;
  -webkit-user-select: none;
  border: 1px solid transparent;
  padding: .5rem 1rem;
  font-size: 1rem;
  border: 1000em;
  transition: all .2s ease-in-out;
  -webkit-transition: all .2s ease-in-out;
}

.btn-outline-primary{
   border:1px solid #00ab6b;
   color: #00ab6b;;
   background-color: transparent;
  &:hover{
    color: #fff;
    background-color: #00ab6b;
    border-color: #00ab6b;
  }
}
.btn-xs{
  padding: 1rem;
  font-size: .875rem;
  border-radius: 1000em;
}
.btn-follow{
  margin-left: .5em;
  vertical-align: text-bottom;
  font-size: .775em;
}
</style>
