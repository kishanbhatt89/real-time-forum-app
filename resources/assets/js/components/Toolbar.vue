<template>
  <v-toolbar>
    <!-- <v-toolbar-side-icon></v-toolbar-side-icon> -->
    <v-toolbar-title>The Web Artisans</v-toolbar-title>
    <v-spacer></v-spacer>
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
export default {
  data(){
    return {
      items:[
        {title: 'Forum', redirect: '/forum', show: true},
        {title: 'Ask Question', redirect: '/ask', show: User.loggedIn()},
        {title: 'Category', redirect: '/category', show: User.loggedIn()},
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
