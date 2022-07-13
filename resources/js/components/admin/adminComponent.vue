<template>
    <TopBar/>
    <router-view></router-view>
</template>

<script>
    import TopBar from './topbarComponent.vue';
    export default{
        components: {
            TopBar
        }
    }
</script>