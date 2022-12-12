<template>
  <v-card
    class="mx-auto py-10 px-10 text-center"
    min-width="450px"
    style="border-radius: 30px"   
  >
    <p class="font-weight-black text-h5">User Login</p>
    <p class="text-subtitle-1">
      Hey, Enter your details to get sign in <br />
      to your account
    </p>
    <v-card-text>
      <v-text-field       
        v-model="email"
        :rules="[rules.required, rules.email]"
        label="E-mail"
        style="border-radius: 10px"
        append-icon="mdi-email"
        outlined
        @input="validate"
      ></v-text-field>
      <v-text-field        
        v-model.trim="password"
        outlined
        :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
        :rules="[rules.required]"
        :type="show ? 'text' : 'password'"
        name="input-10-2"
        label="Password"
        style="border-radius: 10px"
        @click:append="show = !show"
        @input="validate"
      ></v-text-field>
    </v-card-text>
    <p v-if="message" class="text-subtitle-1" style="color: red">
      {{ message }}
    </p>
    <v-card-actions>
      <v-btn
        class="py-5"
        :disabled="disabled"
        block
        color="primary"
        @click="handleClick()"
        >LOG IN</v-btn
      >
    </v-card-actions>
    <v-divider class="my-5"></v-divider>
    <p class="overline">Don't have an account? <a href="/register">Sign up here</a></p>
  </v-card>
</template>

<script>
export default {
  props: ["message"],
  data() {
    return {     
      show: false,
      password: null,
      email: null,
      disabled: true,
      rules: {
        required: (value) => !!value || "This field is required.",
        email: (value) => {
          const pattern =
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          return pattern.test(value) || "Invalid e-mail.";
        },
      },
    };
  },
  methods: {    
    validate() {
      const emailPattern =
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      this.disabled =
        !emailPattern.test(this.email) ||
        !this.email ||    
        !this.password      
       
    },
    handleClick() {
      const params = {
        email: this.email,
        password: this.password,
      };

      this.$emit("login", params);
    },
  },
  created(){    
    this.validate()
  }
};
</script>

<style>
</style>