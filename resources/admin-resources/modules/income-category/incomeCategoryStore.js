import axios from "axios";
import formatValidationErrors from "../../utils/format-validation-errors";
import { defineStore } from "pinia";
import { useNotificationStore } from "../../components/shared/notification/notificationStore";

export const useIncomeCategoryStore = defineStore("incomeCategory", {
    state: () => ({
        current_page: 1,
        total_pages: 0,
        limit: 10,

        q_title: "",
        q_sort_column: "",
        q_sort_order: "desc",

        income_categories: [],

        edit_income_category_id: null,
        view_income_category_id: null,

        add_income_category_errors: {},

        edit_income_category_errors: {},

        current_income_category_item: {
            id: "",
            name: "",
        },
    }),

    getters: {},

    actions: {
        resetCurrentIncomeCategoryData() {
            this.current_income_category_item = {
                id: "",
                name: "",
            };
            this.add_income_category_errors = [];
            this.edit_income_category_errors = [];
        },

        fetchCatList() {
            return new Promise((resolve, reject) => {
                axios
                    .get(`/api/income-categories/list`)
                    .then((response) => {
                        resolve(response.data.data);
                    })
                    .catch((errors) => {
                        reject(errors);
                    });
            });
        },
    },
});
