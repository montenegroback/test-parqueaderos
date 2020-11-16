<template>
  <div>
    <el-button
      type="default"
      round
      @click="toogleDrawerFormatArray"
    >Demo funionalidad</el-button>

    <el-drawer
      title=""
      :visible.sync="drawer">
      <div class="wrapper__drawer-demo">
        <h3>DEMO</h3>
        <hr>
        <h4>Dado el siguiente array</h4>
        {{ values }}


        <h4>Se genera el siguiente object</h4>
        <WrapperCode>
          <template slot>
            {{ format }}
          </template>
        </WrapperCode>
      </div>
    </el-drawer>
  </div>
</template>

<script>

import WrapperCode from "./utils/WrapperCode";

export default {
  name: "DemoFormatArray",
  data: () => ({
    drawer: false,
    values: null,
    format: null,
  }),
  methods: {
    handleFormatArrayToJson(values) {
      let output = {}
      values.forEach((v, i) => {
        if(Object.keys(output).includes(values[i][0])) {
          let isEqualHour = Object.keys(output[values[i][0]]).includes(values[i][1]);
          output = {
            ...output,
            ...{
              [values[i][0]]: {
                ...output[values[i][0]],
                ...{
                  [values[i][1]]: isEqualHour ? 
                                  values[i][3] + output[values[i][0]][values[i][1]] 
                                  : values[i][3]
                }
              }
            }
          }
          
        } else {
          output = {
          ...output,
          ...{
              [values[i][0]]: {
                [values[i][1]]: values[i][3]
              }
            },
          }
        }
      });

      return output;
    },
    toogleDrawerFormatArray() {
      this.drawer = !this.drawer;
    }
  },
  components: {
    WrapperCode
  },
  mounted() {
     let values = [
      ['​2018-12-01', 'AM', 'ID123', 5000],
      ['​2018-12-01', 'AM', 'ID545', 7000],
      ['​2018-12-01', 'PM', 'ID545', 3000],
      ['​2018-12-02', 'AM', 'ID545', 7000],
     ];
    this.values = values;
    this.format = this.handleFormatArrayToJson(values);
  }
}
</script>

<style scoped>
  .wrapper__drawer-demo {
    padding: 0 2rem !important;
  }

  .el-drawer__body {
		height: 100% !important;
		box-sizing: border-box !important;
		overflow-y: auto !important;
	}
</style>