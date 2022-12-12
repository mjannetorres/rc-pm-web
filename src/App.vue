<template>
  <v-app :class="appStyle">
   
    <NavBar v-if="(this.$route.name != 'login') && (this.$route.name != 'register')"/>   

    <!-- Sizes your content based upon application components -->
    <v-main :class="mainStyle">
      <!-- Provides the application the proper gutter -->
      <v-container fluid>
        <!-- If using vue-router -->
        <router-view></router-view>
      </v-container>
    </v-main>

    <v-footer app>
      <!-- -->
    </v-footer>
  </v-app>
</template>

<script>
import NavBar from "@/components/NavBar.vue";

export default {
  name: "App",
  components: { NavBar },
  data: () => ({
    //
  }),
  computed: {
    mainStyle(){      
      if ((this.$route.name == 'login') || (this.$route.name == 'register')){
        return 'login'
      }else{
        return ''
      }
      // return this.$route.name == 'login' ? 'login' : ''
    },
    appStyle(){
      if ((this.$route.name == 'login') || (this.$route.name == 'register')){
        return 'login-bg'
      }else{
        return ''
      }    
    }
  }
};
</script>

<style>
  .login{
    background-image: url('./assets/test.png');
    background-repeat: repeat-x;
    background-position-y: bottom;
  }
  .login-bg{
    background-color:#FFEDDE !important;
  }
</style>