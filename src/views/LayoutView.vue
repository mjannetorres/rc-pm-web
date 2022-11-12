<template>
  <div class="my-5 mx-5">
    <v-row wrap>
      <v-col cols="12" md="8">
        <v-row justify="center">
          <v-col cols="12">
            <v-card flat id="lateral">
              <v-row no-gutters class="mb-1">
                <v-card-title class="primary--text align-self-end"
                  >Job Order #001 / Mary Janne Torres
                </v-card-title>
                <v-spacer></v-spacer>

                <!-- create layout dialog -->
                <v-dialog
                  transition="dialog-top-transition"
                  max-width="600"
                  persistent
                  v-model="dialog"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-fab-transition>
                      <v-btn
                        key="mdi-plus"
                        color="blue"
                        fab
                        dark
                        top
                        right
                        class="btn-menu align-self-end"
                        @click="showModal = !showModal"
                        v-bind="attrs"
                        v-on="on"
                        small
                      >
                        <v-icon>mdi-plus</v-icon>
                      </v-btn>
                    </v-fab-transition>
                  </template>
                  <template v-slot:default="dialog">
                    <v-card>
                      <v-toolbar color="primary" dark
                        >Enter Specification</v-toolbar
                      >
                      <v-card-text>
                        <LayoutModal />
                      </v-card-text>
                      <v-card-actions class="justify-end">
                        <v-btn
                          color="blue darken-1"
                          text
                          @click="dialog.value = false"
                          >Close
                        </v-btn>
                        <v-btn color="blue darken-1" text> Save </v-btn>
                      </v-card-actions>
                    </v-card>
                  </template>
                </v-dialog>

                <!-- attachment dialog -->
                <v-dialog
                  transition="dialog-top-transition"
                  max-width="600"
                  persistent
                  v-model="imgDialog"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-fab-transition>
                      <v-btn
                        key="mdi-attachment"
                        color="light"
                        fab
                        top
                        right
                        class="btn-menu align-self-end"
                        @click="showImgModal = !showImgModal"
                        v-bind="attrs"
                        v-on="on"
                        small
                      >
                        <v-icon>mdi-attachment-plus</v-icon>
                      </v-btn>
                    </v-fab-transition>
                  </template>

                  <template v-slot:default="imgDialog">
                    <v-card>
                      <v-toolbar color="primary" dark
                        >Attach Layout/Design</v-toolbar
                      >
                      <v-card-text>
                        <ImagesModal />
                      </v-card-text>
                      <v-card-actions class="justify-end">
                        <v-btn
                          color="blue darken-1"
                          text
                          @click="imgDialog.value = false"
                          >Close
                        </v-btn>
                        <v-btn color="blue darken-1" text> Save </v-btn>
                      </v-card-actions>
                    </v-card>
                  </template>
                </v-dialog>
              </v-row>
              <JobOrderSheet />
            </v-card>
          </v-col>
          <v-col cols="12">
            <v-card flat id="lateral">
              <v-row no-gutters class="mb-1">
                <v-card-title class="primary--text align-self-end"
                  >Operator Sheet
                </v-card-title>
                <v-spacer></v-spacer>                
                <v-fab-transition>
                  <v-btn
                    key="mdi-arrow-right-bold-outline"
                    color="green"
                    fab
                    dark
                    top
                    right
                    class="btn-menu align-self-end"
                    small
                  >
                    <v-icon>mdi-arrow-right-bold-outline</v-icon>
                  </v-btn>
                </v-fab-transition>
              </v-row>             
              <div v-if="showOPSheet">
                <OPSheet />
              </div>
            </v-card>
          </v-col>
        </v-row>
      </v-col>
      <v-col cols="12" md="4">
        <AttachedImages @showImg="imgDialog = true" />
      </v-col>
    </v-row>
  </div>
</template>

<script>
import JobOrderSheet from "@/components/JobOrderSheet.vue";
import OPSheet from "@/components/OPSheet.vue";
import LayoutModal from "@/components/LayoutModal.vue";
import AttachedImages from "@/components/AttachedImages.vue";
import ImagesModal from "@/components/ImagesModal.vue";

export default {
  components: {
    JobOrderSheet,
    OPSheet,
    LayoutModal,
    AttachedImages,
    ImagesModal,
  },
  data() {
    return {
      icon: "justify",
      dialog: false,
      imgDialog: false,
      showOPSheet: true,
      showModal: false,
      showImgModal: false,      
    };
  },
  methods: {    
  } 
};
</script>

<style scoped>
#lateral .btn-menu {
  margin: 0 0 10px 10px;
}
</style>