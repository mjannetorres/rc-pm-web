<template>
  <div>
    <v-list class="elevation-1" style="border-radius: 5px">
      <v-subheader>
        <v-row no-gutters>
          <v-col v-for="title in headers" :key="title.text" :cols="title.col" :class="title.align">
            <span class="font-weight-bold">{{ title.text }}</span>
          </v-col>
        </v-row>
      </v-subheader>

      <v-progress-linear
        indeterminate
        height="2"
        v-show="loading"
      ></v-progress-linear>


      <v-divider></v-divider>
      <div v-if="orders.length == 0 && !loading" class="text-center mt-10">
        <p>No Data Available</p>
      </div>      
      <v-list-item
        v-for="item in orders"
        :key="item.jono"
        router
        :to="{ name: 'projectdetail', params: { id: item.jono } }"
        active-class="primary--text"
        v-show="!loading"
      >
        <v-list-item-content style="padding: 0">
          <v-row no-gutters style="align-items: center">
            <v-col cols="1">
              <v-list-item-title v-text="item.jono"> </v-list-item-title>
            </v-col>
            <v-col cols="3">
              <v-list-item-title v-text="item.client"> </v-list-item-title>
            </v-col>
             <v-col cols="2">
              <v-list-item-title v-text="item.created"> </v-list-item-title>
            </v-col>
            <v-col cols="2">
              <v-list-item-title v-text="item.due"> </v-list-item-title>
            </v-col>
            <v-col cols="1">
              <v-tooltip right :color="getColor(item.status)">
                <template v-slot:activator="{ on, attrs }">
                  <v-icon
                    :color="getColor(item.status)"
                    v-bind="attrs"
                    v-on="on"
                    >mdi-information-outline</v-icon
                  >
                </template>
                <span>{{ getLabel(item.status)}}</span>
              </v-tooltip>
            </v-col>
            <v-col cols="1">
              <v-list-item-title v-text="item.amount" class="text-right"> </v-list-item-title>
            </v-col>
            <v-col cols="1">
              <v-list-item-title v-text="item.paid" class="text-right"> </v-list-item-title>
            </v-col>
            <v-col cols="1">
              <v-list-item-title v-text="item.balance" class="text-right"> </v-list-item-title>
            </v-col>
          </v-row>
          <hr
            role="separator"
            aria-orientation="horizontal"
            class="v-divider theme--light"
          />
        </v-list-item-content>
      </v-list-item>
      <div class="my-2">
        <v-pagination
          v-model="page"
          :length="page_length"
          circle
          @input="navigate"
        ></v-pagination>
      </div>
    </v-list>
  </div>
</template>

<script>
import {getLabel, getColor} from '../functions/global';

export default {
  props : ['orders', 'page_length',  'loading'],
  data() {
    return {      
      selectedItem: 1,         
      id: 1,            
      page: 1,      
      headers: [
        {
          text: "No.",        
          sortable: true,
          value: "id",
          col: 1,
          id: 1,
          align:"text-left"
        },
        { text: "Client", value: "client", col: 3, id: 2, align:"text-left"},
        { text: "Created", value: "created", col: 2, id: 3, align:"text-left"},
        { text: "Due Date", value: "due", col: 2, id: 4, align: "text-left"},
        { text: "Status", value: "status", col: 1, id: 5, align: "text-left"},
        { text: "Amount", value: "amount", col: 1, id: 6, align: "text-right" },
        { text: "Paid", value: "paid", col: 1, id: 7, align: "text-right" },
        { text: "Balance", value: "balance", col: 1, id: 8, align: "text-right" }
      ]      
    };
  },
  methods: {    
    getLabel, 
    getColor,
    navigate(){
      this.$emit('search', this.page);
    },    
    getInitials(name) {
      const firstLetters = name
        .split(" ")
        .map((word) => word[0])
        .join("");

      return firstLetters;
    },
    openDetails(val) {
      this.$router.push("project/" + val);
    }
  }  
};
</script>

<style scoped>
.v-list-item__title {
  font-size: 0.875rem;
}
</style>