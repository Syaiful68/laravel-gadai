import "./bootstrap";
import "@tabler/core/dist/css/tabler.css";
import "@vuepic/vue-datepicker/dist/main.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        const VueApp = createApp({ render: () => h(App, props) });
        VueApp.use(plugin).mount(el);
    },
});
