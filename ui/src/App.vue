<template>
  <el-container id="app">
    <el-header>
      <el-row>
        <el-col :xs="12" :sm="12" :md="12">
          <h3>Parqueaderos 4 ruedas</h3>

        </el-col>
        <el-col :xs="12" :sm="12" :md="12">
          <AddVehicles />
        </el-col>
      </el-row>
    </el-header>
    <el-main>
      <el-row :gutter="20">
        <el-col :xs="24" :sm="24" :md="12" :lg="12">
          <ChartVehicleBrand />
        </el-col>
        <el-col :xs="24" :sm="24" :md="12" :lg="12">
          <ListVehicles />
        </el-col>
      </el-row>
    </el-main>
  </el-container>
</template>

<script>

import ChartVehicleBrand from "./components/ChartVehicleBrand";
import ListVehicles from "./components/ListVehicles";
import AddVehicles from "./components/AddVehicles";

export default {
  name: 'App',
  components: {
    ChartVehicleBrand,
    ListVehicles,
    AddVehicles
  }
}
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap");

body {
  background-color: #E9F2F7;
  font-family: "Manrope", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  font-size: 14px !important;
  margin: 0;
  padding: 0;
}

.el-header {
  background-color: #ffffff;
}
</style>

