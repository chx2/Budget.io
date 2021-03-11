<template>
  <div>
    <h1 class="center-align">Budgets</h1>
    <div class="divider"/>
    <div class="row">
      <div class="col s12" v-if="budgets.length > 0">
        <div class="row" v-if="budgets.length > 1">
          <div class="input-field col s12">
            <input autofocus @keydown="search(query)" v-model="query" placeholder="Enter a budget name..." id="budget" type="text">
          </div>
        </div>
        <div data-aos="fade-up" class="collection">
          <div class="collection-item" v-for="budget in budgets" :key="budget.id">
            <div class="row">
              <a v-bind:href="'/budgets/'+ budget.uid">
                <div class="col s12 m4">
                  <p class="green-text center-align">{{ budget.name }}</p>
                </div>
                <div class="col s12 m4">
                  <p class="green-text center-align">{{ humanDate(budget.start_date) }} - {{ humanDate(budget.end_date) }}</p>
                </div>
              </a>
              <div class="col s12 m4">
                <a class="collection-item cursor-pointer full-width center-align hoverable" @click="deleteBudget(budget)"><i class="material-icons">delete</i></a>
              </div>
            </div>
          </div>
          <inertia-link :href="$route('budgets.create')" class="collection-item btn full-width"><i class="center-align material-icons">add</i></inertia-link>
        </div>
      </div>
      <div class="col s12" data-aos="fade-in" v-else>
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
import dayjs from "dayjs";
export default {
    name: "Index",
    layout: Layout,
    metaInfo: {
        title: 'Budgets',
        titleTemplate: '%s | Budget.io',
        htmlAttrs: {
            lang: 'en',
        }
    },
    data() {
      return {
        query: null
      }
    },
    methods: {
        humanDate: function(timestamp) {
            return dayjs(timestamp).format('MMM D, YYYY')
        },
        deleteBudget(budget) {
            if(confirm('Are you sure you want to delete this budget? You will lose all records associated with this budget.')) {
                budget._method = 'DELETE';
                this.$inertia.post('/budgets/' + budget.id, budget)
            }
        },
        search(query) {
          let first = [];
          let others = [];
          for (let i = 0; i < this.budgets.length; i++) {
            if (this.budgets[i].name.toLowerCase().indexOf(query.toLowerCase()) === 0) {
              first.push(this.budgets[i]);
            } else {
              others.push(this.budgets[i]);
            }
          }
          first.sort();
          others.sort();
          this.budgets = first.concat(others)
        }
    },
    props: {
        budgets: Array
    }
}
</script>

<style scoped>

</style>
