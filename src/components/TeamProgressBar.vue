<template>
  <v-card class="mx-auto" max-width="450">
    <v-card-title class="primary--text"> Status </v-card-title>

    <v-card-subtitle> {{ status }}% to completion </v-card-subtitle>

    <v-row justify="center">
      <v-col cols="7" md="12" xl="7">
        <div class="text-center">
          <v-progress-circular
            :rotate="360"
            :size="150"
            :width="20"
            :value="30"
            color="secondary"
          >
            {{ status }} <br />
            tasks left
          </v-progress-circular>
        </div>
      </v-col>
      <v-col cols="5" md="12" lg="10" xl="5" class="align-self-center mx-auto">               
        <v-row no-gutters class="mx-2">
          <v-col cols="6" md="2" xl="4">
            <v-chip dark small label color="blue">23</v-chip>
          </v-col>
          <v-col cols="6" md="4" xl="8">
            <span class="font-weight-light text-caption">Completed</span>
          </v-col>
          
          <v-col cols="6" md="2" xl="4">
          <v-chip dark small label color="green">23</v-chip>
          </v-col>
          <v-col cols="6" md="4" xl="8">
          <span class="font-weight-light text-caption">In progress</span>
          </v-col>
          <v-col cols="6" md="2" xl="4">
          <v-chip dark small label color="brown">23</v-chip>
          </v-col>
          <v-col cols="6" md="4" xl="8">
          <span class="font-weight-light text-caption">Not started</span>
          </v-col>

          <v-col cols="6" md="2" xl="4">
          <v-chip dark small label color="red">23</v-chip>
          </v-col>
          <v-col cols="6" md="4" xl="8">
          <span class="font-weight-light text-caption">Late</span>
          </v-col>

          <v-col cols="6" md="2" xl="4">
          <v-chip dark small label color="warning">23</v-chip>
          </v-col>
          <v-col cols="6" md="4" xl="8">
          <span class="font-weight-light text-caption">At Risk</span>
          </v-col>
        </v-row>
       
      </v-col>
    </v-row>

    <v-card-actions>
      <v-btn color="orange lighten-2" @click="show = !show" text>
        Team's Progress
      </v-btn>

      <v-spacer></v-spacer>

      <v-btn icon @click="show = !show">
        <v-icon>{{ show ? "mdi-chevron-up" : "mdi-chevron-down" }}</v-icon>
      </v-btn>
    </v-card-actions>

    <v-expand-transition>
      <div v-show="show">
        <v-divider></v-divider>
        <v-card-text>
          <v-row
            v-for="member in team"
            :key="member.name"
            wrap
            justify-md="start"
          >
            <v-col cols="4" md="12" lg="4">
              <span> {{ member.name }} </span>
            </v-col>
            <v-col cols="8" md="12" lg="8">
              <v-progress-linear
                :value="member.progress"
                color="accent"
                height="25"
                ><strong
                  >{{ Math.ceil(member.progress) }}%</strong
                ></v-progress-linear
              >
            </v-col>
          </v-row>
        </v-card-text>
      </div>
    </v-expand-transition>
  </v-card>
</template>

<script>
export default {
  data() {
    return {
      show: true,
      status: 78,
      team: [
        { name: "Mary Janne Torres", progress: 80 },
        { name: "Gemma Capada", progress: 70 },
        { name: "Aloha Gargar", progress: 55 },
        { name: "Racelyn Torres", progress: 95 },
      ],
    };
  },
};
</script>

<style>
</style>