import auth from "@/middleware/auth"
import guest from "@/middleware/guest"

const routes = [
    {
        path: "/",
        name: "Login",
        component: () => import("@/views/auth/login/index.vue"),
    },
    {
        path: "/register",
        name: "reg",
        component: () => import("@/views/auth/register"),
    },
    {
        path: "/success-500",
        name: "success-500",
        component: () => import("@/views/auth/success.vue"),
    },
    {
        path: "/app",
        name: "Layout",
        redirect: "/app/home",
        component: () => import("@/Layout/index.vue"),
        meta: {
            middleware: [auth],
        },
        children: [
            {
                path: "search",
                name: "search",
                component: () => import("@/pages/Search"),
            },
            {
                path: "search/:id",
                name: "search-details",
                component: () => import("@/pages/Search/SearchDetails"),
            },
            {
                path: "blank-page",
                name: "blank-page",
                component: () => import("@/views/blank-page.vue"),
            },
        ],
    },
    {
        path: "/:catchAll(.*)",
        name: "404",
        component: () => import("@/views/404.vue"),
    },
    {
        path: "/error",
        name: "error",
        component: () => import("@/views/error.vue"),
    },
]

export default routes
