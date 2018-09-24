<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex xs8>
                <Question
                v-for="question in questions"
                :key="question.path"
                :question=question
                ></Question>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
import Question from './Question';
export default {
    data(){
        return{
            questions: {}
        }
    },
    components:{
        Question
    },
    created(){
        axios.get('api/question')
             .then(res => this.questions = res.data.data)
             .catch(error => console.log(error.response.data))
    }
}
</script>

<style>

</style>
