import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import index from "./components/index.vue";
import Condition from "./components/Condition.vue";
import Month from "./components/Month.vue";
import Schedule from "./components/Schedule.vue";

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/home",
            name: "index",
            component: index,
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
            path: "/home/schedule",
            name: "Schedule",
            component: Schedule,
        },
    ],
});

export default router;
