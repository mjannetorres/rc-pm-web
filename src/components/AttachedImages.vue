<template>
  <div class="imgs">
    <v-card elevation="2" class="mx-auto" max-width="450">
      <v-card-title class="primary--text"
        ><v-icon class="primary--text">mdi-attachment</v-icon> Attachments
      </v-card-title>
      <v-card-subtitle> Click image to preview</v-card-subtitle>
      <v-card-text>
        <v-row>
          <v-col v-for="n in 9" :key="n" class="d-flex child-flex" cols="4">
            <v-hover>
              <template v-slot:default="{ hover }">
                <v-img
                  :src="`https://picsum.photos/500/300?image=${n * 5 + 10}`"
                  :lazy-src="`https://picsum.photos/10/6?image=${n * 5 + 10}`"
                  aspect-ratio="1"
                  class="grey lighten-2"
                >
                  <v-fade-transition>
                    <v-overlay v-if="hover" absolute color="#036358">
                      <v-btn
                        @click="$emit('showImg')"
                        ><v-icon color="accent">mdi-eye-outline</v-icon></v-btn
                      >
                    </v-overlay>
                  </v-fade-transition>
                </v-img>
              </template>
            </v-hover>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
export default {
  data() {
    return {
      hover: false,
      imgDialog: false,
    };
  },
  methods: {       
  }
};
</script>

<style>
</style>