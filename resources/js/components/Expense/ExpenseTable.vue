<template>
    <div>
        <table class="highlight responsive-table">
            <thead>
                <tr>
                    <th>Expense Source</th>
                    <th>Amount</th>
                    <th class="center-align">Notes</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="expense in expenses">
                    <td>{{ expense.source }}</td>
                    <td>{{ numberWithCommas(expense.amount) }}</td>
                    <td class="cursor-pointer hoverable center-align modal-trigger" data-target="modalExpense" @click="notesModal(expense.notes)"><i class="material-icons black-text">open_in_new</i></td>
                    <td class="cursor-pointer hoverable center-align"><inertia-link :href="$route('expenses.edit', expense.id)" class="black-text"><i class="center-align material-icons">edit</i></inertia-link></td>
                    <td class="cursor-pointer hoverable center-align" @click="deleteExpense(expense)"><i class="material-icons">delete</i></td>
                </tr>
            </tbody>
            <tfoot>
                <tr  class="bold">
                    <td>Total</td>
                    <td class="red-text">{{ numberWithCommas(total_expense) }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        <inertia-link :href="$route('expenses.create') + '?budget=' + budget" class="btn green full-width"><i class="center-align material-icons">add</i></inertia-link>

        <div id="modalExpense" class="modal">
            <div class="modal-content">
                <p>{{ notes }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ExpenseTable",
    data() {
        return {
            data: {
                source: null,
                amount: null,
                notes: null
            },
            notes: null
        }
    },
    computed: {
        total_expense: function() {
            let expense = 0;
            for (let exp of this.expenses) {
                expense = expense + parseFloat(exp.amount);
            }
            return expense.toFixed(2);
        }
    },
    methods: {
        submit() {
            this.$inertia.post('/expenses', this.data)
        },
        deleteExpense(expense) {
            expense._method = 'DELETE';
            this.$inertia.post('/expenses/' + expense.id, expense)
        },
        numberWithCommas(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
        notesModal(notes) {
            this.notes = notes;
        }
    },
    props: {
        budget: Number,
        expenses: Array
    }
}
</script>

<style scoped>

</style>
