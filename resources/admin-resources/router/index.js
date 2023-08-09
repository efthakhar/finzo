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
         
                // Incomes Route
                {
                    name: "incomes",
                    path: "incomes",
                    component: () => import("../modules/income/Incomes.vue"),
                },
                // Incomes Category Route
                {
                    name: "income_categories",
                    path: "income-categories",
                    component: () => import("../modules/income-category/IncomeCategories.vue"),
                },



            ],
        },
    ],
});

export default router;
