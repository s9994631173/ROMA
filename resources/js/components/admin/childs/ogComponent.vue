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
                    <a class="nav-link" href="/app/#/og" target="_blank">Перейти в модуль</a>
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
                        <td> <input type="text" name="itemName" class="form-control" v-model="appendItemName"/> </td>
                        <td> <input type="text" name="classHazard" class="form-control" v-model="appendClassHazard"/> </td>
                        <td> <input type="text" name="avia" class="form-control" v-model="appendAvia"/> </td>
                        <td> <input type="text" name="addFee" class="form-control" v-model="appendAddFee"/> </td>
                        <td> <input type="text" name="auto" class="form-control" v-model="appendAuto"/> </td>
                        <td> <input type="text" name="note" class="form-control" v-model="appendNote"/> </td>
                        <td> <button class="btn btn-success" @click="append">добавить</button> </td>
                    </tr>
                    <tr v-for="(item, index) in allArray" :key="index" :name="item.id" @change="change(item)">
                        <td> <input type="text" name="itemName" class="form-control" v-model="item.itemName"/> </td>
                        <td> <input type="text" name="classHazard" class="form-control" v-model="item.classHazard"/> </td>
                        <td> <input type="text" name="avia" class="form-control" v-model="item.avia"/> </td>
                        <td> <input type="text" name="addFee" class="form-control" v-model="item.additional_fee"/> </td>
                        <td> <input type="text" name="auto" class="form-control" v-model="item.auto"/> </td>
                        <td> <input type="text" name="note" class="form-control" v-model="item.note"/> </td>
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
                appendClassHazard: null,
                appendAvia: null,
                appendAddFee: null,
                appendAuto: null,
                appendNote: null,

                allArray: [],
                errors: null
            }
        },
        methods: {
            append: function(){
                let form = new FormData;
                form.append('itemName', this.appendItemName);
                form.append('classHazard', this.appendClassHazard);
                form.append('avia', this.appendAvia);
                form.append('addFee', this.appendAddFee);
                form.append('auto', this.appendAuto);
                form.append('note', this.appendNote);

                fetch('/api/admin/og/create', {
                    method: 'POST',
                    body: form
                })
                .then(response => response.json())
                .then(response => {
                    if(response.success){
                        this.errors = false

                        this.allArray = response.data

                        this.appendItemName = null
                        this.appendClassHazard = null
                        this.appendAvia = null,
                        this.appendAddFee = null,
                        this.appendAuto = null,
                        this.appendNote = null
                    }else{
                        this.errors = response.data
                    }
                })
            },
            remove: function(id){
                let form = new FormData;
                form.append('id', id);

                fetch('/api/admin/og/delete', {
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
                form.append('classHazard', obj.classHazard);
                form.append('avia', obj.avia);
                form.append('addFee', obj.addFee);
                form.append('auto', obj.auto);
                form.append('note', obj.note);

                fetch('/api/admin/og/update', {
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
            fetch('/api/admin/og/all', {
                method: 'GET'
            })
            .then(response => response.json())
            .then(response => this.allArray = response)
        }
    }
</script>