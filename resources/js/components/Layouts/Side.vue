<template>
    <v-list-item-group v-model="selectedItem" color="primary">
        <v-list-item to="/home/condition">
            <v-list-item-icon>
                <v-icon>mdi-home</v-icon>
            </v-list-item-icon>
            <v-list-item-title>体調管理</v-list-item-title>
        </v-list-item>
        <v-list-item to="/home/month">
            <v-list-item-icon>
                <v-icon>mdi-home</v-icon>
            </v-list-item-icon>
            <v-list-item-title>月ごとの管理</v-list-item-title>
        </v-list-item>
        <v-list-item to="/home/year">
            <v-list-item-icon>
                <v-icon>mdi-home</v-icon>
            </v-list-item-icon>
            <v-list-item-title>年ごとの管理</v-list-item-title>
        </v-list-item>
        <v-list-item to="/home/schedule">
            <v-list-item-icon>
                <v-icon>mdi-home</v-icon>
            </v-list-item-icon>
            <v-list-item-title>スケジュール管理</v-list-item-title>
        </v-list-item>
    </v-list-item-group>
</template>

<style lang="scss"></style>

<script>
export default {
    data: () => ({
        word: null,
        selectedItem: 1,
    }),
};
</script>
