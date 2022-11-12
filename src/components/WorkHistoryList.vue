<template>
  <v-card class="mx-auto" max-width="450">
    <v-card-title class="primary--text"> Status </v-card-title>

    <v-card-subtitle> {{ status }}% to completion </v-card-subtitle>
    <div class="mx-2 py-3">
      <v-progress-linear class="text-caption" color="accent" height="20" value="60" striped
        >{{ completed }}/{{ remaining }} tasks</v-progress-linear
      >
      <v-row no-gutters class="align-self-center justify-center mt-1">
        <v-col cols="4" md="5" lg="4">
          <v-chip dark small label color="blue">{{ completed }} </v-chip>
          <span class="ps-2 font-weight-light text-caption">Completed</span>
        </v-col>
        <v-col cols="4" md="5" lg="4">
          <v-chip dark small label color="warning">{{ remaining }} </v-chip>
          <span class="ps-2 font-weight-light text-caption">Remaining</span>
        </v-col>
      </v-row>
    </div>
    <!-- <v-row>
      <v-col cols="7" md="12" xl="7">
        <div class="text-center">
          <v-progress-circular
            :rotate="360"
            :size="150"
            :width="20"
            :value="30"
            color="secondary"
          >
            {{ remaining }} <br />
            tasks left
          </v-progress-circular>
        </div>
      </v-col>
      <v-col cols="5" md="12" lg="10" xl="5" class="align-self-center mx-auto">
        <v-row no-gutters class="mx-2">
          <v-col cols="6" md="2" xl="4">
            <v-chip dark small label color="blue">{{ completed }} </v-chip>
          </v-col>
          <v-col cols="6" md="4" xl="8">
            <span class="font-weight-light text-caption">Completed</span>
          </v-col>

          <v-col cols="6" md="2" xl="4">
            <v-chip dark small label color="warning">{{ remaining }} </v-chip>
          </v-col>
          <v-col cols="6" md="4" xl="8">
            <span class="font-weight-light text-caption">Remaining</span>
          </v-col>
        </v-row>
      </v-col>
    </v-row> -->

    <v-card-actions>
      <v-btn color="orange lighten-2" @click="show = !show" text>
        Work Log
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
          <v-row>
            <v-data-table
              :headers="headers"
              :items="items"
              item-key="id"
              group-by="date"        
              :group-desc="showDescending"             
              show-group-by                      
            >
              <template #[`item.actions`]="{ item }">
                <v-icon small class="mr-2" @click="editItem(item)">
                  mdi-pencil
                </v-icon>
                <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
              </template>
            </v-data-table>
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
      showDescending: true,
      show: true,
      status: 60,
      remaining: 50,
      completed: 10,
      headers: [
        {
          text: "Date",
          value: "date",
          groupable: true,
          sortable: true,
          align: "start",
        },
        {
          text: "Description",
          value: "desc",
          groupable: false,
          sortable: false,
        },
        { text: "Qty", value: "qty", groupable: false, sortable: false },
        {
          text: "Actions",
          value: "actions",
          sortable: false,
          groupable: false,
          align: "center",
        },
      ],
      items: [
        { date: "10/12/2022",  desc: "T-shirt Polydex", qty: 2, id: 1 },
        { date: "10/10/2022", desc: "T-shirt Polydex", qty: 1, id: 2 },
        { date: "10/10/2022", desc: "T-shirt Polydex", qty: 3, id: 3 },
        { date: "10/05/2022", desc: "T-shirt Polydex", qty: 5, id: 4 },
        { date: "10/08/2022", desc: "T-shirt Polydex", qty: 2, id: 5 },
      ],
    };
  },
};
</script>

<style>
</style>