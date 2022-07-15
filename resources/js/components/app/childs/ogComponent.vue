<template>
    <div class="app">
        <div class="chapter">
            <table>
                <tr>
                    <td><span>Поиск по типу вложения</span></td>
                </tr>
                <tr>
                    <td><input v-model='searchItem'/></td>
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

        <div class="chapter" v-show="prompt">
            <div class="classHazard info" v-if="classHazard">
                <span class="p-green">Класс опасности: </span>
                <span> {{ classHazard }} </span>
            </div>
            <div class="avia info" v-if="avia">
                <span class="p-green">На АВИА: </span>
                <span> {{ avia }} </span>
            </div>
            <div class="additionalFee info" v-if="additionalFee">
                <span class="p-green">Доп. сбор «опасный груз» на АВИА: </span>
                <span> {{ additionalFee }} </span>
            </div>
            <div class="auto info" v-if="auto">
                <span class="p-green">Возможна перевозка  ЗЕМЛЕЙ: </span>
                <span> {{ auto }} </span>
            </div>
            <div class="note info" v-if="note">
                <span class="p-green">Примечания: </span>
                <span> {{ note }} </span>
            </div>
        </div>

        <div class='chapter'>
            <span><a href="https://wiki.cdek.ru/department/view?id=141" target="_blank">Документация по опасным грузам</a></span>
            <span><a href="https://corp.cdek.ru/plugins/servlet/desk/project/DG" target="_blank">24/7 консультация по ОГ</a><br> (классификация/идентификация/возможность перевозки и пр.)</span>
            
            <span>Тел.: +7 495 797 81 08 доб. 77097,<br>Тел. моб.: +7 926 295-37-18</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ogComponent',
        data: function(){
            return{
                searchItem: null,
                recommends: [],
                classHazard: null,
                avia: null,
                additionalFee: null,
                auto: null,
                note: null,
                notfound: false,

                prompt: false
            }
        },
        methods: {
            select: function(data){
                axios.post('/api/og/search', {
                    item: data
                })
                .then(response => {
                    this.classHazard = response.data[0].classHazard
                    this.avia = response.data[0].avia
                    this.additionalFee = response.data[0].additionalFee
                    this.auto = response.data[0].auto
                    this.note = response.data[0].note

                    this.prompt = true
                })
            }
        },
        watch: {
            searchItem (){
                this.notfound = false
                if(this.searchItem.length > 3){
                    this.prompt = false

                    axios.post('/api/og/presearch', {
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