<template>
    <div class='row justify-content-center'>
        <notifications />
        <div class='col-12'>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <h1 class="display-4">Договоры и контрагенты</h1>
                </div>
            </div>
            <table class='table table-striped table-bordered text-center'>
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Контрагент</th>
                        <th scope="col">Договор</th>
                        <th scope="col">Сообщение</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td> <input type="text" name="contragent" class="form-control" v-model="forAppend.contragent"/> </td>
                        <td> <input type="text" name="contract" class="form-control" v-model="forAppend.contract"/> </td>
                        <td> <input type="text" name="message" class="form-control" v-model="forAppend.message"/> </td>
                        <td> <button class="btn btn-success" @click="append">добавить</button> </td>
                    </tr>
                    <tr v-for="(item, index) in adminItems" :key="index" @change="change(item)">
                        <td> <input type="text" name="contragent" class="form-control" v-model="item.contragent"/> </td>
                        <td> <input type="text" name="contract" class="form-control" v-model="item.contract"/> </td>
                        <td> <input type="text" name="message" class="form-control" v-model="item.message"/> </td>
                        <td> <button class="btn btn-danger" @click="remove(item)">удалить</button> </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

    export default {
        data: function(){
            return{
                forAppend: {
                    contragent: null,
                    contract: null,
                    message: null
                },
                adminItems: []
            }
        },
        methods: {
                append: function(){
                    axios.post('api/admin/cc/dd/create', this.forAppend)
                    .then(response => this.adminItems = response.data.data)
                    .catch(err => {
                            this.$notify({
                            text: err.response.data.message,
                            type: 'error'
                            });
                    })
                },
                remove: function(obj){
                    axios.post('api/admin/cc/dd/delete', obj)
                    .then(response => this.adminItems = response.data.data)
                    .catch(err => {
                            this.$notify({
                            text: err.response.data.message,
                            type: 'error'
                            });
                    })
                },
                change: function(obj){
                    axios.post('/api/admin/cc/dd/update', obj)
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
                axios.post('/api/admin/cc/dd/all')
                .then(response => this.adminItems = response.data)
            }
    }
</script>