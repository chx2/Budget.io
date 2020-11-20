require('./bootstrap');

import { InertiaApp } from '@inertiajs/inertia-vue'
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
Vue.use(InertiaApp)
Vue.prototype.$route = (...args) => route(...args).url()

//Enable meta in components
Vue.use(VueMeta)

const app = document.getElementById('app')
new Vue({
    render: h => h(InertiaApp, {
        props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: name => import(`./Pages/${name}`).then(module => module.default),
        },
    }),
}).$mount(app)
