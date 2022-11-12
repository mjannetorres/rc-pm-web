<template>
  <div class="modal">
    <v-row class="pt-8" justify="start">
      <v-alert text type="info" dense>
        Select Item description and enter size, fit, qty, paper size below.
      </v-alert>
      <v-col cols="8">
        <v-select
          :items="items"
          label="Item Description"
          outlined
          dense
        ></v-select>
      </v-col>
      <v-col cols="4">
        <v-text-field label="Fabric" readonly outlined dense></v-text-field>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="4">
        <v-text-field
          label="Ordered Qty"
          readonly
          outlined
          dense
        ></v-text-field>
      </v-col>
      <v-col cols="4">
        <v-text-field label="Free" readonly outlined dense></v-text-field>
      </v-col>
      <v-col cols="4">
        <v-text-field label="Unit" readonly outlined dense></v-text-field>
      </v-col>
    </v-row>
    <v-divider></v-divider>
    <v-row class="pt-6">
      <v-col cols="3">
        <v-select
          :items="sizes"
          label="Size"
          v-model="size"
          outlined
          dense
        ></v-select>
      </v-col>
      <v-col cols="3">
        <v-select
          :items="gender"
          v-model="fit"
          label="Fit"
          outlined
          dense
        ></v-select>
      </v-col>
      <v-col cols="3">
        <v-text-field type="number" label="Qty" v-model.number="qty" outlined dense></v-text-field>
      </v-col>
      <v-col cols="3">
        <v-text-field type="number" label="Paper Size" v-model.number = "paper" outlined dense></v-text-field>
      </v-col>
      <v-col cols="12">
        <v-textarea
          label="Remarks"
          v-model="remarks"
          auto-grow
          outlined
          rows="1"
          row-height="15"
        ></v-textarea>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  data() {
    return {
      qty: 0,
      items: [],
      size: '',
      fit: '',
      remarks: '',
      paper: 0,
      sizes: [
        "Kids",
        "18",
        "20",
        "XS",
        "Small",
        "Medium",
        "Large",
        "XL",
        "2XL",
        "3XL",
        "4XL",
        "5XL",
      ],
      gender: ["Male", "Female"],
    };
  },
};
</script>

<style>
</style>