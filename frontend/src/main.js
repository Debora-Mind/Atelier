import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import { library } from "@fortawesome/fontawesome-svg-core";
import icons from "@/fontawesome";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { createStore } from "vuex"; // Importe createStore em vez de store
//import FlashMessenger from "@/components/templates/FlashMessenger.vue";
import { store, key } from '@/store/store';
import './registerServiceWorker';
library.add({ ...icons });
createApp(App)
    .component('fa', FontAwesomeIcon)
    .use(router)
    .use(createStore({}))
    .use(store, key)
    .mount('#app');
//# sourceMappingURL=main.js.map