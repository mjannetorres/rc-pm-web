<template>
  <div>
    <v-row justify="center" justify-md="start">
      <nav class="my-5 mx-10">
        <div class="font-weight-black display-2">
          RC<span class="secondary--text display-1">Prints & Garments</span>
        </div>
      </nav>
    </v-row>

    <v-row no-gutters class="my-10">
      <LoginForm :message="message" @login="handleLogin" />
    </v-row>
  </div>
</template>

<script>
import LoginForm from "@/components/Auth/LoginForm.vue";
import { useUserStore } from "@/store/UserStore";

export default {
  components: { LoginForm },
  data() {
    return {
      message: null,
    }
  },
  methods: {
    async handleLogin(params) {
      try {
        const userStore = useUserStore();

        await userStore.login(params);        

        this.message = userStore.errMsg

        if (userStore.token) {
          this.$router.push({ path: "/projects" });
        }
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>

<style scoped>
fieldset {
  border: 2px solid #e7e3e3;
}
</style>