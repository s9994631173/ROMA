<template>
    <div class='row justify-content-center'>
        <notifications />
        <div class='col-10'>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <a class="nav-link" href="app#/app/og" target="_blank">Перейти в модуль</a>
                </div>
            </div>
            <table class='table table-striped table-bordered text-center'>
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Название вложения</th>
                        <th scope="col">Класс опасности</th>
                        <th scope="col">Авиа</th>
                        <th scope="col">Доп сбор</th>
                        <th scope="col">Авто</th>
                        <th scope="col">Примечание</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td> <input type="text" name="itemName" class="form-control" v-model="forAppend.itemName"/> </td>
                        <td> <input type="text" name="classHazard" class="form-control" v-model="forAppend.classHazard"/> </td>
                        <td> <input type="text" name="avia" class="form-control" v-model="forAppend.avia"/> </td>
                        <td> <input type="text" name="addFee" class="form-control" v-model="forAppend.addFee"/> </td>
                        <td> <input type="text" name="auto" class="form-control" v-model="forAppend.auto"/> </td>
                        <td> <input type="text" name="note" class="form-control" v-model="forAppend.note"/> </td>
                        <td> <button class="btn btn-success" @click="append">добавить</button> </td>
                    </tr>
                    <tr v-for="(item, index) in adminItems" :key="index" @change="change(item)">
                        <td> <input type="text" name="itemName" class="form-control" v-model="item.itemName"/> </td>
                        <td> <input type="text" name="classHazard" class="form-control" v-model="item.classHazard"/> </td>
                        <td> <input type="text" name="avia" class="form-control" v-model="item.avia"/> </td>
                        <td> <input type="text" name="addFee" class="form-control" v-model="item.additional_fee"/> </td>
                        <td> <input type="text" name="auto" class="form-control" v-model="item.auto"/> </td>
                        <td> <input type="text" name="note" class="form-control" v-model="item.note"/> </td>
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
                    classHazard: null,
                    avia: null,
                    addFee: null,
                    auto: null,
                    note: null,
                },
                adminItems: []
            }
        },
       methods: {
            append: function(){
                axios.post('api/admin/og/create', this.forAppend)
                .then(response => this.adminItems = response.data.data)
                .catch(err => {
                        this.$notify({
                        text: err.response.data.message,
                        type: 'error'
                        });
                })
            },
            remove: function(obj){
                axios.post('api/admin/og/delete', obj)
                .then(response => this.adminItems = response.data.data)
                .catch(err => {
                        this.$notify({
                        text: err.response.data.message,
                        type: 'error'
                        });
                })
            },
            change: function(obj){
                axios.post('/api/admin/og/update', obj)
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
            axios.post('/api/admin/og/all')
            .then(response => this.adminItems = response.data)
        }
    }
</script>