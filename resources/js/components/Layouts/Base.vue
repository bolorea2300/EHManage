<template>
    <v-app id="inspire">
        <v-navigation-drawer v-model="drawer" app>
            <side></side>
        </v-navigation-drawer>

        <v-app-bar app>
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

            <v-toolbar-title>EHmanage</v-toolbar-title>
        </v-app-bar>

        <v-main>
            <router-view v-bind:auth="auth"></router-view>
        </v-main>
    </v-app>
</template>

<script>
import side from "./Side";

export default {
    components: {
        side,
    },
    props: {
        auth: {
            required: true,
        },
    },
    data: () => ({ drawer: null }),
};
</script>
