<template>
  <div class="row">
      <div class="col m12 full full-width valign-wrapper">
          <form data-aos="fade-up" class="card full-width" @submit.prevent="submit">
              <div class="card-content">
                  <h1 class="center-align">Register</h1>
                  <div class="divider"></div>
                  <div class="input-field">
                      <i class="material-icons prefix">person</i>
                      <input id="name" type="text" name="name" class="validate" v-model="form.name">
                      <label for="name">Name</label>
                      <div data-aos="fade-in-up" class="error-field" v-if="errors.name">{{ errors.name[0] }}</div>
                  </div>
                  <div class="input-field">
                      <i class="material-icons prefix">email</i>
                      <input id="email" type="text" name="email" class="validate" v-model="form.email">
                      <label for="email">E-Mail</label>
                      <div data-aos="fade-in-up" class="error-field" v-if="errors.email">{{ errors.email[0] }}</div>
                  </div>
                  <div class="input-field">
                      <i class="material-icons prefix">fingerprint</i>
                      <input id="password" type="password" name="password" class="validate" v-model="form.password">
                      <label for="password">Password</label>
                      <div data-aos="fade-in-up" class="error-field" v-if="errors.password">{{ errors.password[0] }}</div>
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
    name: "Register",
    layout: Layout,
    metaInfo: {
        title: 'Register',
        titleTemplate: '%s | Budget.io',
        htmlAttrs: {
            lang: 'en',
        }
    },
    data() {
        return {
            form: {
                name: null,
                email: null,
                password: null
            }
        }
    },
    methods: {
        submit() {
            this.$inertia.post('/users', this.form)
        },
    },
    props: {
      errors: {
        type:[ Object]
      },
    }
}
</script>

<style scoped>

</style>
