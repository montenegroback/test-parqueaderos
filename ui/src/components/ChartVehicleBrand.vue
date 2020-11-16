<template>
  <el-card class="box-card" v-loading="loading">
    <div slot="header" class="clearfix">
      <Reloading @onReload="onReload" />
      <h3><strong>Marcas - Vehiculos</strong></h3>
      <p>Cantidad de vehiculos ingresados al parqueadero por marcas</p>
    </div>
    <LineChart
      :chartdata="chartdata"
      :options="options"
      v-if="loaded"
    />
  </el-card>
</template>

<script>
import LineChart from "./charts/LineChart";
import vehicleServices from "../services/vehicleServices";
import Reloading from "../components/utils/Reloading";

export default {
  name: "ChartVehicleBrand",
  data: () => ({
    loaded: false,
    loading: false,
    chartdata: null,
    options:  { responsive: true, maintainAspectRatio: false }
  }),
  methods: {
    toogleLoading() {
      this.loading = !this.loading;
    },
    handleResetDataVehicleBrands(data) {
      const vehicleBrands = data.map(d => d.name);
      const vehicleCounts = data.map(d => d.vehicles_count);

      this.chartdata = {
        labels: vehicleBrands,
        datasets: [
          {
            label: "Vehiculos ingresados",
            borderColor: "#31355C",
            fill: false,
            spanGaps: true,
            data: vehicleCounts
          },
        ]
      }
      
      this.loaded = true;
    },
    
    async getVehiclesBrands() {
      try {
        this.toogleLoading();
        const { data } =  await vehicleServices.getVehiclesBrands()
        .finally(() => {
          this.toogleLoading();
        });
        if(data.success) {
          this.handleResetDataVehicleBrands(data.data);
        }
      } catch (e) {
        return false;
      }
    },
    onReload() {
      this.loaded = false;
      this.getVehiclesBrands();
    }
  },
  components: {
    LineChart,
    Reloading
  },
  mounted () {
    this.getVehiclesBrands();
  }
}
</script>

<style></style>