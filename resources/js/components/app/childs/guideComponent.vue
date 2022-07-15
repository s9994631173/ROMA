<template>
    <div class="app">
        <div class="chapter" v-if="buttons.length > 0">
            <div class="recommend" v-for="(item, index) in buttons" :key="index" @click="select(item.id)"> {{ item.button }} </div>
        </div>

        <div class="chapter" v-if="info">
            <span class="info" v-html="info"></span>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'v-guide',
        data: function(){
            return{
                buttons: [],
                info: null
            }
        },
        methods: {
            select: function(data){
                this.info = null;

                axios.post('/api/guide/select', {
                    button: data
                })
                .then(response => {
                    if(response.data[0].type == 'link'){
                        window.open(response.data[0].info);
                    }else{
                        this.info = response.data[0].info
                    }
                })
            }
        },
        computed: {

        },
        mounted() {
            axios.get('/api/guide/all')
            .then(response => this.buttons = response.data)
        }
    }
</script>