import Vue from 'vue'
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify'
import { createPinia, PiniaVuePlugin  } from 'pinia'

/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faUserSecret, faBookmark, faHouse, faListCheck, faChartSimple, faTableCellsLarge, faPowerOff } from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(faUserSecret, faBookmark, faHouse, faListCheck, faChartSimple, faTableCellsLarge, faPowerOff)

// /* add font awesome icon component */
Vue.component('font-awesome-icon', FontAwesomeIcon)

Vue.config.productionTip = false

Vue.use(PiniaVuePlugin)
const pinia = createPinia()

 new Vue({      
  pinia,
  router,
  vuetify,            
  render: h => h(App)
}).$mount('#app')