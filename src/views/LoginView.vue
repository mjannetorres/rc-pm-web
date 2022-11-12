<template>
  <div>
   <v-row justify="center" justify-md="start">
    <nav class="my-5 mx-10">
    <div class=" font-weight-black display-2">RC<span class="secondary--text display-1">Prints & Garments</span></div>
   </nav>
   </v-row>

    <v-row no-gutters class="my-10">
      <v-card class="mx-auto py-10 px-10 text-center" min-width="450px" style="border-radius: 30px">

        <p class="font-weight-black text-h5">User Login</p>
        <p class="text-subtitle-1">Hey, Enter your details to get sign in <br> to your account</p>
        <v-card-text>
          <v-text-field
            label="Username"          
            append-icon="mdi-account-outline"
            outlined            
            style="border-radius:10px;"
          ></v-text-field>
          <v-text-field
            outlined
            :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
            :rules="[rules.required]"
            :type="show ? 'text' : 'password'"
            name="input-10-2"
            label="Password"                             
            style="border-radius:10px;"
            @click:append="show3 = !show3"
          ></v-text-field>
        </v-card-text>

        <v-card-actions>           
            <v-btn class="py-5" block color="primary" depressed>Log in</v-btn>
        </v-card-actions>
      </v-card>
    </v-row>
  </div>
</template>

<script>
export default {
  data() {
    return {
      show: false,      
      password: "Password",
      rules: {
        required: (value) => !!value || "Required.",              
      },
    };
  },
};
</script>

<style scoped>
    fieldset{
        border: 2px solid #e7e3e3;
    }    
</style>