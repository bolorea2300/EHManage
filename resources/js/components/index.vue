<template>
    <v-container>
        {{ auth.id }}
    </v-container>
</template>

<script>
export default {
    props: {
        auth: {
            required: true,
        },
    },
    data: () => ({}),
    created() {},
    methods: {},
    watch: {},
};
</script>
