<template>
    <div class='row justify-content-center'>
        <notifications />
        <div class='col-10'>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <a class="nav-link" href="app#/app/export" target="_blank">Перейти в модуль</a>
                </div>
            </div>
            <table class='table table-striped table-bordered text-center'>
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Название вложения</th>
                        <th scope="col">Информация</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td> <input type="text" name="itemName" class="form-control" v-model="forAppend.itemName"/> </td>
                        <td> <input type="text" name="about" class="form-control" v-model="forAppend.about"/> </td>
                        <td> <button class="btn btn-success" @click="append">добавить</button> </td>
                    </tr>
                    <tr v-for="(item, index) in adminItems" :key="index" @change="change(item)">
                        <td> <input type="text" name="itemName" class="form-control" v-model="item.itemName"/> </td>
                        <td> <input type="text" name="about" class="form-control" v-model="item.about"/> </td>
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
                    itemName: null,
                    aboutItem: null
                },
                adminItems: []
            }
        },
        methods: {
            append: function(){
                axios.post('api/admin/export/create', this.forAppend)
                .then(response => this.adminItems = response.data.data)
                .catch(err => {
                        this.$notify({
                        text: err.response.data.message,
                        type: 'error'
                        });
                })
            },
            remove: function(obj){
                axios.post('api/admin/export/delete', obj)
                .then(response => this.adminItems = response.data.data)
                .catch(err => {
                        this.$notify({
                        text: err.response.data.message,
                        type: 'error'
                        });
                })
            },
            change: function(obj){
                axios.post('/api/admin/export/update', obj)
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
            axios.post('/api/admin/export/all')
            .then(response => this.adminItems = response.data)
        }
    }
</script>