import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import "@fortawesome/fontawesome-free/css/all.css";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import { notifications } from "./Plugins/notifications";
import __ from "./Helpers/lang";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText ||
    "reklamacija.rs";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(Toast)
            .use(notifications)
            .use(ZiggyVue, Ziggy);
        app.config.globalProperties.__ = __;
        app.mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
