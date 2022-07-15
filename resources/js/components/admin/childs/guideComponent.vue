<template>
    <div class='row justify-content-center'>
        <notifications />
        <div class='col-10'>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <a class="nav-link" href="app#/app/guide" target="_blank">Перейти в модуль</a>
                </div>
            </div>
            <table class='table table-striped table-bordered text-center'>
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Кнопка</th>
                        <th scope="col">Тип</th>
                        <th scope="col">Инфо</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td> <input type="text" name="button" class="form-control" v-model="forAppend.button"/> </td>
                        <td>
                            <select class="form-control" v-model="forAppend.type">
                                <option>text</option>
                                <option>link</option>
                            </select> 
                        </td>
                        <td> <input class="form-control" type="text" name="info" v-model="forAppend.info"/> </td>
                        <td> <button class="btn btn-success" @click="append">добавить</button> </td>
                    </tr>
                    <tr v-for="(item, index) in adminItems" :key="index" @change="change(item)">
                        <td> <input type="text" name="button" class="form-control" v-model="item.button"/> </td>
                        <td>
                            <select class="form-control" v-model="item.type">
                                <option>text</option>
                                <option>link</option>
                            </select> 
                        </td>
                        <td> <input type="text" name="info" class="form-control" v-model="item.info"/> </td>
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
                    button: null,
                    type: 'text',
                    info: null
                },
                adminItems: []
            }
        },
       methods: {
            append: function(){
                axios.post('api/admin/guide/create', this.forAppend)
                .then(response => this.adminItems = response.data.data)
                .catch(err => {
                        this.$notify({
                        text: err.response.data.message,
                        type: 'error'
                        });
                })
            },
            remove: function(obj){
                axios.post('api/admin/guide/delete', obj)
                .then(response => this.adminItems = response.data.data)
                .catch(err => {
                        this.$notify({
                        text: err.response.data.message,
                        type: 'error'
                        });
                })
            },
            change: function(obj){
                axios.post('/api/admin/guide/update', obj)
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
            axios.post('/api/admin/guide/all')
            .then(response => this.adminItems = response.data)
        }
    }
</script>