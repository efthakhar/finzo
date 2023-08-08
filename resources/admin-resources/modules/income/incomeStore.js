import axios from "axios";
import formatValidationErrors from "../../utils/format-validation-errors";
import { defineStore } from "pinia";
import { useNotificationStore } from "../../components/shared/notification/notificationStore";

export const useIncomeStore = defineStore("income", {
    state: () => ({
        current_page: 1,
        total_pages: 0,
        limit: 10,

        q_title: "",
        q_category: "",
        q_start_amount: "",
        q_end_amount: "",
        q_start_date: "",
        q_end_date: "",
        q_sort_column: "id",
        q_sort_order: "desc",

        incomes: [],

        edit_income_id: null,
        view_income_id: null,

        add_income_errors: {},

        edit_income_errors: {},

        current_income_item: {
            id: "",
            title: "",
            amount: 0,
            date: "",
            description: "",
        },
    }),

    getters: {},

    actions: {
        fetchIncomes(page, limit, q_title = "") {
            return new Promise((resolve, reject) => {
                axios
                    .get(
                        `/api/incomes?page=${page}&limit=${limit}&title=${q_title}&category=${this.q_category}&start_amount=${this.q_start_amount}&end_amount=${this.q_end_amount}&start_date=${this.q_start_date}&end_date=${this.q_end_date}&sort_column=${this.q_sort_column}&sort_order=${this.q_sort_order}`
                    )
                    .then((response) => {
                        this.incomes = response.data.data;
                        if (response.data.meta) {
                            this.total_pages = response.data.meta.last_page;
                            this.current_page = response.data.meta.current_page;
                            this.limit = response.data.meta.per_page;
                            this.q_title = q_title;
                        }
                        resolve(this.incomes);
                    })
                    .catch((errors) => {
                        reject(errors);
                    });
            });
        },

        resetCurrentIncomeData() {
            this.current_income_item = {
                id: "",
                title: "",
                amount: 0,
                date: "",
                description: "",
            };
            this.add_income_errors = [];
            this.edit_income_errors = [];
        },

        // fetchBrandList() {
        //     return new Promise((resolve, reject) => {
        //         axios
        //             .get(`/api/incomes`)
        //             .then((response) => {
        //                 resolve(response.data.data);
        //             })
        //             .catch((errors) => {
        //                 reject(errors);
        //             });
        //     });
        // },

        // async fetchBrand(id) {
        //     return new Promise((resolve, reject) => {
        //         axios
        //             .get(`/api/incomes/${id}`)
        //             .then((response) => {
        //                 this.current_income_item = response.data.data;
        //                 resolve(response.data.data);
        //             })
        //             .catch((errors) => {
        //                 reject(errors);
        //             });
        //     });
        // },

        // async addBrand(data) {
        //     return new Promise((resolve, reject) => {
        //         data.logo = data.logo.map((jsonObj) => jsonObj["id"]);
        //         axios
        //             .post(`/api/incomes`, data)
        //             .then((response) => {
        //                 this.resetCurrentBrandData();
        //                 const notifcationStore = useNotificationStore();
        //                 notifcationStore.pushNotification({
        //                     message: "Brand Added Successfully",
        //                     type: "success",
        //                     time: 2000,
        //                 });

        //                 resolve();
        //             })
        //             .catch((error) => {
        //                 const notifcationStore = useNotificationStore();
        //                 notifcationStore.pushNotification({
        //                     message: "Error Occurred",
        //                     type: "error",
        //                     time: 2000,
        //                 });

        //                 if (error.response.status == 422) {
        //                     this.add_income_errors = formatValidationErrors(
        //                         error.response.data.errors
        //                     );
        //                 }
        //                 reject(error);
        //             });
        //     });
        // },

        // async editBrand(data) {
        //     return new Promise((resolve, reject) => {
        //         data.logo = data.logo.map((jsonObj) => jsonObj["id"]);
        //         axios
        //             .put(`/api/incomes/${this.edit_income_id}`, data)
        //             .then((response) => {
        //                 this.resetCurrentBrandData();
        //                 const notifcationStore = useNotificationStore();
        //                 notifcationStore.pushNotification({
        //                     message: "income updated successfully",
        //                     type: "success",
        //                 });
        //                 resolve(response);
        //             })
        //             .catch((errors) => {
        //                 const notifcationStore = useNotificationStore();
        //                 notifcationStore.pushNotification({
        //                     message: "Error Occurred",
        //                     type: "error",
        //                 });

        //                 if (errors.response.status == 422) {
        //                     this.edit_income_errors = formatValidationErrors(
        //                         errors.response.data.errors
        //                     );
        //                 }
        //                 reject(errors);
        //             });
        //     });
        // },

        // async deleteBrand(id) {
        //     return new Promise((resolve, reject) => {
        //         axios
        //             .delete(`/api/incomes/${id}`)
        //             .then((response) => {
        //                 if (
        //                     this.incomes.length == 1 ||
        //                     (Array.isArray(id) &&
        //                         id.length == this.incomes.length)
        //                 ) {
        //                     this.current_page == 1
        //                         ? (this.current_page = 1)
        //                         : (this.current_page -= 1);
        //                 }

        //                 this.resetCurrentBrandData();
        //                 const notifcationStore = useNotificationStore();
        //                 notifcationStore.pushNotification({
        //                     message: "income deleted successfully",
        //                     type: "success",
        //                     time: 2000,
        //                 });

        //                 resolve(response);
        //             })
        //             .catch((error) => {
        //                 reject(error);
        //             });
        //     });
        // },
    },
});
