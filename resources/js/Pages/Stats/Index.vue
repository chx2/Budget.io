<template>
    <layout :auth_url="auth_url">
        <h1 class="center-align">Stats</h1>
        <div class="divider"/>
        <div class="row">
            <div class="col m12 full" data-aos="fade-in" v-if="budgets.length > 0">
                <div class="row">
                    <div class="col m12">
                        <label>
                            Select Budgets:
                            <select v-model="selected" multiple @change="updateChart">
                                <option v-for="budget in budgets" :value="budget">{{ budget.name }}</option>
                            </select>
                        </label>
                    </div>
                </div>
                <div class="row" v-if="loading">
                    <div class="col m12">
                        <spinner></spinner>
                    </div>
                </div>
                <div class="row" v-else>
                    <div class="col m12">
                        <line-chart :chart-data="chartData" :options="options"></line-chart>
                    </div>
                </div>
            </div>
            <div class="col m12 full" data-aos="fade-in" v-else>
                <div class="card">
                    <div class="card-content">
                        <p class="flow-text">
                            You do not have any budgets created.
                            Would you like to create one?
                        </p>
                    </div>
                    <div class="card-action">
                        <inertia-link :href="$route('budgets.create')" class="btn full-width green">Create a Budget</inertia-link>
                    </div>
                </div>
            </div>
        </div>
    </layout>
</template>

<script>
import Layout from "../../components/Layout";
import LineChart from "../../components/Charts/LineChart";
import Spinner from "../../components/Spinner";
export default {
    name: "Index",
    components: {Spinner, LineChart, Layout},
    metaInfo: {
        title: 'View Stats',
        titleTemplate: '%s | Budget.io',
        htmlAttrs: {
            lang: 'en',
        }
    },
    data () {
        return {
            loading: null,
            selected: [],
            chartData: {
                labels: [],
                datasets: []
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        }
    },
    methods: {
        updateChart: function() {
            this.loading = true;
            //Reset data points
            this.resetChart();
            for (let budget of this.selected) {
                //Push labels to chart
                this.chartData.labels.push(budget.name)
                //Gather totals for incomes & expenses for each budget
                let totalIncome = 0;
                let totalExpense = 0;
                for (let income of this.incomes) {
                    if (budget.id === income.budget_id) {
                        totalIncome = totalIncome + parseFloat(income.amount);
                    }
                }
                for (let expense of this.expenses) {
                    if (budget.id === expense.budget_id) {
                        totalExpense = totalExpense + parseFloat(expense.amount);
                    }
                }
                //Push total to the chart
                this.chartData.datasets[0].data.push(totalIncome);
                this.chartData.datasets[1].data.push(totalExpense)
            }
            this.loading = false;
        },
        resetChart: function() {
            //Reset labels, incomes, and expenses on the chart
            this.chartData.labels = [];
            this.chartData.datasets = [];
            this.chartData.datasets.push({
                label: 'Income',
                backgroundColor: '#43A047',
                data: []
            }, {
                label: 'Expense',
                backgroundColor: 'red',
                data: []
            })
        }
    },
    props: {
        budgets: Array,
        incomes: Array,
        expenses: Array,
        auth_url: String
    }
}
</script>

<style scoped>

</style>
