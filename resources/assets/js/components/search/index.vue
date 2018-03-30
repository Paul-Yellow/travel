<template>
  <div class="filter-container">
      <el-input @keyup.enter.native="handleFilter"  class="filter-item" placeholder="标题" v-model="listQuery.title">
      </el-input>

<!-- 
      <el-select clearable class="filter-item"  v-model="listQuery.type" placeholder="类型">
        <el-option v-for="item in  search" :key="item.key" :label=" '('+item.key+')'+item.display_name" :value="item.key">
        </el-option>
      </el-select> -->

      <el-button class="filter-item" type="primary"  icon="search" @click="handleFilter">搜索</el-button>
      <el-button class="filter-item"  @click="handleCreate" type="primary" icon="edit">添加</el-button>
      <el-button class="filter-item" type="primary" icon="document" @click="handleDownload">导出</el-button>
  </div>
</template>
<script>
export default {
  name: 'search',
  props:{
    // search:{
    //   type: [Array,Object],
    //   required:true
    // },
    linkrouter: {
      type: [String],
      required: true
    },
    list:{
      type:[Array,Object],
      required:false
    }
  },
  methods:{
    handleFilter(){
      // 将搜索结果返回父组建
      let result = this.list.filter((item)=>{
        if(item.name){
          return item.name.indexOf(this.listQuery.title) !== -1;
        }else{
          return true;
        }
        
      });
      this.$emit('listenList',result);
    },
    handleCreate() {
      let path = this.linkrouter;
      this.$router.push({path: path});
    },
    handleDownload(){
      console.log('down');
    }
  },
  data(){
    return{
      listQuery: {
        title: undefined,
        // type:undefined
      }
    }
  },


}
</script>
<style lang='scss'>
.filter-container
{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-between;

    -moz-flex-direction: row;
    -moz-flex-wrap: wrap;
    -moz-justify-content: space-between;

    -webkit-flex-direction: row;
    -webkit-flex-wrap: wrap;
    -webkit-justify-content: space-between;

    .filter-item
    {
      width: 13%;
      margin-left: 5px;
      margin-right: 5px;
      margin-bottom: 10px;
    }
    
}
</style>
