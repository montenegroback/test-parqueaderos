<template>
  <i class="el-icon-refresh" @click="onReload"></i>
</template>

<script>
export default {
  name: "Reloading",
  methods: {
    onReload() {
      this.$emit('onReload');
    }
  }
}
</script>

<style scoped>
  .el-icon-refresh {
    font-weight: bolder;
    font-size: 1.5rem;
    float: right;
    cursor: pointer;
  }
</style>