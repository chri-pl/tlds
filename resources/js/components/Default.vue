<template>
    <div>
        <br>
        <div class="text-center">
            <button v-on:click="toggleForm" class="btn btn-primary">To {{ formType == 'login' ? 'Registration' : 'Login' }} Form</button>
        </div>        
        <br>
        <Login v-if="formType === 'login'" />
        <Signup v-else />
    </div>
</template>

<script>
    
    import Login from './Login.vue';
    import Signup from './Signup.vue';
    
    export default {
        data () {
            return {
                formType: 'login'
            }
        },
        components: {
            Login,
            Signup
        },
        methods: {
            toggleForm: function () {
                
                if ( this.formType == 'login' ) {
                    this.formType = 'register';
                } else {
                    this.formType = 'login';
                }
            }
        }
    }
    
</script>
