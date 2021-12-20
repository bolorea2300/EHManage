<template>
    <v-container>
        <v-btn block @click="addbutton"> 追加 </v-btn>

        <v-row>
            <v-col v-for="(list, n) in data" :key="n" cols="12" sm="6" md="4">
                <v-card class="pa-2" outlined tile>
                    <v-card-title>{{ list.time }}</v-card-title>
                    <v-card-text>
                        <h3>体温</h3>
                        <p>{{ list.temperature }}℃</p>
                        <h3>体調</h3>
                        <v-rating
                            :value="list.rating"
                            background-color="orange lighten-3"
                            color="orange"
                            large
                        ></v-rating>
                    </v-card-text>

                    <v-card-actions>
                        <v-btn block @click="confirm(list.id)">削除する</v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>

        <v-pagination v-model="page" :length="count"></v-pagination>

        <v-dialog v-model="adddialog" width="500">
            <v-card>
                <v-card-title class="text-h5 grey lighten-2">
                    体調登録
                </v-card-title>

                <v-card-text>
                    <v-menu
                        ref="menu"
                        v-model="menu"
                        :close-on-content-click="false"
                        :return-value.sync="date"
                        transition="scale-transition"
                        offset-y
                        min-width="auto"
                    >
                        <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                                v-model="date"
                                label="Picker in menu"
                                prepend-icon="mdi-calendar"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                            ></v-text-field>
                        </template>
                        <v-date-picker v-model="date" no-title scrollable>
                            <v-spacer></v-spacer>
                            <v-btn text color="primary" @click="menu = false">
                                Cancel
                            </v-btn>
                            <v-btn
                                text
                                color="primary"
                                @click="$refs.menu.save(date)"
                            >
                                OK
                            </v-btn>
                        </v-date-picker>
                    </v-menu>
                    <v-text-field
                        v-model="temperature"
                        label="体温"
                        required
                    ></v-text-field>

                    <h3>体調</h3>
                    <v-rating
                        v-model="rating"
                        background-color="orange lighten-3"
                        color="orange"
                        large
                    ></v-rating>
                </v-card-text>

                <v-card-actions>
                    <v-btn block @click="add"> 追加 </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <v-dialog v-model="deletedialog" width="500">
            <v-card>
                <v-card-title class="text-h5 grey lighten-2">
                    本当に削除しますか?
                </v-card-title>

                <v-card-actions>
                    <v-btn block @click="deletedata">削除</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
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
        date: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
            .toISOString()
            .substr(0, 10),
        menu: false,
        page: 1,
        adddialog: false,
        deletedialog: false,
        temperature: 0,
        rating: 5,
        data: [],
        count: 0,
        delete_id: 0,
    }),
    created() {
        axios
            .get("/list")
            .then((res) => {
                this.data = res.data.data.data;
                this.count = Math.ceil(res.data.count / 30);
            })
            .catch((error) => {
                alert(
                    "エラーが発生しました。\n時間をおいてやり直してください。"
                );
            });
    },
    methods: {
        addbutton: function () {
            this.adddialog = true;
        },
        add: function () {
            let formData = new FormData();

            formData.append("date", this.date);
            formData.append("temperature", this.temperature);
            formData.append("rating", this.rating);

            axios
                .post("/create", formData)
                .then((res) => {
                    this.data = res.data.data.data;
                    this.count = Math.ceil(res.data.count / 30);
                    this.adddialog = false;
                    this.temperature = 0;
                    this.rating = 5;
                })
                .catch((error) => {
                    alert(
                        "エラーが発生しました。\n時間をおいてやり直してください。"
                    );
                });
        },
        confirm: function (id) {
            this.deletedialog = true;
            this.delete_id = id;
        },
        deletedata: function () {
            let formData = new FormData();

            formData.append("id", this.delete_id);

            axios
                .post("/delete", formData)
                .then((res) => {
                    this.data = res.data.data.data;
                    this.count = Math.ceil(res.data.count / 30);
                    this.deletedialog = false;
                    this.delete_id = 0;
                })
                .catch((error) => {
                    alert(
                        "エラーが発生しました。\n時間をおいてやり直してください。"
                    );
                });
        },
    },
    watch: {
        page: function (newVal) {
            axios
                .get("/list?page=" + newVal)
                .then((res) => {
                    this.data = res.data.data.data;
                    this.count = Math.ceil(res.data.count / 30);
                })
                .catch((error) => {
                    alert(
                        "エラーが発生しました。\n時間をおいてやり直してください。"
                    );
                });
        },
    },
};
</script>
