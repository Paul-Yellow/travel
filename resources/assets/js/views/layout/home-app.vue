<template>
    <div class="main-container" id="main-container">
         <navbar ></navbar> 
        <app-main></app-main>
        <app-footer></app-footer> 
        
    </div>
</template>
<script>
import Navbar from 'components/layout/home/navbar';
import AppMain from 'components/layout/home/app-main';
import AppFooter from 'components/layout/home/footer';

export default{
    components:{
        Navbar,
        AppMain,
        AppFooter
    }
};
</script>
