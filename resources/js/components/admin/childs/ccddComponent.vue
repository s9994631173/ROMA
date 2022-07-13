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
                        <td> <input type="text" name="contragent" class="form-control" v-model="appContragent"/> </td>
                        <td> <input type="text" name="contract" class="form-control" v-model="appContract"/> </td>
                        <td> <input type="text" name="message" class="form-control" v-model="appMessage"/> </td>
                        <td> <button class="btn btn-success" @click="append">добавить</button> </td>
                    </tr>
                    <tr v-for="(item, index) in dds" :key="index" :name="item.id" @change="change(item)">
                        <td> <input type="text" name="contragent" class="form-control" v-model="item.contragent"/> </td>
                        <td> <input type="text" name="contract" class="form-control" v-model="item.contract"/> </td>
                        <td> <input type="text" name="message" class="form-control" v-model="item.message"/> </td>
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
                appContragent: null,
                appContract: null,
                appMessage: null,

                dds: [],
                errors: null
            }
        },
        methods: {
            append: function(){
                let form = new FormData;
                form.append('contragent', this.appContragent);
                form.append('contract', this.appContract);
                form.append('message', this.appMessage);

                fetch('/api/admin/cc/dd/create', {
                    method: 'POST',
                    body: form
                })
                .then(response => response.json())
                .then(response => {
                    if (response.success){
                        this.errors = false

                        this.dds = response.data

                        this.appContragent = null
                        this.appContract = null
                        this.appMessage = null
                    }else{
                        this.errors = response.data
                    }
                })
                .catch(e => console.log(e))
            },
            remove: function(id){
                let form = new FormData;
                form.append('id', id);

                fetch('/api/admin/cc/dd/delete', {
                    method: 'POST',
                    body: form
                })
                .then(response => response.json())
                .then(response => {
                    if (response.success){
                        this.errors = false

                        this.dds = response.data
                    }else{
                        this.errors = response.data
                    }
                })
            },
            change: function(obj){
                let form = new FormData;
                form.append('id', obj.id);
                form.append('contragent', obj.contragent);
                form.append('contract', obj.contract);
                form.append('message', obj.message);

                fetch('/api/admin/cc/dd/update', {
                method: 'POST',
                body: form
            })
            .then(response => response.json())
            .then(response => {
                if (response.success){
                    this.errors = false

                    this.dds = response.data
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
            fetch('/api/admin/cc/dd/all', {
                method: 'GET'
            })
            .then(response => response.json())
            .then(response => this.dds = response)
        }
    }
</script>