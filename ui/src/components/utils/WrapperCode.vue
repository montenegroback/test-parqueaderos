<template>
  <div v-highlight>
    <pre :class="className">
      <code>
        <slot></slot>
      </code>
    </pre>
  </div>
</template>

<script>
export default {
  name: "WrapperCode",

  props: {
    className: {
      default: "language-javascript"
    }
  }
}
</script>

<style></style>