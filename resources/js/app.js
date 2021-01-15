require('./bootstrap');

// Import modules...
import Vue from 'vue';

import { InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faSearch,faBars,faShoppingCart,faBell,faEnvelope, faAngleRight, faAngleLeft, faCaretRight, faPlusCircle, faMinusCircle, faTrash, faTimes } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
library.add(faSearch, faBars, faShoppingCart, faBell, faEnvelope, faAngleRight, faAngleLeft, faCaretRight, faPlusCircle, faMinusCircle, faTrash, faTimes);

/* filters */
Vue.filter('truncate', (text, length, clamp) => {
    clamp = clamp || '...';
    var node = document.createElement('div');
    node.innerHTML = text;
    var content = node.textContent;
    return content.length > length ? content.slice(0, length) + clamp : content;
});

Vue.filter('curency', (value) => {
    const val = (value / 1).toFixed().replace('.', ',');
    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
});

Vue.filter('capitalize', (value) => {
    if (!value) return ''
    value = value.toString()
    return value.charAt(0).toUpperCase() + value.slice(1)
});

Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);
Vue.use(InertiaForm);
Vue.use(PortalVue);


const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
