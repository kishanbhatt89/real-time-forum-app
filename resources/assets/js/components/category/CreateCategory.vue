<template>
    <v-container>
        <v-alert v-if="errors" :value="true" type="error">
            Please give category name
        </v-alert>
        <v-form @submit.prevent="submit">
            <v-text-field type="text" v-model="form.name" label="Category" required></v-text-field>
            <v-btn color="yellow" type="submit" :disabled="disabled" v-if="editSlug">Update</v-btn>
            <v-btn color="teal" type="submit" :disabled="disabled" v-else>Create</v-btn>
        </v-form>
        <v-card class="mt-4">
            <v-toolbar color="indigo" dark dense class="mt-2">
                <v-toolbar-title>Categories List</v-toolbar-title>
            </v-toolbar>
            <v-list>
                <div v-for="(category,index) in categories" :key="category.id">
                    <v-list-tile>
                        <v-list-tile-action>
                            <v-btn icon @click="edit(index)">
                                <v-icon color="orange">edit</v-icon>
                            </v-btn>
                        </v-list-tile-action>

                        <v-list-tile-content>
                            <v-list-tile-title>{{ category.name }}</v-list-tile-title>
                        </v-list-tile-content>

                        <v-list-tile-action>
                            <v-btn icon @click="destroy(category.slug,index)">
                                <v-icon color="red">delete</v-icon>
                            </v-btn>
                        </v-list-tile-action>
                    </v-list-tile>
                    <v-divider></v-divider>
                </div>
            </v-list>
        </v-card>
    </v-container>
</template>

<script>
export default {
    data(){
        return{
            form:{
                name: null
            },
            categories: {},
            editSlug: null,
            errors:null
        }
    },
    created(){
        if (!User.admin()) {
            this.$router.push('/forum')
        }
        axios.get('/api/category')
             .then(res => this.categories = res.data.data)
    },
    methods:{
        submit(){
            this.editSlug ? this.update() : this.create()  
        },
        create(){
            axios.post('/api/category',this.form)
                 .then(res => {
                     this.categories.unshift(res.data)
                     this.form.name = null
                 })
                 .catch(error => this.errors = error.response.data.errors)
        },
        update(){
            axios.patch(`/api/category/${this.editSlug}`,this.form)
                 .then(res => {
                     this.categories.unshift(res.data)
                     this.form.name = null
                     this.editSlug = null
                 })
        },
        destroy(slug,index){
            axios.delete(`/api/category/${slug}`)
                 .then(res => this.categories.splice(index,1))
        },
        edit(index){
            this.form.name = this.categories[index].name
            this.editSlug = this.categories[index].slug
            this.categories.splice(index,1)
        }
    },
    computed:{
        disabled(){
            return !(this.form.name)
        }
    }
}
</script>

<style>

</style>
