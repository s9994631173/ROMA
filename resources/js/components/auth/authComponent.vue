<template>
    <div class="containter">
        <notifications />
        <div class="row justify-content-center">
            <div class="col-3">
                <form @submit.prevent="formSubmit">
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" id="form2Example1" class="form-control" v-model="email" required/>
                        <label class="form-label" for="form2Example1">Email</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" id="form2Example2" class="form-control" v-model="password" required/>
                        <label class="form-label" for="form2Example2">Password</label>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
                    </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

    export default{
        data: () => {
            return {
                email: null,
                password: null
            }
        },
        methods: {
            formSubmit(){
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('/login', {
                        email: this.email,
                        password: this.password
                    })
                    .then(() => {
                        this.$router.push('/admin')
                    })
                    .catch(err => {
                        this.$notify({
                        text: err.response.data.message,
                        type: 'error'
                        });
                    })
                });
            }
        }
    }
</script>