<template>
  <div class="row">
      <div class="col m12 full valign-wrapper">
          <form data-aos="fade-up" class="card full-width" @submit.prevent="submit">
              <div class="card-content">
                  <h1 class="center-align">Create Budget</h1>
                  <div class="divider"></div>
                  <div class="row">
                      <div class="col s12">
                          <div class="input-field">
                              <input id="name" type="text" name="name" class="validate" v-model="form.name">
                              <label for="name">Budget Name</label>
                              <div data-aos="fade-in-up" class="error-field" v-if="errors.name">{{ errors.name[0] }}</div>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col s12 m6">
                          <div class="input-field">
                              <input id="start_date" type="text" class="datepicker validate" name="start_date" v-model.lazy="form.start_date">
                              <label for="start_date">Start Date</label>
                              <div data-aos="fade-in-up" class="error-field" v-if="errors.start_date">{{ errors.start_date[0] }}</div>
                          </div>
                      </div>
                      <div class="col s12 m6">
                          <div class="input-field">
                              <input id="end_date" type="text" class="datepicker validate" name="end_date" v-model.lazy="form.end_date">
                              <label for="end_date">End Date</label>
                              <div data-aos="fade-in-up" class="error-field" v-if="errors.end_date">{{ errors.end_date[0] }}</div>
                          </div>
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
        title: 'Create Budget',
        titleTemplate: '%s | Budget.io',
        htmlAttrs: {
            lang: 'en',
        }
    },
    data() {
        return {
            form: {
                name: null,
                start_date: null,
                end_date: null
            }
        }
    },
    methods: {
        submit() {
            this.$inertia.post('/budgets', this.form)
        },
    },
    props: {
      errors: {
        type:[ Object]
      }
    }
}
</script>

<style scoped>

</style>
