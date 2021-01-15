<template>
  <div>
    <h1 class="center-align">Budgets</h1>
    <div class="divider"/>
    <div class="row">
      <div class="col s12" v-if="budgets.length > 0">
        <div data-aos="fade-up" class="collection">
          <div class="collection-item" v-for="budget in budgets" :key="budget.id">
            <div class="row">
              <a v-bind:href="'/budgets/'+ budget.id">
                <div class="col s12 m4">
                  <p class="green-text center-align">{{ budget.name }}</p>
                </div>
                <div class="col s12 m4">
                  <p class="green-text center-align">{{ humanDate(budget.start_date) }} - {{ humanDate(budget.end_date) }}</p>
                </div>
              </a>
              <div class="col s12 m2">
                <a class="collection-item cursor-pointer full-width center-align hoverable tooltipped" data-position="bottom" data-tooltip="Delete Budget" @click="deleteBudget(budget)"><i class="material-icons">delete</i></a>
              </div>
            </div>
          </div>
          <inertia-link :href="$route('budgets.create')" class="collection-item btn full-width tooltipped" data-position="bottom" data-tooltip="Create New Budget"><i class="center-align material-icons">add</i></inertia-link>
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
    methods: {
        humanDate: function(timestamp) {
            return dayjs(timestamp).format('MMM D, YYYY')
        },
        deleteBudget(budget) {
            if(confirm('Are you sure you want to delete this budget? You will lose all records associated with this budget.')) {
                budget._method = 'DELETE';
                this.$inertia.post('/budgets/' + budget.id, budget)
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
