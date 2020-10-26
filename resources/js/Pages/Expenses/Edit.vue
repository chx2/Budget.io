<template>
    <layout :auth_url="auth_url">
        <div class="row">
            <div class="col m12 full valign-wrapper">
                <form data-aos="fade-up" class="card full-width" @submit.prevent="submit">
                    <div class="card-content">
                        <a :href="'/budgets/' +  form.budget_id" class="green-text tooltipped" data-position="right" data-tooltip="Return to budget"><i class="material-icons">arrow_back</i></a>
                        <h1 class="center-align">Edit Expense</h1>
                        <div class="divider"></div>
                        <div class="row">
                            <div class="col s12 m6">
                                <label>
                                    Expense Source
                                    <input type="text" class="validate" v-model="form.source" v-focus>
                                </label>
                                <div data-aos="fade-in-up" class="error-field" v-if="$page.errors.source">{{ $page.errors.source[0] }}</div>
                            </div>
                            <div class="col s12 m6">
                                <label>
                                    Amount
                                    <input type="text" class="validate"  v-model="form.amount">
                                </label>
                                <div data-aos="fade-in-up" class="error-field" v-if="$page.errors.amount">{{ $page.errors.amount[0] }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <label>
                                    Notes
                                    <textarea class="materialize-textarea" v-model="form.notes"></textarea>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button class="btn btn-block green darken-1 waves-effect waves-light" type="submit" name="action">Submit
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </layout>
</template>

<script>
import Layout from "../../components/Layout";
export default {
    name: "Edit",
    components: {Layout},
    metaInfo: {
        title: 'Edit Expense',
        titleTemplate: '%s | Budget.io',
        htmlAttrs: {
            lang: 'en',
        }
    },
    data() {
        return {
            form: {
                source: this.expense.source,
                amount: this.expense.amount,
                notes: this.expense.notes,
                budget_id: this.budget
            }
        }
    },
    methods: {
        submit() {
            this.$inertia.put('/expenses/' + this.expense.id, this.form)
        }
    },
    props: {
        budget: Number,
        expense: Object,
        auth_url: String
    }
}
</script>

<style scoped>

</style>
