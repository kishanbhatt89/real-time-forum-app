<template>
  <v-toolbar color="indigo" dark>
    <!-- <v-toolbar-side-icon></v-toolbar-side-icon> -->
    <v-toolbar-title >
      <router-link class="white--text" to="/">
        The Web Artisans
      </router-link>
    </v-toolbar-title>
    <v-spacer></v-spacer>
    <AppNotification v-if="loggedIn"></AppNotification>
    <div class="hidden-sm-and-down">
      
      <router-link 
        to="/login" 
        v-for="item in items"
        :key="item.title"
        :to="item.redirect"
        v-if="item.show">

        <v-btn flat>{{ item.title }}</v-btn>

      </router-link>

    </div>
  </v-toolbar>
</template>

<script>
import AppNotification from './AppNotification'
export default {
  components:{
    AppNotification
  },
  data(){
    return {
      loggedIn: User.loggedIn(),
      items:[
        {title: 'Forum', redirect: '/forum', show: true},
        {title: 'Ask Question', redirect: '/ask', show: User.loggedIn()},
        {title: 'Category', redirect: '/category', show: User.admin()},
        {title: 'Login', redirect: '/login', show: !User.loggedIn()},
        {title: 'Logout', redirect: '/logout', show: User.loggedIn()}
      ]
    }
  },
  created(){
    EventBus.$on('logout', () => {
      User.logout()
    })
  }
}
</script>

<style>

</style>
