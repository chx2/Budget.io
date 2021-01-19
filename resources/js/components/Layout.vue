<template>
    <div>
        <navigation :path="this.$page.props.path" :auth="this.$page.props.auth"></navigation>
        <main class="row content">
            <div class="col m12 background full-width">
                <div class="container">
                    <div class="row">
                        <div class="col m12 full full-width">
                            <slot />
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import Navigation from "./Navigation";
export default {
    name: "Layout",
    components: {Navigation}
}
</script>

<style lang="scss" scoped>
    .full {
        height: 100vh;
    }
</style>
