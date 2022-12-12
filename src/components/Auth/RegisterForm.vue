<template>
  <v-card
    class="mx-auto py-10 px-10 text-center"
    min-width="450px"
    style="border-radius: 30px"   
  >
    <p class="font-weight-black text-h5">Register User</p>
    <p class="text-subtitle-1">Enter your details to create an account</p>
    <v-card-text>
      <v-text-field       
        v-model="name"
        :counter="20"
        :rules="[rules.required]"
        label="Name"
        required
        style="border-radius: 10px"
        append-icon="mdi-account-outline"
        outlined
        @input="validate"
      ></v-text-field>

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
        :rules="[
          rules.required,
          rules.lowercase,
          rules.uppercase,
          rules.digit,
          rules.special,
        ]"
        outlined
        :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
        :type="show ? 'text' : 'password'"
        label="Password"
        style="border-radius: 10px"
        @click:append="show = !show"
        @input="validate"
      ></v-text-field>
      <v-text-field       
        v-model.trim="confirmPassword"
        outlined
        :rules="[rules.required, rules.passwordMatch]"
        :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
        :type="show2 ? 'text' : 'password'"
        label="Confirm Password"
        style="border-radius: 10px"
        @click:append="show2 = !show2"
        @input="validate"
      ></v-text-field>
    </v-card-text>
    <p
      v-for="mess in message"
      :key="mess"
      class="text-subtitle-1"
      style="color: red"
    >
      {{ mess }}
    </p>
    <v-card-actions>
      <v-btn
        class="py-5"
        :disabled="disabled"
        block
        color="primary"
        @click="handleClick()"
        >Register</v-btn
      >
    </v-card-actions>
    <v-divider class="my-5"></v-divider>
    <p class="overline">Already have an account? <a href="/login">Log in here</a></p>
  </v-card>
</template>

<script>
export default {
  props: ["message"],
  data() {
    return {
      show: false,
      show2: false,
      password: null,
      confirmPassword: null,
      name: null,
      email: null,    
      disabled: true,
      rules: {
        required: (value) => !!value || "This field is required.",
        minimum: (value) => value.length >= 8 || "Min 8 characters",
        maximum: (value) => value.length <= 20 || "Max 20 characters",
        passwordMatch: (value) =>
          value === this.password || "Password do not match",
        email: (value) => {
          const pattern =
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          return pattern.test(value) || "Invalid e-mail.";
        },
        lowercase: (value) => {
          const pattern = /[a-z]/g;
          return pattern.test(value) || "Must contain lowercase letter";
        },
        uppercase: (value) => {
          const pattern = /[A-Z]/g;
          return pattern.test(value) || "Must contain uppercase letter";
        },
        digit: (value) => {
          const pattern = /[0-9]/g;
          return pattern.test(value) || "Must contain a digit";
        },
        special: (value) => {
          const pattern = /[!@#$%^&*]/g;
          return pattern.test(value) || "Must contain a symbol";
        },
      },
    };
  },  
  methods: {
    validate() {
      const emailPattern =
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      const lowercase = /[a-z]/g;
      const uppercase = /[A-Z]/g;
      const digit = /[0-9]/g;
      const special = /[!@#$%^&*]/g;

      this.disabled =
        !emailPattern.test(this.email) ||
        !this.email ||
        this.password != this.confirmPassword ||
        !this.password ||
        !this.confirmPassword ||
        !lowercase.test(this.password) ||
        !uppercase.test(this.password) ||
        !digit.test(this.password) ||
        !special.test(this.password);
     
    },
    handleClick() {
      const params = {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.confirmPassword,
        };

        this.$emit("register", params);
    },
  },
  created(){
    this.validate()
  }
};
</script>

<style>
</style>