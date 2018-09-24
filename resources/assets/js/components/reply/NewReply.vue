<template>
    <div class="mt-4">
        <markdown-editor v-model="body"></markdown-editor>
        <v-btn color="green" dark @click="submit">
            Reply
        </v-btn>
    </div>
</template>

<script>
export default {
    props: ['questionSlug'],
    data(){
        return{
            body:null
        }
    },
    methods:{
        submit(){
            axios.post(`/api/question/${this.questionSlug}/reply`,{body: this.body})
                 .then(res => {
                     this.body = null
                     EventBus.$emit('newReplyCreated',res.data.reply)
                 })
        }
    }
}
</script>

<style>

</style>
