<template>
  <v-card class="mx-auto">
    <v-card-title class="primary--text"> Status </v-card-title>

    <v-card-subtitle> {{ status }}% to completion </v-card-subtitle>
    <div class="mx-2 py-3">
      <v-progress-linear
        class="text-caption"
        color="accent"
        height="20"
        value="60"
        striped
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
    <v-expand-transition>
      <div v-show="show">
        <v-divider></v-divider>
        <v-card-text>
          <v-data-table
            :headers="headers"
            :items="logs"
            item-key="id"
            group-by="worker"
            :group-desc="showDescending"
            show-group-by
          >
            <template v-slot:top>
              <v-toolbar flat>
                <v-toolbar-title>Work Logs</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <v-dialog v-model="dialog" max-width="500px">
                  <template v-slot:activator="{ on, attrs }">
                    <v-btn
                      color="primary"
                      dark
                      class="mb-2"
                      v-bind="attrs"
                      v-on="on"
                    >
                      NEW
                    </v-btn>
                  </template>
                  <v-card>
                    <v-card-title>
                      <span class="text-h5">{{ formTitle }}</span>
                    </v-card-title>
                    <v-card-text>
                      <v-container>
                        <v-row>
                          <v-col cols="12" sm="6" md="12">
                            <v-select
                              v-model="worker"
                              :items="workers"
                              item-text="worker"
                              item-value="workerid"
                              label="Worker"
                              return-object
                            ></v-select>
                          </v-col>
                          <v-col cols="12" sm="6" md="12">
                            <v-select
                              v-model="desc"
                              :items="output"
                              item-text="description"
                              item-value="output"
                              label="Description"
                              return-object
                            ></v-select>
                          </v-col>
                          <v-col cols="12" sm="6" md="9">
                            <v-select
                              v-model="role"
                              :items="roles"
                              item-text="role"
                              item-value="roleid"
                              label="Roles"
                              return-object
                            ></v-select>
                          </v-col>
                          <v-col cols="12" sm="6" md="3">
                            <v-text-field
                              v-model="qty"
                              label="Qty"
                            ></v-text-field>
                          </v-col>
                        </v-row>
                      </v-container>
                    </v-card-text>

                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn color="blue darken-1" text @click="close">
                        Cancel
                      </v-btn>
                      <v-btn color="blue darken-1" text @click="save">
                        Save
                      </v-btn>
                    </v-card-actions>
                  </v-card>
                </v-dialog>
                <v-dialog v-model="dialogDelete" max-width="500px">
                  <v-card>
                    <v-card-title class="text-h5"
                      >Are you sure you want to delete this item?</v-card-title
                    >
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn color="blue darken-1" text @click="closeDelete"
                        >Cancel</v-btn
                      >
                      <v-btn
                        color="blue darken-1"
                        text
                        @click="deleteItemConfirm"
                        >OK</v-btn
                      >
                      <v-spacer></v-spacer>
                    </v-card-actions>
                  </v-card>
                </v-dialog>
              </v-toolbar>
            </template>
            <template #[`item.actions`]="{ item }">
              <v-icon small class="mr-2" @click="editItem(item)">
                mdi-pencil
              </v-icon>
              <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
            </template>
            <template v-slot:no-data>
              <v-btn color="primary" @click="initialize"> Reset </v-btn>
            </template>
          </v-data-table>
        </v-card-text>
      </div>
    </v-expand-transition>
  </v-card>
</template>

<script>
export default {
  props: ["logs", "output", "workers", "roles", "headers", "source"],
  data() {
    return {
      dialog: false,
      dialogDelete: false,
      editedIndex: -1,
      worker: { workerid: null, worker: null },
      role: { roleid: null, role: null },
      desc: { output: null, description: null },
      qty: 0,
      showDescending: true,
      show: true,
      status: 60,
      remaining: 50,
      completed: 10,
    };
  },
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },
  created() {
    this.initialize();
  },
  methods: {
    editItem(item) {
      this.editedIndex = item.id;
      this.worker = { workerid: item.workerid, worker: item.worker };
      this.role = { roleid: item.roleid, role: item.role };
      this.desc = { output: item.output, description: item.desc };
      this.qty = item.qty;

      console.log(this.role);

      this.dialog = true;     
    },

    deleteItem(item) {
      this.editedIndex = item.id;       
      this.dialogDelete = true;
    },

    deleteItemConfirm() {      
      const params = {
        cancelledbyid: 1
      }  
      this.$emit("delete", params, this.editedIndex); 
      this.closeDelete();
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.worker = { workerid: null, worker: null };
        this.role= { roleid: null, role: null };
        this.desc= { output: null, description: null };
        this.qty= 0;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedIndex = -1;
      });
    },
    save() {
      let params = {};

      if (this.editedIndex > 0) {
          params = {
            workerid: this.worker.workerid,
            worker: this.worker.worker,
            roleid: this.role.roleid,
            role: this.role.role,
            output: this.desc.output,
            qty: this.qty,                       
            updatedbyid: 1,        
          };
      } else {
        params = {
            workerid: this.worker.workerid,
            worker: this.worker.worker,
            roleid: this.role.roleid,
            role: this.role.role,
            output: this.desc.output,
            qty: this.qty,
            jono: this.source.jono,
            clientid: this.source.clientid,
            client: this.source.client,
            createdbyid: 1,        
          };
      }

      this.$emit("save", params, this.editedIndex);
      
      this.close();
    },
  },
};
</script>

<style>
</style>