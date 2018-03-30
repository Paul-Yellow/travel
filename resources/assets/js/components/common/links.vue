<template>
  <div @click="onFavourite" >
			<el-popover
			ref="popover1"
			placement="top-start"
			title="点赞人数"
			width="200"
			trigger="hover"
			:content="item.like_count+ '人' ">
		</el-popover>
		<button class="btn-add-diamond-1"   title="点赞" :class="item['has_'+type]? 'remove' : '' " v-popover:popover1> 点赞 </button>
  </div>
</template>
<script>
export default {
	name: 'links',
	props:{
		item:{
			type: Object,
			required: true
		},
		type:{
			type: String,
			default: 'link'
		},
		api: {
			type: String,
			default: ''
		}
	},
  methods:{
    onFavourite(){
      this.$http.post(this.api,{id:this.item.id})
        .then((res)=>{
          this.toggleStatus();
        }).catch(err=>{
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
        });
		},
		toggleStatus(){
			this.item['has_'+this.type] = !this.item['has_'+this.type];
		}
  }
}
</script>
