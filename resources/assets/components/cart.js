import Vue from 'vue'
import VueResource from 'vue-resource'

import Commodity from './Commodity'
import Addr from './Addr'
import Loading from './Loading'
import Box from './Box'


Vue.use(VueResource);

Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
Vue.http.options.xhr = { withCredentials: true };

new Vue({
    el: '#app',
    components: { Addr, Commodity, Loading, Box }
});