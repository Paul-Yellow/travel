<template>
  <div class="vote-button">
    <div class="vote" :class="item.is_voting ? 'active' : ''" @click="upVote(item.id)">
      <img src="/images/svg/up.svg" class="material-icons" style="width:14px;height:14px;"/> {{ item.vote_count > 0 ? item.vote_count : '' }}
    </div>
    <div class="vote" :class="item.is_down_voting ? 'active' : ''" @click="downVote(item.id)">
      <img src="/images/svg/down.svg" class="material-icons"   style="width:14px;height:14px;"/>
  </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
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
  },
  computed: {
    ...mapGetters(['isLogged']),
  },
  methods: {
    upVote(id) {
      this.toggleVote(id, 'up')
    },
    downVote(id) {
      this.toggleVote(id, 'down')
    },
    toggleVote(id, type) {
      let url = this.api + '/' + type
      let upType = 'is_voting'
      let downType = 'is_down_voting'
      let checkType = type == 'up' ? downType : upType
      let votingType = type == 'up' ? upType : downType

      this.$http.post(url, {id: id})
          .then(() => {
            if(this.item[checkType]) {
              this.item[upType] = !this.item[upType]
              this.item[downType] = !this.item[downType]
              type == 'up' ? this.item.vote_count++ : this.item.vote_count--
            } else {
              this.item[votingType] = !this.item[votingType]
              if(type == 'up') this.item[upType] ? this.item.vote_count++ : this.item.vote_count--
            }
          }).catch(err => {
            if(err.response.status === 401){
              this.$alert('登入之后才能点赞', '请先登入', {
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
  }
}
</script>

<style lang="scss" scoped>
.vote {
  display: inline-block;
  padding: 5px 10px;
  color: #dce7f4;
  border: 1px solid #dce7f4;
  border-radius: 5px;
  cursor: pointer;
  -webkit-filter: grayscale(100%);
  filter: grayscale(100%);
}
.active {
  color: #00ab6b;
  border: 1px solid #00ab6b;
  -webkit-filter: grayscale(0%);
  filter: grayscale(0%);
}
</style>
