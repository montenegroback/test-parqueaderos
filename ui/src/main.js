import Vue from 'vue'
import App from './App.vue'
import Element from "element-ui";
import locale from "element-ui/lib/locale/lang/es";
import "element-ui/lib/theme-chalk/index.css";
import VueCodeHighlight from 'vue-code-highlight';
import "vue-code-highlight/themes/window.css";


Vue.config.productionTip = false

// Element ui
Vue.use(Element, { locale });

Vue.use(VueCodeHighlight);

new Vue({
  render: h => h(App),
}).$mount('#app')
