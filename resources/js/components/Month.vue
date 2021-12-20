<template>
    <v-container>
        <v-menu
            ref="menu"
            v-model="menu"
            :close-on-content-click="false"
            :return-value.sync="date"
            transition="scale-transition"
            offset-y
            max-width="290px"
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

            <v-date-picker v-model="date" type="month" no-title scrollable>
                <v-spacer></v-spacer>
                <v-btn text color="primary" @click="menu = false">
                    Cancel
                </v-btn>
                <v-btn text color="primary" @click="$refs.menu.save(date)">
                    OK
                </v-btn>
            </v-date-picker>
        </v-menu>
        <v-btn block @click="display">閲覧する</v-btn>

        <h1>体温</h1>
        <canvas id="myChart"></canvas>
        <h1>体調</h1>
        <canvas id="condition"></canvas>
    </v-container>
</template>

<script>
let post = [];
let a;
let b;
import Chart from "chart.js";

export default {
    props: {
        auth: {
            required: true,
        },
    },
    data: () => ({
        date: new Date().toISOString().substr(0, 7),
        menu: false,
        data: [],
    }),

    methods: {
        display: function () {
            let formData = new FormData();

            formData.append("date", this.date);

            axios
                .post("/month", formData)
                .then((res) => {
                    this.data = res.data;
                    this.displayGraph(
                        time(this.data),
                        temperature(this.data),
                        rating(this.data)
                    );
                })
                .catch((error) => {
                    alert(
                        "エラーが発生しました。\n時間をおいてやり直してください。"
                    );
                });
        },
        displayGraph: function (timedata, temperaturedata, ratingdata) {
            var ctx = document.getElementById("myChart").getContext("2d");
            new Chart(ctx, {
                type: "line",
                data: {
                    labels: timedata,
                    datasets: [
                        {
                            label: "四半期の売上数の遷移",
                            data: temperaturedata,
                        },
                    ],
                },
            });

            var ctx2 = document.getElementById("condition").getContext("2d");
            new Chart(ctx2, {
                type: "line",
                data: {
                    labels: timedata,
                    datasets: [
                        {
                            label: "四半期の売上数の遷移",
                            data: ratingdata,
                        },
                    ],
                },
            });
        },
    },
};

function time(data) {
    post = [];
    for (let i = 0; i < data.length; i++) {
        post[i] = data[i]["time"];
    }
    return post;
}

function temperature(data) {
    post = [];
    for (let i = 0; i < data.length; i++) {
        post[i] = data[i]["temperature"];
    }

    return post;
}

function rating(data) {
    post = [];
    for (let i = 0; i < data.length; i++) {
        post[i] = data[i]["rating"];
    }

    return post;
}
</script>
