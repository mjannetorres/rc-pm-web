import Vue from 'vue';
import Vuetify from 'vuetify/lib/framework';
import colors from 'vuetify/lib/util/colors';

Vue.use(Vuetify);

export default new Vuetify({
    theme: {
        themes: {
          light: {
            primary: '#C37B89',
            secondary: '#efbac5', //colors.grey.darken1,
            accent: '#f9c89d', //colors.shades.black,
            error: colors.red.accent3,
          },
          dark: {
            primary: '#748DA6', //colors.blue.lighten3,
          },
        },
      },
});
