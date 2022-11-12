<template>
  <v-data-table
      :headers="headers"
      :items="items"
      item-key="id"
      sort-by="desc"      
      class="elevation-2"
    >
    </v-data-table>
  
</template>

<script>
export default {
  props: ["id"],
  data() {
    return {
      headers: [
        {
          text: "Description",
          value: "desc",
          id: 1,         
          sortable: true,
          align: "start",
        },
        {
          text: "Fabric",
          value: "fabric",
          id: 2,         
          sortable: false,
        },
        {
          text: "Qty",
          value: "qty",
          id: 3,         
          sortable: false,
          align: "center",
        },
        {
          text: "Free",
          value: "free",
          id: 4,         
          sortable: false,
          align: "center",
        },
        {
          text: "Unit",
          value: "unit",
          id: 5,        
          sortable: false,
          align: "center",
        },
      ],
      items: [
        {
          id: 1,
          headerid: 1,
          desc: "T-shirt Polydex",
          fabric: "Polydex",
          qty: 3,
          free: 1,
          unit: "piece",
        },
        {
          id: 2,
          headerid: 1,
          desc: "T-shirt Polydex",
          fabric: "Polydex",
          qty: 5,
          free: 0,
          unit: "piece",
        },
      ],
    };
  },
  computed: {},
};
</script>

<style>

</style>