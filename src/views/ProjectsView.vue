<template>
  <div class="my-5 mx-5">
    <v-row justify="center" justify-md="start" wrap>
      <v-col cols="12" md="8"> 
        <ProjectList />
      </v-col>      
      <v-col cols="12" md="4">
        <TeamProgressBar />
      </v-col>
    </v-row>
  </div>
</template>

<script>
import TeamProgressBar from "@/components/TeamProgressBar.vue";
import ProjectList from "@/components/ProjectList.vue";

export default {
  components: { TeamProgressBar, ProjectList },
};
</script>

<style>
</style>