<template>
  <div class="my-5 mx-5">
    <v-row justify="center" justify-md="start" wrap>
      <v-col cols="12" md="8">
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
                  @keydown.enter="handleSearch"
                ></v-text-field>
              </v-col>
            </v-row>
          </v-card-title>
          <ProjectList
            :orders="orders"
            :page_length="page_length"
            :page="page"
            :loading="loading"
            @search="handleSearch"
          />
        </v-card>
      </v-col>
      <v-col cols="12" md="4">
        <TeamProgressBar :status="status" :label="getLabel" :color="getColor" />
      </v-col>
    </v-row>
  </div>
</template>

<script>
import TeamProgressBar from "@/components/TeamProgressBar.vue";
import ProjectList from "@/components/ProjectList.vue";
import axios from "axios";
import { format, subMonths } from "date-fns";
import server from "@/config/server";
import { currency } from "@/functions/global";

export default {
  components: { TeamProgressBar, ProjectList },
  data() {
    return {
      loading: false,
      search: "",
      page_length: 4,
      page: 1,
      date_menu1: false,
      date_menu2: false,
      date1: new Date(
        subMonths(new Date(Date.now()), 8) -
          new Date().getTimezoneOffset() * 60000
      )
        .toISOString()
        .substr(0, 10),
      date2: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
      orders: [],
      status: [],
    };
  },
  methods: {
    async handleSearch(page) {
      try {
        let datefrom = format(new Date(this.date1), "yyyy-MM-dd");
        let dateto = format(new Date(this.date2), "yyyy-MM-dd");
        this.loading = true;

        let params = {
          name: this.search.toUpperCase(),
          from: datefrom,
          to: dateto,
          offset: (page - 1) * 10,
          limit: 10,
        };

        var config = {
          method: "get",
          url: `${server}joborder/search/`,
          headers: {
            'Accept': 'application/json'
          },
          data: params,
        };

        await axios(config)
          .then(function (response) {
            this.status = response.data["status"];

            let timeout = 1000;

            setTimeout(() => {
              this.orders = response.data["joborders"].map((data) => {
                return {
                  ...data,
                  due: format(new Date(data.duedate), "LLL dd, yyyy"),
                  created: format(new Date(data.created), "LLL dd, yyyy"),
                  amount: currency(data.amount),
                  paid: currency(data.paid),
                  balance: currency(data.balance),
                };
              });

              this.page_length = 10;
              if (Math.ceil(response.data["length"] / 10) < 10) {
                this.page_length = Math.ceil(response.data["length"] / 10);
              }

              this.loading = false;
            }, timeout);
          })
          .catch(function (error) {
            this.loading = false;
            console.log(error);
          });
      } catch (err) {
        console.log(err);
        this.loading = false;
      }
    },
  },
  created() {
    this.handleSearch();
  },
};
</script>

<style>
</style>