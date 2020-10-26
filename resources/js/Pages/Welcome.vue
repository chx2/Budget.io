<template>
    <layout :auth_url="auth_url">
        <h1 class="center-align">Welcome to Budget.io</h1>
        <div class="divider"/>
        <div class="row panel">
            <div data-aos="fade-right" class="col s12 m6 center-align">
                <h2>Manage Your Budget</h2>
                <p class="flow-text">
                    Create monthly budgets to track income, spending,
                    and changes between your budget periods.
                </p>
            </div>
            <div data-aos="fade-left" class="col s12 m6 center-align">
                <img class="responsive-img" alt="Table Icon" src="/img/table.png">
            </div>
        </div>
        <div class="divider"/>
        <div class="row panel">
            <div data-aos="fade-right" class="col s12 m6 center-align">
                <img class="responsive-img" alt="Table Icon" src="/img/report.png">
            </div>
            <div data-aos="fade-left" class="col s12 m6 center-align">
                <h2>Create Reports</h2>
                <p class="flow-text">
                    Print off monthly reports, income, and expense statements separately.
                </p>
            </div>
        </div>
        <div class="divider"/>
        <div class="row panel">
            <div data-aos="fade-right" class="col s12 m6 center-align">
                <h2>Gather Insights</h2>
                <p class="flow-text">
                    Learn about trends over time when creating budgets.
                    Learn through various charts about tips for improving
                    areas of your budget and suggested improvements.
                </p>
            </div>
            <div data-aos="fade-left" class="col s12 m6 center-align">
                <img class="responsive-img" alt="Table Icon" src="/img/chart.png">
            </div>
        </div>
    </layout>
</template>

<script>
import Layout from "../components/Layout";
export default {
    name: "Welcome",
    components: {Layout},
    metaInfo: {
        title: 'Welcome',
        titleTemplate: '%s | Budget.io',
        htmlAttrs: {
            lang: 'en',
        }
    },
    props: {
        auth_url: String
    }
}
</script>

<style scoped>

</style>
