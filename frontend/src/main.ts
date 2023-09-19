import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import { library } from "@fortawesome/fontawesome-svg-core";
import icons from "@/fontawesome";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import FlashMessenger from "@/components/templates/FlashMessenger.vue";

library.add({...icons})

createApp(App)
    .component('fa', FontAwesomeIcon)
    .use(router)
    .mount('#app')
