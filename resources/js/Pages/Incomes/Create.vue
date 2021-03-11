<template>
  <div class="row">
      <div class="col m12 full valign-wrapper">
          <form data-aos="fade-up" class="card full-width" @submit.prevent="submit">
              <div class="card-content">
                  <a :href="'/budgets/' +  form.budget_id" class="green-text tooltipped" data-position="right" data-tooltip="Return to budget"><i class="material-icons">arrow_back</i></a>
                  <h1 class="center-align">Add Income</h1>
                  <div class="divider"></div>
                  <div class="row">
                      <div class="col s12 m6">
                          <label>
                              Income Source
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
export default {
    name: "Create",
    layout: Layout,
    metaInfo: {
        title: 'Add Income',
        titleTemplate: '%s | Budget.io',
        htmlAttrs: {
            lang: 'en',
        }
    },
    data() {
        return {
            form: {
                source: null,
                amount: null,
                notes: null,
                budget: this.budget
            }
        }
    },
    methods: {
        submit() {
            this.$inertia.post('/incomes', this.form)
        }
    },
    props: {
        errors: {
          type:[ Object]
        },
        budget: String
    }
}
</script>

<style scoped>

</style>
