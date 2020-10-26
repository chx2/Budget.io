<template>
    <div>
        <navigation :auth_url="auth_url"></navigation>
        <main class="row content">
            <div class="col m12 background">
                <div class="container">
                    <div class="row">
                        <div class="col m12 full">
                            <slot />
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import M from 'materialize-css'
import Navigation from "./Navigation";
export default {
    name: "Layout",
    components: {Navigation},
    props: {
        auth_url: String
    },
    mounted() {
        M.AutoInit();
    }
}
</script>

<style lang="scss" scoped>
    .full {
        height: 100vh;
    }
</style>
