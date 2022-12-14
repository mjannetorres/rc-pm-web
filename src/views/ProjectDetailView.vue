<template>
  <div class="my-5 mx-5">
    <v-row justify="center" justify-md="start" wrap>
      <v-col cols="12" md="7">             
        <ProjectDetail :id="id" :items="items" />
      </v-col>
      <v-col cols="12" md="5">
        <WorkHistoryList
          :source="items[0]"
          :headers="headers"
          :logs="logs"
          :roles="roles"
          :workers="workers"
          :output="output"
          @save="saveLog"
          @delete="deleteLog"
        />
      </v-col>
    </v-row>
  </div>
</template>

<script>
import axios from "axios";
import server from "@/config/server";
import ProjectDetail from "@/components/ProjectDetail.vue";
import WorkHistoryList from "@/components/WorkHistoryList.vue";
import { currency } from "@/functions/global";
import { format } from "date-fns";

export default {
  props: ["id"],
  components: {ProjectDetail,  WorkHistoryList },
  data() {
    return {
      items: [],
      logs: [],
      roles: [],
      workers: [],
      output: [],
      headers: [
        {
          text: "Worker",
          value: "worker",
          groupable: true,
          sortable: true,
          align: "start",
        },
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
        { text: "Role", value: "role", groupable: false, sortable: false },
        { text: "Qty", value: "qty", groupable: false, sortable: false },
        {
          text: "Actions",
          value: "actions",
          sortable: false,
          groupable: false,
          align: "center",
        },
      ],
    };
  },
  methods: {
    async loadOutput() {    
         
      var config = {        
          method: "get",
          url: `${server}orderdetails/${this.id}`,
          headers: {
            Accept: "application/json",
            Authorization: 'Bearer '+localStorage.getItem('auth'),
          },
          data: {},
        };

      const response = await axios(config);
      this.output = response.data;
    },
    async loadRoles() {      

      var config = {
          method: "get",
          url: `${server}roles`,
          headers: {
            Accept: "application/json",
            Authorization: 'Bearer '+localStorage.getItem('auth'),
          },
          data: {},
        };

      const response = await axios(config);
      this.roles = response.data;
    },
    async loadWorkers() {

      var config = {
          method: "get",
          url: `${server}workers`,
          headers: {
            Accept: "application/json",
            Authorization: 'Bearer '+localStorage.getItem('auth'),
          },
          data: {},
        };

      const response = await axios(config);   
      this.workers = response.data;
    },
    async loadLogs() {       
      var config = {
          method: "get",
          url: `${server}worklog/${this.id}`,
          headers: {
            Accept: "application/json",
            Authorization: 'Bearer '+localStorage.getItem('auth'),
          },
          data: {},
        };

      const response = await axios(config);   

      this.logs = response.data.map((data) => {
        return {
          ...data,
          date: format(new Date(data.date), "MM/dd/yyyy"),
        };
      });
    },
    async deleteLog(params, id) {    

      var config = {
          method: "delete",
          url: `${server}worklog/${id}, ${{params}}`,
          headers: {
            Accept: "application/json",
            Authorization: 'Bearer '+localStorage.getItem('auth'),
          },
          data: {},
        };

      const response = await axios(config);

      if (response.data > 0) {
        this.loadLogs();
      }
    },
    async saveLog(params, id) {      

      let method, url;
      if (id > 0) {
        method = 'put'
        url = `${server}worklog/${id}`
      } else {
        method = 'post'
        url = `${server}worklog`
      }

      var config = {
          method: method,
          url:url,
          headers: {
            Accept: "application/json",
            Authorization: 'Bearer '+localStorage.getItem('auth'),
          },
          data: params,
        };
   
      let response = await axios(config)      

      if (response.data > 0) {
        this.loadLogs();
      }
    },
    async loadItems() {
      try {      

        var config = {
          method: "get",
          url: `${server}joborder/${this.id}`,
          headers: {
            Accept: "application/json",
            Authorization: 'Bearer '+localStorage.getItem('auth'),
          },
          data: {},
        };

        const response = await axios(config);          

        this.items = response.data.map((data) => {
          return {
            ...data,
            cost: currency(data.cost),
            total: currency(data.total),
          };
        });      

        this.loadLogs();
        this.loadRoles();
        this.loadOutput();
        this.loadWorkers();
        this.loadRoles();
      } catch (err) {
        console.log(err);
      }
    },
  },
  mounted() {},
  created(){    
    this.loadItems()
  }
};
</script>

<style>
</style>