<template>
    <div class='row justify-content-center'>
        <modal name='alerts' 
            @closed="closeAlerts" 
            :adaptive="true" 
            :draggable="true"
            classes="alerts"
            >
            <ul v-for="(error, index) in errors" :key="index">
                <li>{{error[0]}}</li>
            </ul>
        </modal>
        <div class="row justify-content-center">
                <div class="col-auto">
                    <a class="nav-link" href="/app/#/pack" target="_blank">Перейти в модуль</a>
                </div>
            </div>
        <div class='col-10'>
            <table class='table table-striped table-bordered text-center'>
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Категория</th>
                        <th scope="col">Характеристика</th>
                        <th scope="col">Описание вложения</th>
                        <th scope="col">Упаковка</th>
                        <th scope="col">Метод</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td> <input type="text" name="category" class="form-control" v-model="appendCategory"/> </td>
                        <td> <input type="text" name="char" class="form-control" v-model="appendChar"/> </td>
                        <td> <input type="text" name="aboutItem" class="form-control" v-model="appendAboutItem"/> </td>
                        <td> <input type="text" name="pack" class="form-control" v-model="appendPack"/> </td>
                        <td> <input type="text" name="method" class="form-control" v-model="appendMethod"/> </td>
                        <td> <button class="btn btn-success" @click="append">добавить</button> </td>
                    </tr>
                    <tr v-for="(item, index) in allCategorys" :key="index" :name="item.id" @change="change(item)">
                        <td> <input type="text" name="category" class="form-control" v-model="item.category"/> </td>
                        <td> <input type="text" name="char" class="form-control" v-model="item.char"/> </td>
                        <td> <input type="text" name="aboutItem" class="form-control" v-model="item.aboutItem"/> </td>
                        <td> <input type="text" name="pack" class="form-control" v-model="item.pack"/> </td>
                        <td> <input type="text" name="method" class="form-control" v-model="item.method"/> </td>
                        <td> <button class="btn btn-danger" @click="remove(item.id)">удалить</button> </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return{
                appendCategory: null,
                appendChar: null,
                appendAboutItem: null,
                appendPack: null,
                appendMethod: null,

                allCategorys: [],
                errors: null
            }
        },
        methods: {
            append: function(){
                let form = new FormData;
                form.append('category', this.appendCategory);
                form.append('char', this.appendChar);
                form.append('aboutItem', this.appendAboutItem);
                form.append('pack', this.appendPack);
                form.append('method', this.appendMethod);

                fetch('/api/admin/pack/create', {
                    method: 'POST',
                    body: form
                })
                .then(response => response.json())
                .then(response => {
                    if(response.success){
                        this.errors = false
                        this.allCategorys = response.data

                        this.appendCategory = null
                        this.appendChar = null
                        this.appendAboutItem = null,
                        this.appendPack = null,
                        this.appendMethod = null
                    }else{
                        this.errors = response.data
                    }
                })
            },
            remove: function(id){
                let form = new FormData;
                form.append('id', id);

                fetch('/api/admin/pack/delete', {
                    method: 'POST',
                    body: form
                })
                .then(response => response.json())
                .then(response => this.allCategorys = response)
            },
            change: function(obj){
                let form = new FormData;
                form.append('id', obj.id);
                form.append('category', obj.category);
                form.append('char', obj.char);
                form.append('aboutItem', obj.aboutItem);
                form.append('pack', obj.pack);
                form.append('method', obj.method);

                fetch('/api/admin/pack/update', {
                method: 'POST',
                body: form
                })
                .then(response => response.json())
                .then(response => {
                    if(response.success){
                        this.allCategorys = response.data
                    }else{
                        this.errors = response.data
                    }
                })
            },
            closeAlerts: function(){
                console.log('close')
                this.errors = false
            }
        },
        computed: {
            alerts: function(){
                if (this.errors){
                    this.$modal.show('alerts')
                }
            }
        },
        mounted() {
            fetch('/api/admin/pack/all', {
                method: 'GET'
            })
            .then(response => response.json())
            .then(response => this.allCategorys = response)
        }
    }
</script>