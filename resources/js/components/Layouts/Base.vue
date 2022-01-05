<template>
    <v-app id="inspire">
        <v-navigation-drawer v-model="drawer" app>
            <side></side>
        </v-navigation-drawer>

        <v-app-bar app>
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

            <v-toolbar-title>EHmanage</v-toolbar-title>
            <v-spacer> </v-spacer>
            <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                    <form action="/logout" method="POST">
                        <input type="hidden" name="_token" :value="csrf" />
                        <v-btn type="submit" v-bind="attrs" v-on="on">
                            <v-icon>mdi-logout</v-icon>
                        </v-btn>
                    </form>
                </template>
                <span>ログアウト</span>
            </v-tooltip>
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
    data: () => ({
        drawer: null,
        csrf: document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
    }),
};
</script>
