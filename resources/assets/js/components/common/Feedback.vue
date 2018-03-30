<template>
  <div class="feedback">
    <a href="javascript:void(0);" class="feedback-button" @click.prevent="visible=true">
      <i class="icon-message"></i>
    </a>
    <transition name="modal">
     <el-dialog title="提交反馈" :visible.sync="visible">
        <template>
          <textarea class="feedback-content" rows="5" v-model="feedback.content" placeholder="告诉我们你的建议或遇到的问题。"></textarea>
        </template>
        <div class="buttons">
          <el-button type="primary" :disabled="busying" @click.prevent="onSubmit">提交</el-button>
        </div>
      </el-dialog>
    </transition>
  </div>
</template>

<script>

export default {
  data() {
    return {
      visible: false,
      busying: false,
      feedback: {
        content: ''
      },
    }
  },
  methods: {
    onCancel() {
      this.visible = false
      this.feedback.content = ''
    },
    onSubmit() {
      if(this.feedback.content == '') {
        this.$message.error('反馈内容不能为空')
        return
      }

      this.busying = true
      this.$http.post('/feedback', this.feedback)
          .then(({ data }) => {
            this.$message.success('反馈成功')
            this.feedback.content = ''
            this.busying = false
            this.onCancel()
          });
    },
  }
}
</script>

<style lang="scss" scoped>
.feedback-button {
  position: fixed;
  bottom: 150px;
  right: 60px;
  width: 38px;
  height: 38px;
  line-height: 38px;
  font-size: 1em;
  background-color: #dce7f4;
  color: #fff;
  text-align: center;
  border-radius: 50%;
  cursor: pointer;
  z-index: 1000000;

  &:hover {
    background-color: #bfcbd9;
  }
}
.feedback-content {
  width: 100%;
  border: none;
  resize: none;
  outline: none;
}
.modal {
  display: block;
  position: fixed;
  z-index: 1001;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(250, 250, 250, .5);
  transition: opacity .3s ease;

  .modal-dialog {
    margin-top: 80px;
    max-width: 400px;
  }
}
</style>
