<template>
    <div>
        <h1 id="income" class="center-align">{{ budget.name }}</h1>
        <div class="divider"/>
        <div class="row">
            <div class="col s12 m12 l6">
                <income-table data-aos="fade-in-up" :budget="budget.uid" :incomes="incomes"></income-table>
            </div>
          <div class="col s12 m12 l6">
            <expense-table data-aos="fade-in-up" :budget="budget.uid" :expenses="expenses"></expense-table>
          </div>
        </div>
        <h2 class="center-align">Totals</h2>
        <div class="row">
            <div class="col s12">
                <message v-if="prompt" :success="success" :message="message"></message>
                <total-table data-aos="fade-in-up" :income="total_income" :expense="total_expense"></total-table>
            </div>
        </div>
    </div>
</template>

<script>
import Layout from "../../components/Layout";
import Message from "../../components/Message";
import IncomeTable from "../../components/Income/IncomeTable";
import ExpenseTable from "../../components/Expense/ExpenseTable";
import TotalTable from "../../components/Total/TotalTable";
import dayjs from 'dayjs';
export default {
    name: "Show",
    layout: Layout,
    components: {Message, TotalTable, ExpenseTable, IncomeTable},
    metaInfo: {
        title: 'View Budget',
        titleTemplate: '%s | Budget.io',
        htmlAttrs: {
            lang: 'en',
        }
    },
    data() {
      return {
        prompt: null,
        success: null,
        message: ''
      }
    },
    created() {
      if (this.total_income - this.total_expense > 0) {
        this.prompt = true;
        this.success = true;
        this.message = 'Your ending net balance is positive!';
      }
      else if (this.total_income - this.total_expense < 0) {
        this.prompt = true;
        this.success = false;
        this.message = 'Your ending net balance is negative.';
      }
    },
    computed: {
        total_income: function() {
            let income = 0;
            for (let inc of this.incomes) {
                income = income + parseFloat(inc.amount);
            }
            return income;
        },
        total_expense: function() {
            let expense = 0;
            for (let exp of this.expenses) {
                expense = expense + parseFloat(exp.amount);
            }
            return expense;
        },
    },
    methods: {
        humanDate: function(timestamp) {
            return dayjs(timestamp).format('MMM D, YYYY')
        }
    },
    props: {
        budget: Object,
        incomes: Array,
        expenses: Array
    }
}
</script>

<style scoped>

</style>
