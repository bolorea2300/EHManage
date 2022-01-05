require("./bootstrap");

window.Vue = require("vue");

import Vue from "vue";
import router from "./router";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
import "material-design-icons-iconfont/dist/material-design-icons.css";
import "@mdi/font/css/materialdesignicons.css";
import axios from "axios";

Vue.component(
    "base-component",
    require("./components/Layouts/Base.vue").default
);

Vue.component(
    "home-component",
    require("./components/Another/Home.vue").default
);

Vue.use(Vuetify);

window.axios = require("axios");

const app = new Vue({
    el: "#app",
    router: router,
    vuetify: new Vuetify(),
});
