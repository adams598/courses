require('./bootstrap');
//import Vue from 'vue';

import App from './Layouts/AppLayout.vue';
import mitt from 'mitt';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

// let eventBus = new Vue();
// window.eventBus = eventBus;
const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

// const eventBus = mitt();
// const app = createApp(App);
// app.config.globalProperties.eventBus = eventBus;


createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
