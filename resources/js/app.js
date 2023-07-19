import {createApp} from 'vue';
import {createStore} from 'vuex';
import App from './App.vue';
import routes from './routes/routes';
import storeData from './store/store';
import filters from './libs/filters';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import ToastPlugin from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-default.css';
import 'tailwindcss/tailwind.css';

window.Alpine = Alpine;
Alpine.plugin(focus);
Alpine.start();

const store = createStore(storeData);

const app = createApp(App);

app.use(store);
app.use(filters);
app.use(routes);
app.use(ToastPlugin);

app.mount('#app');
