<template>
    <div class="app">
        <div class='importexport_docs chapter'>
            <span><a href="https://wiki.cdek.ru/document/view?id=10738" target="_blank">Подробное описание приема посылок из РФ в ЕАЭС в СОП 009</a></span>
        </div>

        <div class="chapter">
            <table id='importexport'>
                <tr>
                    <td><span class="centrtext">Поиск по названию вложения</span></td>
                </tr>
                <tr>
                    <td><input id='item_importexport' v-model='searchItem'/></td>
                </tr>
                <tr v-if="notfound">
					<td><span class="p-green">Я ничего не смог найти :(</span></td>
				</tr>
            </table>
        </div>

        <div class="chapter" v-if="recommends.length > 0">
            <span>РЕКОМЕНДАЦИИ</span>
            <span class="p-green">кликни, чтобы выбрать</span>
            <div class="recommends">
                <div class="recommend" v-for="(item, index) in recommends" :key="index" @click="select(item.itemName)"> {{ item.itemName }} </div>
            </div>
        </div>

        <div class="chapter" v-if="about">
            <span class="text-header">ИНФО</span>
            <span class="info" v-html="about"></span>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'exportComponent',
        data: function(){
            return{
                searchItem: null,
                recommends: [],
                about: null,
                notfound: false
            }
        },
        methods: {
            select: function(data){
                axios.post('/api/export/search', {
                    item: data
                })
                .then(response => this.about = response.data[0].about)
            }
        },
        watch: {
            searchItem (){
                this.notfound = false
                if(this.searchItem.length > 3){
                    axios.post('/api/export/presearch', {
                        item: this.searchItem
                    })
                    .then(response => {
                        if(response.data.length == 0){
                            this.notfound = true
                        }
                        this.recommends = response.data
                    })
                }
            }
        },
        mounted(){
            this.searchItem = this.$route.query.value ? this.$route.query.value: null
        }
    }
</script>