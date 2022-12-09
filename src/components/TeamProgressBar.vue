<template>
  <v-card class="mx-auto" max-width="450">
    <v-card-title class="primary--text"> Status </v-card-title>

    <v-card-subtitle> {{ progress }}% to completion </v-card-subtitle>

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
            {{ status.filter(stat => stat.status == 'Z')[0]['statuscount'] }} <br />
            orders closed
          </v-progress-circular>
        </div>
      </v-col>
      <v-col cols="5" md="12" lg="10" xl="5" class="align-self-center mx-auto">
        <v-row no-gutters class="mx-2">
          <v-col
            v-for="stat in status"
            :key="stat.label"
            cols="12" 
            md="6"                      
            xl="12"
            wrap
            justify-md="center"
          >
            <v-row  no-gutters class="mx-auto">
              <v-col cols="6" md="4">
                <v-chip small label :color="getColor(stat.status)">{{
                  stat.statuscount
                }}</v-chip>
              </v-col>
              <v-col cols="6" md="6" xl="8">
                <span class="font-weight-light text-caption">{{
                  getLabel(stat.status)
                }}</span>
              </v-col>
            </v-row>
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
import {getLabel, getColor} from '../functions/global';

export default {
  props: ['status', 'label', 'color'],
  data() {
    return {
      show: true,
      progress: 78,
      team: [
        { name: "Mary Janne Torres", progress: 80 },
        { name: "Gemma Capada", progress: 70 },
        { name: "Aloha Gargar", progress: 55 },
        { name: "Racelyn Torres", progress: 95 },
      ],
    };
  },
  methods: {
   getLabel, getColor 
  },
  created(){
    
    
  }
};
</script>

<style>
</style>