<template>
    <div>
        <h3 class="text-center">Signup</h3>
        <div class="row">
            <div class="col-sm-2 offset-sm-5">
                <div v-if="message" 
                     class="alert" 
                     :class="successful ? 'alert-success' : 'alert-danger'" 
                >{{ message }}</div>
                <form v-on:submit.prevent="signup">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" v-model="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" v-model="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password Repeat</label>
                        <input type="password" v-model="password_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Signup</button>
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
                password_confirmation: '',
                successful: false,
                message: ''
            }
        },
        methods: {
            signup () {
                
                this.message = '';
                
                this.$store
                    .dispatch('signup', {
                        email: this.email,
                        password: this.password,
                        password_confirmation: this.password_confirmation
                    })
                    .then(response => {
                        this.successful = true;
                        this.message = response.data.message;
                    })
                    .catch(error => {
                        this.successful = false;

                        for ( let errortype in error.response.data.errors ) {
                            for ( let x = 0; x < error.response.data.errors[errortype].length; x++ ) {
                                this.message += error.response.data.errors[errortype][x] + '\n';
                            }
                        }
                    });
            }
        }
    }
    
</script>
