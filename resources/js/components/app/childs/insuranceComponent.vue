<template>
    <div class="app">
        <div class="chapter" v-if="buttons.length > 0">
            <div class="recommend" v-for="(item, index) in buttons" :key="index" @click="select(item.id)"> {{ item.button }} </div>
        </div>

        <div class="chapter" v-if="info">
            <span class="left-text" v-html="info"></span>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'v-insurance',
        data: function(){
            return{
                buttons: [],
                info: null
            }
        },
        methods: {
            select: function(data){
                this.info = null;
                
                let form = new FormData;
                form.append('button', data);

                fetch('/api/insurance/select', {
                    method: 'POST',
                    body: form
                })
                .then(response => response.json())
                .then(response => {
                    if(response[0].type == 'link'){
                        window.open(response[0].info);
                    }else{
                        this.info = response[0].info
                    }
                })
            }
        },
        computed: {

        },
        mounted() {
            fetch('/api/insurance/all', {
                method: 'GET'
            })
            .then(response => response.json())
            .then(response => this.buttons = response)
        }
    }
</script>