<template>
    <router-view></router-view>
</template>

<script>
export default{
    mounted(){
        axios.get('/sanctum/csrf-cookie')
        .then(response => {})
    }
}
</script>