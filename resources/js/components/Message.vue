<template>
  <div data-aos="fade-in" class="card-panel" :class="(success) ? 'green' : 'red'">
    <p class="white-text center-align" v-html="message"/>
  </div>
</template>

<script>
export default {
  name: "Message",
  props: {
    success: {
      type: Boolean,
      required: true
    },
    message: {
      type: String,
      required: true
    }
  }
}
</script>

<style scoped>

</style>
