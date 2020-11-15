import api from "@/config/api";


export default {
  getVehiclesBrands() {
    return api().get("/vehicles/brands");
  },
  getVehicles(license = "", user = "") {
    return api().get(`/vehicles?license=${license}&user=${user}`);
  },
  addVehicles(data) {
    return api().post(`/vehicles`, data);
  }
};