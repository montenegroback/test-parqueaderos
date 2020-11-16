<template>
  <div>
    <el-button
      type="primary"
      round
      @click="toogleDrawerAddVehicles"
    >Añadir registro</el-button>

  <el-drawer
    v-loading="loading"
    title=""
    :visible.sync="drawer">
    <el-form
      :model="formAddVehicles"
      :rules="rules"
      ref="formAddVehicles"
      :show-message="false"
      label-position="top"
    >    
      <div class="wrapper__drawer-add-vehicles">
        <h3>Información de registro</h3>
        <hr>

        <h4><strong>Información del cliente</strong></h4>

        <el-row :gutter="20">
          <el-col :xs="24" :sm="12" :md="12">
            <el-form-item label="Nombre" prop="name">
              <el-input v-model="formAddVehicles.name"></el-input>
            </el-form-item>
          </el-col>
          <el-col :xs="24" :sm="12" :md="12">
            <el-form-item label="Cedula" prop="dni">
              <el-input v-model="formAddVehicles.dni"></el-input>
            </el-form-item>
          </el-col>
        </el-row>
        <h4><strong>Información del vehiculo</strong></h4>

        <el-row :gutter="20">
          <el-col :xs="24" :sm="12" :md="12">
            <el-form-item label="Matricula" prop="license">
              <el-input v-model="formAddVehicles.license"></el-input>
            </el-form-item>
          </el-col>
          <el-col :xs="24" :sm="12" :md="12">
            <el-form-item label="Tipo" prop="type">
              <el-input v-model="formAddVehicles.type"></el-input>
            </el-form-item>
          </el-col>
        </el-row>
        <el-form-item label="Marca" prop="vehicle_brand_id">
          <el-select filterable v-model="formAddVehicles.vehicle_brand_id">
            <el-option
              v-for="brand in brands"
              :key="brand.id"
              :label="brand.name"
              :value="brand.id">
            </el-option>
          </el-select>
        </el-form-item>
      </div>

      <el-button
        type="info"
        round
        @click="onAddVehicles('formAddVehicles')"
      >Añadir</el-button>
    </el-form>
  </el-drawer>
  </div>
</template>

<script>

import vehicleServices from "../services/vehicleServices";


export default {
  name: "AddVehicles",
  data: () => ({
    drawer: false,
    loading: false,
    brands: [],
    formAddVehicles: {
      name: "",
      dni: "",
      vehicle_brand_id: "",
      license: "",
      type: ""
    },
    rules: {
      name: [
        { required: true, trigger: 'blur' },
      ],
      dni: [
        { required: true, trigger: 'blur' },
      ],
      vehicle_brand_id: [
        { required: true, trigger: 'change' },
      ],
      license: [
        { required: true, trigger: 'blur' },
      ],
      type: [
        { required: true, trigger: 'blur' },
      ],
    }
  }),
  methods: {
    toogleDrawerAddVehicles() {
      this.drawer = !this.drawer;
    },
    toogleLoading() {
      this.loading = !this.loading;
    },
    onAddVehicles(formAddVehicles) {
      this.$refs[formAddVehicles].validate(async (valid) => {
        if (valid) {
          this.toogleLoading();
          let { data } = await vehicleServices.addVehicles(this.formAddVehicles)
          .finally(() => {
            this.toogleLoading();
          });
          if(data.success) {
            this.$refs[formAddVehicles].resetFields();
            this.onNotify('Nuevo registro', 'Añadido correctamente');
          }
        }
      });
    },
    onNotify(title, message, type = 'success') {
      this.$notify({
        title,
        message,
        type
      });
    },
    async getVehiclesBrands() {
      try {
        const { data } =  await vehicleServices.getVehiclesBrands();
        if(data.success) {
          this.brands = data.data;
        }
      } catch (e) {
        return false;
      }
    },
  },
  mounted() {
    this.getVehiclesBrands();
  }
}
</script>

<style scoped>
  .el-button--primary {
    float: right !important;
    margin-top: 0.5rem;
  }

  .el-button--info {
    margin: auto !important;
    display: block;
  }

  .wrapper__drawer-add-vehicles {
    padding: 0 2rem !important;
  }
</style>