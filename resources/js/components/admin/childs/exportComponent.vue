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
                    <a class="nav-link" href="/app/#/export" target="_blank">Перейти в модуль</a>
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
                        <td> <input type="text" name="itemName" class="form-control" v-model="appendItemName"/> </td>
                        <td> <input type="text" name="about" class="form-control" v-model="appendAbout"/> </td>
                        <td> <button class="btn btn-success" @click="append">добавить</button> </td>
                    </tr>
                    <tr v-for="(item, index) in allArray" :key="index" :name="item.id" @change="change(item)">
                        <td> <input type="text" name="itemName" class="form-control" v-model="item.itemName"/> </td>
                        <td> <input type="text" name="about" class="form-control" v-model="item.about"/> </td>
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
                appendItemName: null,
                appendAbout: null,

                allArray: [],
                errors: null
            }
        },
        methods: {
            append: function(){
                let form = new FormData;
                form.append('itemName', this.appendItemName);
                form.append('about', this.appendAbout);

                fetch('/api/admin/export/create', {
                    method: 'POST',
                    body: form
                })
                .then(response => response.json())
                .then(response => {
                    if(response.success){
                        this.errors = false

                        this.allArray = response.data

                        this.appendItemName = null
                        this.appendAbout = null
                    }else{
                        this.errors = response.data
                    }
                })
            },
            remove: function(id){
                let form = new FormData;
                form.append('id', id);

                fetch('/api/admin/export/delete', {
                    method: 'POST',
                    body: form
                })
                .then(response => response.json())
                .then(response => {
                    if (response.success){
                        this.errors = false

                        this.allArray = response.data
                    }else{
                        this.errors = response.data
                    }
                })
            },
            change: function(obj){
                let form = new FormData;
                form.append('id', obj.id);
                form.append('itemName', obj.itemName);
                form.append('about', obj.about);

                fetch('/api/admin/export/update', {
                method: 'POST',
                body: form
                })
                .then(response => response.json())
                .then(response => {
                    if (response.success){
                        this.errors = false

                        this.allArray = response.data
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
            fetch('/api/admin/export/all', {
                method: 'GET'
            })
            .then(response => response.json())
            .then(response => this.allArray = response)
        }
    }
</script>