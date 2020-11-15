<template>
  <el-card class="box-card" v-loading="loading">
    <div slot="header" class="clearfix">
      <Reloading @onReload="onReload" />
      <h3><strong>Lista - Vehiculos</strong></h3>
      <p>Información de los ultimos registros de vehiculos ingresados</p>
    </div>

    <div id="searchs">
      <el-input
        placeholder="Por licencia"
        prefix-icon="el-icon-search"
        v-model="searchLicense">
      </el-input>

      <el-input
        placeholder="Nombre o cedula del cliente"
        prefix-icon="el-icon-search"
        v-model="searchClient">
      </el-input>

      <el-button icon="el-icon-search" circle @click="onSearchFilters"></el-button>
    </div>
    
    <el-link @click.prevent="onResetFilters" type="danger"><strong>Limpiar filtros</strong></el-link>
    <el-table
      :data="tableData"
      style="width: 100%">
      <el-table-column
        prop="license"
        label="Placa">
      </el-table-column>
      <el-table-column
        prop="brand.name"
        label="Marca">
      </el-table-column>
      <el-table-column
        prop="type"
        label="Tipo">
      </el-table-column>
      <el-table-column
        prop="user.name"
        label="Cliente">
      </el-table-column>
    </el-table>
  </el-card>
</template>

<script>
import vehicleServices from "../services/vehicleServices";
import Reloading from "../components/utils/Reloading";

export default {
  name: "ListVehicles",
  data: () => ({
    loading: false,
    searchLicense: null,
    searchClient: null,
    tableData: []
  }),
  methods: {
    toogleLoading() {
      this.loading = !this.loading;
    },
    async getVehicles(license, user) {
      try {
        this.toogleLoading();
        const { data } =  await vehicleServices.getVehicles(license, user)
        .finally(() => {
          this.toogleLoading();
        });
        if(data.success) {
          this.tableData = data.data;
        }
      } catch (e) {
        return false;
      }
    },
    onSearchFilters() {
      this.getVehicles(this.searchLicense, this.searchClient);
    },
    onResetFilters() {
      this.searchLicense = null;
      this.searchClient = null;
      this.getVehicles();
    },
    onReload() {
      this.getVehicles();
    }
  },
  components: {
    Reloading
  },
  mounted() {
    this.getVehicles();
  }
}
</script>

<style scoped>
  #searchs {
    display: flex;
    justify-content: flex-end;
    margin: 1rem 0;
  }

  .el-link {
    float: right;
  }

  .el-input {
    max-width: 200px;
    margin-right: 1rem;
  }
</style>