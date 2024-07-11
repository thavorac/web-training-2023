// request.js
import axios from "axios";
import { Config } from "./helper";

export const request = async (url = "", method = "get", data = {}) => {
  try {
    const response = await axios({
      url: Config.base_url + url,
      method: method,
      data: data,
      headers: {}
    });
    return response.data;
  } catch (error) {
    if (error.response && error.response.status === 404) {
      alert(error.message);
    }
    console.error(error);
    return false;
  }
};