import "./api/client"
import "./api/interceptors"

import "animate.css"
import { createApp } from "vue"
import VueFlatPickr from "vue-flatpickr-component"
import VueGoodTablePlugin from "vue-good-table-next"
import "vue-good-table-next/dist/vue-good-table-next.css"
import VueSweetalert2 from "vue-sweetalert2"
import VueTippy from "vue-tippy"
import Toast from "vue-toastification"
import "vue-toastification/dist/index.css"
import VueApexCharts from "vue3-apexcharts"
import VueClickAway from "vue3-click-away"
import App from "./App.vue"
import "./assets/scss/auth.scss"
import "./assets/scss/tailwind.scss"
import { createPinia } from 'pinia'
import router from "./router"
import VCalendar from "v-calendar"
import "v-calendar/dist/style.css"
import 'nprogress/nprogress.css'

const pinia = createPinia()

const app = createApp(App)
    .use(pinia)
    .use(router)
    .use(VueSweetalert2)
    .use(Toast, {
        toastClassName: "dashcode-toast",
        bodyClassName: "dashcode-toast-body",
    })
    .use(VueClickAway)
    .use(VueTippy)
    .use(VueFlatPickr)
    .use(VueGoodTablePlugin)
    .use(VueApexCharts)
    .use(VCalendar)

app.config.globalProperties.$store = {}
app.mount("#app")
