<template>
  <div class="my-5 mx-5">
    <v-row justify="center" justify-md="start" wrap>
      <v-col cols="12" md="7">
        <ProjectDetail :items="items" />
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
  components: { ProjectDetail, WorkHistoryList },
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
      const response = await axios.get(`${server}orderdetails/${this.id}`);
      this.output = response.data;
    },
    async loadRoles() {
      const response = await axios.get(`${server}roles`);
      this.roles = response.data;
    },
    async loadWorkers() {
      const response = await axios.get(`${server}workers`);
      this.workers = response.data;
    },
    async loadLogs() {
      const response = await axios.get(`${server}worklog/${this.id}`);

      this.logs = response.data.map((data) => {
        return {
          ...data,
          date: format(new Date(data.date), "MM/dd/yyyy"),
        };
      });
    },
    async deleteLog(params, id) {     

      const response = await axios.delete(`${server}worklog/${id}`, {params});
    
      if (response.data > 0) {
        this.loadLogs();
      }
    },
    async saveLog(params, id) {      

      let response;
      if (id > 0) {
        response = await axios.put(`${server}worklog/${id}`, params);
      } else {
        response = await axios.post(`${server}worklog`, params);
      }
     
      if (response.data > 0) {
        this.loadLogs();
      }
    },
    async load() {
      try {
        let response = await axios.get(`${server}joborder/${this.id}`);

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
  async created() {
    this.load();
  },
};
</script>

<style>
</style>