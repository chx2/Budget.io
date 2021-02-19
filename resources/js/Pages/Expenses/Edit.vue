<template>
  <div class="row">
      <div class="col m12 full valign-wrapper">
          <form data-aos="fade-up" class="card full-width" @submit.prevent="submit">
              <div class="card-content">
                  <a :href="'/budgets/' +  form.budget_id" class="green-text tooltipped" data-position="right" data-tooltip="Return to budget"><i class="material-icons">arrow_back</i></a>
                  <h1 class="center-align">Edit Expense</h1>
                  <div class="divider"></div>
                  <div class="row">
                    <div class="col s12">
                      <div class="input-field">
                        <input id="due_date" type="text" class="datepicker validate" name="due_date" v-model.lazy="form.due_date">
                        <label for="due_date">Due Date</label>
                        <div data-aos="fade-in-up" class="error-field" v-if="errors.due_date">{{ errors.due_date[0] }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col s12 m6">
                          <label>
                              Expense Source
                              <input type="text" class="validate" v-model="form.source">
                          </label>
                          <div data-aos="fade-in-up" class="error-field" v-if="errors.source">{{ errors.source[0] }}</div>
                      </div>
                      <div class="col s12 m6">
                          <label>
                              Amount
                              <input type="text" class="validate"  v-model="form.amount">
                          </label>
                          <div data-aos="fade-in-up" class="error-field" v-if="errors.amount">{{ errors.amount[0] }}</div>
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
</template>

<script>
import Layout from "../../components/Layout";
import dayjs from "dayjs";
export default {
    name: "Edit",
    layout: Layout,
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
                due_date: dayjs(this.expense.due_date).format('MMM D, YYYY'),
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
        errors: {
          type:[ Object]
        },
        budget: Number,
        expense: Object
    }
}
</script>

<style scoped>

</style>
