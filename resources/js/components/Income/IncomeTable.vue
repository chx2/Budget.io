<template>
    <div>
        <table class="highlight responsive-table">
            <thead>
                <tr>
                    <th>Source</th>
                    <th>Amount</th>
                    <th class="center-align">Notes</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="income in incomes">
                    <td>{{ income.source }}</td>
                    <td>{{ numberWithCommas(income.amount) }}</td>
                    <td class="cursor-pointer hoverable center-align modal-trigger" data-target="modalIncome" @click="notesModal(income.notes)"><i class="material-icons black-text">open_in_new</i></td>
                    <td class="cursor-pointer hoverable center-align"><inertia-link :href="$route('incomes.edit', income.uid)" class="black-text"><i class="center-align material-icons">edit</i></inertia-link></td>
                    <td class="cursor-pointer hoverable center-align" @click="deleteIncome(income)"><i class="material-icons black-text">delete</i></td>
                </tr>
            </tbody>
            <tfoot>
                <tr  class="bold">
                    <td>Total</td>
                    <td class="green-text">{{ numberWithCommas(total_income) }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        <inertia-link :href="$route('incomes.create') + '?budget=' + budget" class="btn green full-width"><i class="center-align material-icons">add</i></inertia-link>

        <div id="modalIncome" class="modal">
            <div class="modal-content">
                <p>{{ notes }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "IncomeTable",
    data() {
        return {
            data: {
                name: null,
                amount: null,
                notes: null
            },
            notes: null
        }
    },
    computed: {
        total_income: function () {
            let income = 0;
            for (let inc of this.incomes) {
                income = income + parseFloat(inc.amount);
            }
            return income.toFixed(2);
        },
    },
    methods: {
        deleteIncome(income) {
            income._method = 'DELETE';
            this.$inertia.post('/incomes/' + income.uid, income)
        },
        numberWithCommas(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
        notesModal(notes) {
            this.notes = notes;
        }
    },
    props: {
        budget: String,
        incomes: Array
    }
}
</script>

<style scoped>

</style>
