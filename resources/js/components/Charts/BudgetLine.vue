<template>
  <div>
    <div v-if="loading">
      <spinner></spinner>
    </div>
    <div v-else>
      <line-chart :chart-data="chartData" :options="options"></line-chart>
    </div>
  </div>
</template>

<script>
import LineChart from "../../components/Charts/LineChart";
import Spinner from "../Spinner";
export default {
  name: "BudgetLine",
  components: {Spinner, LineChart},
  props: ['selected', 'incomes', 'expenses'],
  data() {
    return {
      loading: null,
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
    updateChart: async function () {
      this.loading = true;
      //Reset data points
      await this.resetChart();
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
    resetChart: function () {
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
  }
}
</script>

<style scoped>

</style>
