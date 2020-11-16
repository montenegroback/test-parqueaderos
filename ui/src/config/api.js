import axios from "axios";

export default () => {
  return axios.create({
    baseURL: `https://api-parqueaderon4.herokuapp.com/api/`,
    withCredentials: false,
    headers: {
      Accept: "application/json",
    }
  });
};
