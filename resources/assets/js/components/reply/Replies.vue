<template>
    <div>
        <Reply 
        v-for="(reply,index) in content" 
        :data="reply" 
        v-if="question"
        :index=index
        :key="reply.id"></Reply>
    </div>
</template>

<script>
import Reply from './Reply'
export default {
    props: ['question'],
    data(){
        return{
            content: this.question.replies
        }
    },
    components:{ Reply },
    created(){
        this.listen()
    },
    methods:{
        listen(){
            EventBus.$on('newReplyCreated',(reply) => {
                this.body = ''
                this.content.unshift(reply)
                window.scrollTo(0,0)
            })
            EventBus.$on('deleteReply',(index) => {
                axios.delete(`/api/question/${this.question.slug}/reply/${this.content[index].id}`)
                     .then(res => {
                         this.content.splice(index,1)
                     })
            })
        }
    }
}
</script>

<style>

</style>
