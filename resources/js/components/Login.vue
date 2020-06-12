<template>
    <div>
        <h3 class="text-center">Login</h3>
        <div class="row">
            <div class="col-sm-2 offset-sm-5">
                <div v-if="message" 
                     class="alert alert-danger" 
                >{{ message }}</div>
                <form v-on:submit.prevent="login">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" v-model="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" v-model="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    
    export default {
        data () {
            return {
                email: '',
                password: '',
                successful: false,
                message: ''
            }
        },
        methods: {
            login () {
                this.$store
                    .dispatch('login', {
                        email: this.email,
                        password: this.password
                    })
                    .then(response => {
                        this.$router.push({ name: 'overview' })
                    })
                    .catch(error => {
                        this.message = error.response.data.message;
                    });
              }
        }
    }
    
</script>
