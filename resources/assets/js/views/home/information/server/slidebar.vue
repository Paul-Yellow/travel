<template>
  <div class="content-right-blk"> 
    <div class="right-nav-blk yellow"> 
      <ul class="right-nav-list"> 
        <li class="item" v-for="(item,index) in server" :key="index"> 
          <router-link class="link" :to="item.url" :title="item.name"> 
            <img :src="item.img" :alt="item.name" class="thumb lazyloaded"> 
            <strong class="title">{{item.name}}</strong>
          </router-link>
        </li> 
      </ul>
    </div>  
  </div>
</template>
<script>
import {server} from 'utils/mock';
export default {
  data(){
    return{
      server: server
    }
  }
}
</script>
