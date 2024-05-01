import './bootstrap.js'
import '../css/app.css';
import 'summernote/dist/summernote-lite.css'
import 'summernote/dist/summernote-lite.min.js'
import './assets/css/main.css';
import './assets/js/popper.min.js';
import './assets/js/bootstrap.bundle.min.js';
import 'vue-select/dist/vue-select.css';



import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import vSelect from 'vue-select'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

import { createVbPlugin } from 'vue3-plugin-bootstrap5'
import { Alert, Button, Carousel, Collapse, Dropdown, Modal, Offcanvas, Popover, ScrollSpy, Tab, Toast, Tooltip } from 'bootstrap'
let vbPlugin = createVbPlugin({ Alert, Button, Carousel, Collapse, Dropdown, Modal, Offcanvas, Popover, ScrollSpy, Tab, Toast, Tooltip})

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

import { createToaster } from "@meforma/vue-toaster"
window.$toast = createToaster({
    position: 'bottom-right'
});


createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(vbPlugin)
            .component("v-select", vSelect)
            .mount(el);
    },
    progress: {
        color: '#E50102',
    },
});
