<template>
  <v-card flat>
    <v-card-title class="primary--text"
      >Job Order No. {{ items[0].jono }} / {{ items[0].client }}
    </v-card-title>    
    <v-data-table
      :headers="headers"
      :items="items"
      item-key="id"
      sort-by="description"
      group-by="description"
      show-group-by
      class="elevation-1"
    >
      <template #[`item.done`]="{ item }">
        <v-icon v-if="item.done" color="green" small> mdi-check-bold </v-icon>
        <v-icon v-else color="red" small> mdi-close-thick </v-icon>
      </template>

      <template #[`item.actions`]>
        <v-icon small @click.stop="qtyDialog = true"> mdi-pencil </v-icon>
      </template>
    </v-data-table>
    <v-dialog v-model="qtyDialog" persistent max-width="290">
      <v-card>
        <v-card-title class="text-h5"> Enter Qty Done: </v-card-title>
        <v-card-text>
          <v-text-field
            autofocus
            :rules="[rules.required]"
            type="number"
            label="Qty"
            outlined
          ></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary darken-1" text @click="qtyDialog = false">
            Close
          </v-btn>
          <v-btn color="primary darken-1" text @click="qtyDialog = false">
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-card>
</template>

<script>
export default {
  props: ["id", "items"],
  data() {
    return {
      qtyDialog: false,
      isCutter: true,
      rules: {
        required: (value) => !!value || "Required.",
      },
      headers: [
        {
          text: "Description",
          value: "description",
          groupable: true,
          sortable: true,
          align: "start",
        },       
        { text: "Fabric", value: "fabric", groupable: false, sortable: false },        
        {text: "Qty", value: "qty", groupable: false, sortable: false, align: "end"},
        {text: "Free", value: "free", groupable: false, sortable: false, align: "end"},
        {text: "Cost", value: "cost", groupable: false, sortable: false, align: "end"},
        {text: "Total", value: "total", groupable: false, sortable: false, align: "end"}
      ],      
    };
  },
  methods: {
    editItem(item) {
      this.editedIndex = this.items.indexOf(item);
      this.editedItem = Object.assign({}, item);
      // this.dialog = true
      //console.log(item.desc, item.id);
      //alert(item.desc);
    },
    showLog(item) {
      console.log(item);
      // this.dialog = true;
    },
    closeDlg() {
      this.dialog = false;
      console.log(this.dialog);
    },
  },
  mounted(){
    
  },
  created() {
    
    // this.headers.push({
    //   text: "Rem. Qty",
    //   value: "rem",
    //   groupable: false,
    //   sortable: false,
    //   align: "end",
    // });
    // if (this.isCutter) {
    //   this.headers.push(
    //     {
    //       text: "1st Cut",
    //       value: "cut1",
    //       groupable: false,
    //       sortable: false,
    //       align: "end",
    //     },
    //     {
    //       text: "2nd Cut",
    //       value: "cut2",
    //       groupable: false,
    //       sortable: false,
    //       align: "end",
    //     }
    //   );
    // }
    // this.headers.push(
    //   {
    //     text: "Completed",
    //     value: "done",
    //     groupable: false,
    //     sortable: false,
    //     align: "center",
    //   },
    //   {
    //     text: "Log Task",
    //     value: "actions",
    //     sortable: false,
    //     groupable: false,
    //     align: "center",
    //   }
    // );
  },
};
</script>

<style>
</style>