require('./bootstrap');

window.Vue = require('vue').default;

import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import {ValidationProvider, ValidationObserver} from 'vee-validate';
import vSelect from 'vue-select';

Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);
Vue.component('v-select', vSelect);

import helper from "./helper";
import  "vue-select/dist/vue-select.css";
import "./VeeValidate";

Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)


Vue.component('contact-component', require('./components/ContactComponent').default);
Vue.component('insert-contact', require('./components/InsertContactComponent').default);
Vue.component('alert-component', require('./components/AlertComponent').default);

Vue.prototype.$helper = helper;
const app = new Vue({
    el: '#app',
});
