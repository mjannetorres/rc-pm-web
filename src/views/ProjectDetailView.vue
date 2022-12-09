<template>
  <div class="my-5 mx-5">
    <v-row justify="center" justify-md="start" wrap>
      <v-col cols="12" md="8">       
        <ProjectDetail :items="items" />
      </v-col>
      <v-col cols="12" md="4">
        <WorkHistoryList />
      </v-col>
    </v-row>
  </div>
</template>

<script>
import axios from "axios";
import server from "@/config/server";
import ProjectDetail from "@/components/ProjectDetail.vue";
import WorkHistoryList from "@/components/WorkHistoryList.vue";
import {currency} from '@/functions/global'

export default {
  props: ["id"],
  components: { ProjectDetail, WorkHistoryList },
  data() {
    return {
      items: [],
    }
  },
  method: {
    async loadDetails() {
      
    },
  },
  mounted() {},
  async created() {   
    try {
                      
        const response = await axios.get(`${server}joborder/${this.id}`);

        this.items = response.data.map((data) => {
            return {
              ...data,                                         
              cost: currency(data.cost),
              total: currency(data.total),
            };
          });         

        console.log(this.items);
      } catch (err) {
        console.log(err);
      }
  },
};
</script>

<style>
</style>