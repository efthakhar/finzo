<script setup>
import { ref, computed, onMounted } from "vue";
import Loader from "../../components/shared/loader/Loader.vue";
import axios from "axios";

const loading = ref(false);
const report_data = ref({});

async function fetchData() {
    loading.value = true;
    await axios
        .get(`/api/dashboard-reports`)
        .then((response) => {
            report_data.value = response.data;
        })
        .catch((errors) => {
            console.log(errors);
        });
    loading.value = false;
}

onMounted(async () => {
    fetchData();
});
</script>

<template>
    <div class="row mb-2">
        <Loader v-if="loading"/>
        <div class="dashboard-reports row" v-if="loading==false">
            <div class="col-md-4 col-sm-6 col-12">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div
                                class="px-3 py-3 d-flex justify-content-between"
                            >
                                <p class="card-title p">Total Income</p>
                                <div
                                    class="card-right d-flex align-items-center"
                                >
                                    <p>{{ report_data.total_incomes }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div
                                class="px-3 py-3 d-flex justify-content-between"
                            >
                                <p class="card-title p">Total Expense</p>
                                <div
                                    class="card-right d-flex align-items-center"
                                >
                                    <p>{{ report_data.total_expenses }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="card card-statistic">
                    <div class="card-body p-0">
                        <div class="d-flex flex-column">
                            <div
                                class="px-3 py-3 d-flex justify-content-between"
                            >
                                <p class="card-title p">Net Income</p>
                                <div
                                    class="card-right d-flex align-items-center"
                                >
                                    <p>{{ report_data.net_incomes }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
