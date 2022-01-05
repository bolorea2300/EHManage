<template>
    <v-container>
        <v-card>
            <v-card-text>
                <v-text-field
                    type="password"
                    v-model="password"
                    label="旧パスワード"
                    required
                ></v-text-field>
                <v-text-field
                    type="password"
                    v-model="newpassword"
                    label="新規パスワード"
                    required
                ></v-text-field>
                <v-text-field
                    type="password"
                    v-model="repassword"
                    label="新パスワードの確認"
                    required
                ></v-text-field>
                <v-btn block @click="change" v-bind:disabled="check">
                    変更
                </v-btn>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>
export default {
    props: {
        auth: {
            required: true,
        },
    },
    data: () => ({
        password: "",
        newpassword: "",
        repassword: "",
    }),
    created() {},
    methods: {
        change: function () {
            let formData = new FormData();

            formData.append("password", this.password);
            formData.append("newpassword", this.newpassword);
            formData.append("repassword", this.repassword);

            axios
                .post("/password", formData)
                .then((res) => {
                    alert(res.data);
                    this.password = "";
                    this.newpassword = "";
                    this.repassword = "";
                })
                .catch((error) => {
                    alert(
                        "エラーが発生しました。\n時間をおいてやり直してください。"
                    );
                });
        },
    },
    computed: {
        check: function () {
            if (
                this.password &&
                this.newpassword &&
                this.repassword &&
                this.newpassword === this.repassword
            ) {
                return false;
            } else {
                return true;
            }
        },
    },
};
</script>
