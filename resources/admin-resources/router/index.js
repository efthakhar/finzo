import { createRouter, createWebHistory } from "vue-router";

const router = createRouter({
    mode: "hash",
    history: createWebHistory(),

    routes: [
        {
            path: "/admin",
            name: "admin",
            component: () => import("../views/Admin.vue"),
            children: [
                // dashboard route
                {
                    name: "dashboard",
                    path: "",
                    component: () =>
                        import("../modules/dashboard/Dashboard.vue"),
                },
         
                // // Expanse Route
                // {
                //     name: "expanse",
                //     path: "expanse",
                //     component: () => import("../modules/expanse/Expanses.vue"),
                // },

            ],
        },
    ],
});

export default router;
