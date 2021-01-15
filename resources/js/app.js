require('./bootstrap');

import { App, plugin } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress'
import Vue from 'vue'
import VueMeta from 'vue-meta'
import 'materialize-css/dist/css/materialize.min.css'
import 'material-design-icons/iconfont/material-icons.css'
import 'aos/dist/aos.css';
import AOS from 'aos';

//Style Library Calls
AOS.init();
InertiaProgress.init({
    delay: 100,
    color: '#4CAF50',
    includeCSS: true,
    showSpinner: true,
})

//Initialize Inertia
Vue.use(plugin)
//Enable meta in components
Vue.use(VueMeta)

Vue.prototype.$route = route

const el = document.getElementById('app')

new Vue({
    render: h => h(App, {
        props: {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: name => require(`./Pages/${name}`).default,
        },
    }),
}).$mount(el)
