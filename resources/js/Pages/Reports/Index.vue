<template>
    <div>
        <h1 class="center-align">Reports</h1>
        <div class="divider"></div>
        <div class="row">
            <div class="col m12 full" v-if="budgets.length > 0">
                <div data-aos="fade-up" class="card-content">
                    <div class="row">
                        <div class="col s12">
                            <label>
                                Select a Budget:
                                <select v-model="form.budget">
                                    <option v-for="budget in budgets" :value="budget.id">{{ budget.name }}</option>
                                </select>
                            </label>
                            <div data-aos="fade-in-up" class="error-field" v-if="errors.budget">Please select a budget</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <label>
                                Select a report type:
                                <select v-model="form.type">
                                    <option value="total" selected>Complete Report</option>
                                    <option value="income">Income Report</option>
                                    <option value="expense">Expense Report</option>
                                </select>
                            </label>
                            <div data-aos="fade-in-up" class="error-field" v-if="errors.type">Please select a report type</div>
                        </div>
                    </div>
                    <button @click="submit" class="btn btn-block full-width cursor-pointer green">Submit</button>
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
export default {
    name: "Index",
    layout: Layout,
    metaInfo: {
        title: 'Create Report',
        titleTemplate: '%s | Budget.io',
        htmlAttrs: {
            lang: 'en',
        }
    },
    data() {
        return {
            form: {
                budget: null,
                type: null
            },
            errors: {
                budget: false,
                type: false
            }
        }
    },
    methods: {
        submit: function() {
            this.errors.budget = (this.form.budget === null || this.form.budget === '');
            this.errors.type = (this.form.type === null || this.form.type === '');
            if (!this.errors.budget && !this.errors.type) {
                window.open('/export?budget=' + this.form.budget + '&type=' + this.form.type, '_blank');
            }
        }
    },
    props: {
        budgets: Array
    }
}
</script>

<style scoped>

</style>
