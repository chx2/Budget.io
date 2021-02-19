<template>
    <div>
        <h1 class="center-align">Stats</h1>
        <div class="divider"/>
        <div class="row">
            <div class="col m12 full" data-aos="fade-in" v-if="budgets.length > 0">
                <message v-if="prompt" :success="success" :message="message"></message>
                <div v-else>
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
                  <div class="row">
                    <div class="col m12">
                      <budget-line ref="chart"
                                   :selected="selected"
                                   :incomes="incomes"
                                   :expenses="expenses"></budget-line>
                    </div>
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
    </div>
</template>

<script>
import Layout from "../../components/Layout";
import Message from "../../components/Message";
import LineChart from "../../components/Charts/LineChart";
import BudgetLine from "../../components/Charts/BudgetLine";
export default {
    name: "Index",
    layout: Layout,
    components: {BudgetLine, Message, LineChart},
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
            prompt: null,
            success: null,
            message: '',
            selected: []
        }
    },
    methods: {
        updateChart() {
          this.$refs.chart.updateChart()
        }
    },
    props: {
        budgets: Array,
        incomes: Array,
        expenses: Array
    }
}
</script>

<style scoped>

</style>
