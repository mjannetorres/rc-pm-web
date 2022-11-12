<template>
  <v-card flat>
    <v-card-title class="primary--text">
      <v-row align-content="center">
        <v-col cols="12" xl="4">Job Orders</v-col>

        <!-- date from -->
        <v-col cols="12" sm="6" md="3" xl="2">
          <v-menu
            v-model="date_menu1"
            :close-on-content-click="false"
            :nudge-right="40"
            transition="scale-transition"
            offset-y
            min-width="100"
            width="290"
          >
            <template v-slot:activator="{ on, attrs }">
              <v-text-field
                v-model="date1"
                label="From"
                prepend-icon="mdi-calendar"
                readonly
                v-bind="attrs"
                v-on="on"
              ></v-text-field>
            </template>
            <v-date-picker
              v-model="date1"
              @input="date_menu1 = false"
            ></v-date-picker>
          </v-menu>
        </v-col>

        <!-- date to -->
        <v-col cols="12" sm="6" md="3" xl="2">
          <v-menu
            v-model="date_menu2"
            :close-on-content-click="false"
            :nudge-right="40"
            transition="scale-transition"
            offset-y
            min-width="100"
            width="290"
          >
            <template v-slot:activator="{ on, attrs }">
              <v-text-field
                v-model="date2"
                label="To"
                prepend-icon="mdi-calendar"
                readonly
                v-bind="attrs"
                v-on="on"
              ></v-text-field>
            </template>
            <v-date-picker
              v-model="date2"
              @input="date_menu2 = false"
            ></v-date-picker>
          </v-menu>
        </v-col>

        <v-col cols="12" xl="4" md="6">
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            single-line
            hide-details
            outlined
            @keydown.enter="handleSearch()"
          ></v-text-field>
        </v-col>
      </v-row>
    </v-card-title>

    <v-list class="elevation-1" style="border-radius: 5px">
      <v-subheader>
        <v-row no-gutters>
          <v-col v-for="title in headers" :key="title.text" :cols="title.col">
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
        :key="item.ID"
        router
        :to="{ name: 'projectdetail', params: { id: item.ID } }"
        active-class="primary--text"
        v-show="!loading"
      >
        <v-list-item-content style="padding: 0">
          <v-row no-gutters style="align-items: center">
            <v-col cols="1" class="px-2">
              <v-list-item-title v-text="item.ID"> </v-list-item-title>
            </v-col>
            <v-col cols="3">
              <v-list-item-title v-text="item.CLIENT"> </v-list-item-title>
            </v-col>
            <v-col cols="3">
              <v-tooltip
                v-for="assigned in item.ASSIGNED"
                :key="assigned.ID"
                left
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-list-item-avatar
                    size="30"
                    class="me-1 ms-0 white--text text-caption"
                    color="primary"
                    v-bind="attrs"
                    v-on="on"
                  >
                    {{ getInitials(assigned.EMPNAME) }}
                  </v-list-item-avatar>
                </template>
                <span>{{ assigned.EMPNAME }}</span>
              </v-tooltip>
            </v-col>
            <v-col cols="2">
              <v-list-item-title v-text="item.due"> </v-list-item-title>
            </v-col>
            <v-col cols="2">
              <v-tooltip right :color="getColor(item.status)">
                <template v-slot:activator="{ on, attrs }">
                  <v-icon
                    :color="getColor(item.status)"
                    v-bind="attrs"
                    v-on="on"
                    >mdi-information-outline</v-icon
                  >
                </template>
                <span>{{ item.status }}</span>
              </v-tooltip>
            </v-col>
            <v-col cols="1">
              <v-progress-linear
                height="10"
                :value="item.progress"
              ></v-progress-linear>
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
        <v-pagination v-model="page" :length="4" circle></v-pagination>
      </div>
    </v-list>
  </v-card>
</template>

<script>
import axios from "axios";
import { format, subMonths } from "date-fns";
import server from "@/config/server";

export default {
  data() {
    return {
      loading: false,
      selectedItem: 1,
      page: 1,
      search: "",
      id: 1,
      date1: new Date(
        subMonths(new Date(Date.now()), 8) -
          new Date().getTimezoneOffset() * 60000
      )
        .toISOString()
        .substr(0, 10),
      date2: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
      date_menu1: false,
      date_menu2: false,
      headers: [
        {
          text: "No.",
          align: "start",
          sortable: true,
          value: "id",
          col: 1,
          id: 1,
        },
        { text: "Client", value: "client", col: 3, id: 2 },
        { text: "Assigned", value: "assigned", col: 3, id: 3 },
        { text: "Due Date", value: "due", col: 2, id: 4 },
        { text: "Status", value: "status", col: 2, id: 5, align: "center" },
        { text: "Progress", value: "progress", col: 1, id: 6 },
      ],
      orders: [],
    };
  },
  methods: {
    async handleSearch() {
      try {
        let datefrom = format(new Date(this.date1), "yyyy/MM/dd");
        let dateto = format(new Date(this.date2), "yyyy/MM/dd");
        this.loading = true;

        const response = await axios.get(
          `${server}jo/query/?name=${this.search}&datefrom=${datefrom}&dateto=${dateto}`
        );
        
        let timeout = 2000
        if(response.data.length >50){
          timeout = 5000
        }
         
        setTimeout(() => {
          this.orders = response.data.map((data) => {
          return {
            ...data,
            due: format(new Date(data.DUEDATE), "LLL dd, yyyy"),
            status: "at risk",
            progress: "1%",
          };          
        });
         this.loading = false;        
        }, timeout);
       
      } catch (err) {
        console.log(err);
        this.loading = false;
      }
    },
    getColor(status) {
      if (status == "completed") return "blue";
      else if (status == "in progress") return "green";
      else if (status == "not started") return "brown";
      else if (status == "late") return "red";
      else return "warning";
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
    },
  },
  created() {
    this.handleSearch();
  },
};
</script>

<style scoped>
.v-list-item__title {
  font-size: 0.875rem;
}
</style>