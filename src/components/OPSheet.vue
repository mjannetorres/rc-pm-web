<template>
  <div class="opsheet">
    <v-alert dense text type="info" class="align-self-end">
      Operator sheet has been <strong>Exported</strong>
    </v-alert>
    <v-card>
      <v-data-table
        :headers="headers"
        :items="items"
        item-key="id"
        sort-by="desc"
        group-by="desc"
        show-group-by
        class="elevation-2"
      >
        <template #[`item.size`]="props">
          <v-edit-dialog
            :return-value.sync="props.item.size"
            large
            @save="save"
            @cancel="cancel"
            @open="open"
            @close="close"
            persistent
          >
            {{ props.item.size }}
            <template v-slot:input>
              <div class="mt-4 text-h6">Update Size</div>
              <v-text-field
                v-model="props.item.size"
                :rules="[max25chars]"
                label="Edit"
                single-line
                counter
                autofocus
              ></v-text-field>
            </template>
          </v-edit-dialog>
        </template>

        <template #[`item.fit`]="props">
          <v-edit-dialog
            :return-value.sync="props.item.fit"
            large
            persistent
            @save="save"
            @cancel="cancel"
            @open="open"
            @close="close"
          >
            <div>{{ props.item.fit }}</div>
            <template v-slot:input>
              <div class="mt-4 text-h6">Update Fit</div>
              <v-text-field
                v-model="props.item.fit"
                :rules="[max25chars]"
                label="Edit"
                single-line
                counter
                autofocus
              ></v-text-field>
            </template>
          </v-edit-dialog>
        </template>

        <template #[`item.qty`]="props">
          <v-edit-dialog
            :return-value.sync="props.item.qty"
            large
            persistent
            @save="save"
            @cancel="cancel"
            @open="open"
            @close="close"
          >
            <div>{{ props.item.qty }}</div>
            <template v-slot:input>
              <div class="mt-4 text-h6">Update Qty</div>
              <v-text-field
                v-model="props.item.qty"
                type="number"
                label="Edit"
                single-line
                counter
                autofocus
              ></v-text-field>
            </template>
          </v-edit-dialog>
        </template>

        <template #[`item.paper`]="props">
          <v-edit-dialog
            :return-value.sync="props.item.paper"
            large
            persistent
            @save="save"
            @cancel="cancel"
            @open="open"
            @close="close"
          >
            <div>{{ props.item.paper }}</div>
            <template v-slot:input>
              <div class="mt-4 text-h6">Update Paper</div>
              <v-text-field
                v-model="props.item.paper"
                type="number"
                label="Edit"
                single-line
                counter
                autofocus
              ></v-text-field>
            </template>
          </v-edit-dialog>
        </template>

        <template #[`item.remarks`]="{ item }">
          <v-tooltip right>
            <template v-slot:activator="{ on, attrs }">
              <v-icon v-bind="attrs" v-on="on" color="info" v-if="item.remarks">
                mdi-information-outline
              </v-icon>
            </template>
            <span> {{ item.remarks }} </span>
          </v-tooltip>
        </template>

        <template #[`item.actions`]="{ item }">         
          <v-icon small @click="handleDelete(item)"> mdi-delete </v-icon>
        </template>
      </v-data-table>
    </v-card>
  </div>
</template>

<script>
export default {
  data() {
    return {
      exported: true,
      max25chars: v => v.length <= 25 || 'Input too long!',
      headers: [
        {
          text: "Description",
          value: "desc",
          sortable: true,
          align: "start",
          groupable: true,
        },
        {
          text: "Fabric",
          value: "fabric",
          sortable: false,
          align: "start",
          groupable: false,
        },
        {
          text: "Size",
          value: "size",
          sortable: false,
          align: "center",
          groupable: false,
        },
        {
          text: "Fit",
          value: "fit",
          sortable: false,
          align: "center",
          groupable: false,
        },
        {
          text: "Qty",
          value: "qty",
          sortable: false,
          align: "end",
          groupable: false,
        },
        {
          text: "Paper",
          value: "paper",
          sortable: false,
          align: "center",
          groupable: false,
        },
        {
          text: "Remarks",
          value: "remarks",
          sortable: false,
          align: "center",
          groupable: false,
        },
        {
          text: "Action",
          value: "actions",
          sortable: false,
          align: "center",
          groupable: false,
        },
      ],
      items: [
        {
          id: 1,
          headerid: 1,
          desc: "T-shirt Polydex",
          fabric: "Polydex",
          size: "Large",
          fit: "Female",
          paper: 64,
          qty: 2,
          remarks: "test",
        },
        {
          id: 2,
          headerid: 1,
          desc: "T-shirt Polydex",
          fabric: "Polydex",
          size: "Small",
          fit: "Male",
          paper: 64,
          qty: 1,
          remarks: "",
        },
      ],
    };
  },
};
</script>

<style>
</style>