<template>
    <div v-if="question">
        <EditQuestion 
            v-if="editing"
            :data=question
        ></EditQuestion>
        
        <show-question
            v-else
            :data=question
        ></show-question>
        
        <v-container>
            <Replies :question="question"></Replies>
            <NewReply v-if="loggedIn" :questionSlug="question.slug"></NewReply>    

            <div class="mt-4" v-else>
                <router-link to="/login">
                    Login to reply
                </router-link>
            </div>

        </v-container>
        
    </div>
</template>

<script>
import ShowQuestion from './ShowQuestion'
import EditQuestion from './EditQuestion'
import Replies from '../reply/Replies'
import NewReply from '../reply/NewReply'
export default {
    
    components: {ShowQuestion,EditQuestion,Replies,NewReply},
    data(){
        return{
            question: null,
            editing: false
        }
    },
    computed:{
        loggedIn(){
            return User.loggedIn()
        }
    },
    created(){
        this.listen()
        this.getQuestion()
    },
    methods:{
        listen(){
            EventBus.$on('startEditing',() => {
                this.editing = true
            })
            EventBus.$on('cancelEditinig',() => {
                this.editing = false
            })
        },
        getQuestion(){
            axios.get(`/api/question/${this.$route.params.slug}`)
                 .then(res => this.question = res.data.data)
        }
    }
}
</script>

<style>

</style>
