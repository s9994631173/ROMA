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
        <div class='col-10'>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <a class="nav-link" href="/app/#/insurance" target="_blank">Перейти в модуль</a>
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
                        <td> <input type="text" name="button" class="form-control" v-model="appButton"/> </td>
                        <td>
                            <select class="form-control" v-model="appType">
                                <option>text</option>
                                <option>link</option>
                            </select> 
                        </td>
                        <td> <input type="text" name="info" class="form-control" v-model="appInfo"/> </td>
                        <td> <button class="btn btn-success" @click="append">добавить</button> </td>
                    </tr>
                    <tr v-for="(item, index) in buttons" :key="index" :name="item.id" @change="change(item)">
                        <td> <input type="text" name="button" class="form-control" v-model="item.button"/> </td>
                        <td>
                            <select class="form-control" v-model="item.type">
                                <option>text</option>
                                <option>link</option>
                            </select> 
                        </td>
                        <td> <input type="text" name="info" class="form-control" v-model="item.info"/> </td>
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
                appButton: null,
                appType: 'text',
                appInfo: null,

                buttons: [],
                errors: null
            }
        },
        methods: {
            append: function(){
                let form = new FormData;
                form.append('button', this.appButton);
                form.append('type', this.appType);
                form.append('info', this.appInfo);

                fetch('/api/admin/insurance/create', {
                    method: 'POST',
                    body: form
                })
                .then(response => response.json())
                .then(response => {
                    if(response.success){
                        this.errors = false

                        this.buttons = response.data

                        this.appButton = null
                        this.appType = 'text'
                        this.appInfo = null
                    }else{
                        this.errors = response.data
                    }
                })
            },
            remove: function(id){
                let form = new FormData;
                form.append('id', id);

                fetch('/api/admin/insurance/delete', {
                    method: 'POST',
                    body: form
                })
                .then(response => response.json())
                .then(response => {
                    if(response.success){
                        this.errors = false

                        this.buttons = response.data
                    }else{
                        this.errors = response.data
                    }
                })
            },
            change: function(obj){
                let form = new FormData;
                form.append('id', obj.id);
                form.append('button', obj.button);
                form.append('type', obj.type);
                form.append('info', obj.info);

                fetch('/api/admin/insurance/update', {
                method: 'POST',
                body: form
            })
            .then(response => response.json())
            .then(response => {
                if(response.success){
                    this.errors = false

                    this.buttons = response.data
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
            fetch('/api/admin/insurance/all', {
                method: 'GET'
            })
            .then(response => response.json())
            .then(response => this.buttons = response)
        }
    }
</script>