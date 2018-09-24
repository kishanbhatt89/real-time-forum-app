<template>

    <v-container>

        <v-form @submit.prevent="login">

            <v-text-field type="email" v-model="form.email" label="E-mail" required></v-text-field>

            <v-text-field type="password" v-model="form.password" label="Password" required></v-text-field>

            <v-btn color="green" type="submit">Login</v-btn>

            <router-link to="/signup">
                <v-btn color="blue">Signup</v-btn>
            </router-link>

        </v-form>

  </v-container>

</template>

<script>
export default {
    data(){
        return{
            form:{
                email: null,
                password: null
            }
        }
    },
    created(){
        if (User.loggedIn()) {
            this.$router.push({name: 'forum'})
        }
    },
    methods:{
        login(){
            User.login(this.form)
        }
    }
}
</script>

<style>

</style>
