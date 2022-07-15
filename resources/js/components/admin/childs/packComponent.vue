<template>
    <div class='row justify-content-center'>
        <notifications />
        <div class="row justify-content-center">
                <div class="col-auto">
                    <a class="nav-link" href="app#/app/pack" target="_blank">Перейти в модуль</a>
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
                        <td> <input type="text" name="category" class="form-control" v-model="forAppend.category"/> </td>
                        <td> <input type="text" name="char" class="form-control" v-model="forAppend.char"/> </td>
                        <td> <input type="text" name="aboutItem" class="form-control" v-model="forAppend.aboutItem"/> </td>
                        <td> <input type="text" name="pack" class="form-control" v-model="forAppend.pack"/> </td>
                        <td> <input type="text" name="method" class="form-control" v-model="forAppend.method"/> </td>
                        <td> <button class="btn btn-success" @click="append">добавить</button> </td>
                    </tr>
                    <tr v-for="(item, index) in adminItems" :key="index" @change="change(item)">
                        <td> <input type="text" name="category" class="form-control" v-model="item.category"/> </td>
                        <td> <input type="text" name="char" class="form-control" v-model="item.char"/> </td>
                        <td> <input type="text" name="aboutItem" class="form-control" v-model="item.aboutItem"/> </td>
                        <td> <input type="text" name="pack" class="form-control" v-model="item.pack"/> </td>
                        <td> <input type="text" name="method" class="form-control" v-model="item.method"/> </td>
                        <td> <button class="btn btn-danger" @click="remove(item)">удалить</button> </td>
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
                forAppend: {
                    category: null,
                    char: null,
                    aboutItem: null,
                    pack: null,
                    method: null
                },
                adminItems: []
            }
        },
        methods: {
            append: function(){
                axios.post('api/admin/pack/create', this.forAppend)
                .then(response => this.adminItems = response.data.data)
                .catch(err => {
                        this.$notify({
                        text: err.response.data.message,
                        type: 'error'
                        });
                })
            },
            remove: function(obj){
                axios.post('api/admin/pack/delete', obj)
                .then(response => this.adminItems = response.data.data)
                .catch(err => {
                        this.$notify({
                        text: err.response.data.message,
                        type: 'error'
                        });
                })
            },
            change: function(obj){
                axios.post('/api/admin/pack/update', obj)
                .then(response => this.adminItems = response.data.data)
                .catch(err => {
                        this.$notify({
                        text: err.response.data.message,
                        type: 'error'
                        });
                })
            }
        },
        mounted() {
            axios.post('/api/admin/pack/all')
            .then(response => this.adminItems = response.data)
        }
    }
</script>