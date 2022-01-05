import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Condition from "./components/Condition.vue";
import Month from "./components/Month.vue";
import Year from "./components/Year.vue";
import Schedule from "./components/Schedule.vue";
import Setting from "./components/Setting.vue";
import Use from "./components/Use.vue";

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/home",
            name: "index",
            component: Schedule,
        },
        {
            path: "/home/condition",
            name: "Condition",
            component: Condition,
        },
        {
            path: "/home/month",
            name: "Month",
            component: Month,
        },
        {
            path: "/home/year",
            name: "Year",
            component: Year,
        },
        {
            path: "/home/setting",
            name: "Setting",
            component: Setting,
        },
        {
            path: "/home/use",
            name: "Use",
            component: Use,
        },
    ],
});

export default router;
