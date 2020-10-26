<template>
    <table class="highlight responsive-table">
        <thead>
            <tr>
                <th>Total</th>
                <th class="right-align">Amounts</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Income</td>
                <td class="right-align green-text">{{ numberWithCommas(income) }}</td>
            </tr>
            <tr>
                <td>Expense</td>
                <td class="right-align red-text">{{ numberWithCommas(expense) }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr class="bold">
                <td>Ending Balance</td>
                <td :class="total_class">{{ numberWithCommas(total) }}</td>
            </tr>
        </tfoot>
    </table>
</template>

<script>
export default {
    name: "TotalTable",
    computed: {
        total: function () {
            return this.income - this.expense;
        },
        total_class: function() {
            let total = this.income - this.expense;
            return (total < 0) ? 'red-text right-align' : 'green-text right-align';
        }
    },
    methods: {
        numberWithCommas(number) {
            return number.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    },
    props: {
        income: Number,
        expense: Number,
    }
}
</script>

<style scoped>

</style>
