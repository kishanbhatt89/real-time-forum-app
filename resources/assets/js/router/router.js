import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Login from '../components/login/Login.vue'
import Signup from '../components/login/Signup.vue'
import Forum from '../components/forum/Forum.vue'
import Logout from '../components/login/Logout.vue'
import Read from '../components/forum/Read.vue'
import Create from '../components/forum/Create.vue'

const routes = [
    {path: '/login', component: Login},
    {path: '/signup', component: Signup},
    {path: '/forum', component: Forum, name: 'forum'},
    {path: '/logout', component: Logout},
    {path: '/question/:slug', component: Read, name: 'read'},
    {path: '/ask', component: Create}
]

const router = new VueRouter({
    routes, // short for `routes: routes`
    hashBang: false,
    mode: 'history'
})

export default router