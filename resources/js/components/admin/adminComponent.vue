<template>
    <TopBar/>
    <router-view></router-view>
</template>

<script>
    import TopBar from './topbarComponent.vue';
    export default{
        components: {
            TopBar
        },
        mounted (){
            axios.post('/api/checkLogin')
            .catch(() => this.$router.push('/login'))
        }
    }
</script>