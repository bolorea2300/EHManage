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
                    label="年月を選択してください"
                    prepend-icon="mdi-calendar"
                    readonly
                    v-bind="attrs"
                    v-on="on"
                ></v-text-field>
            </template>

            <v-date-picker
                v-model="date"
                type="month"
                no-title
                scrollable
                locale="jp-ja"
                :day-format="(date) => new Date(date).getDate()"
            >
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

        <div>
            <canvas id="graph"></canvas>
        </div>
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
            var ctx = document.getElementById("graph").getContext("2d");
            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: timedata,

                    //Y軸の情報
                    datasets: [
                        {
                            //グラフの種類
                            type: "bar",
                            //凡例名
                            label: "体調",
                            //情報
                            data: ratingdata,
                            //背景色
                            backgroundColor: "rgba(54,162,235,0.2)",
                            //線色
                            borderColor: "rgb(54,162,235)",
                            //先の太さ
                            borderWidth: 1,
                        },
                        {
                            type: "line", //折れ線グラフ
                            label: "体温",
                            data: temperaturedata,
                            backgroundColor: "rgba(255, 99, 132,0.2)",
                            borderColor: "rgb(255, 99, 132)",
                            borderWidth: 1.2,
                            //ポイントの背景色
                            pointBackgroundColor: "rgba(255, 99, 132, 0.2)",
                            //ポイントの形(circle[○],rect[□],triangle[△]等がある)
                            pointStyle: "circle",
                            //ポイントの半径
                            radius: 4,
                            //ホバー時のポイント背景色
                            pointHoverBackgroundColor:
                                "rgba(255, 99, 132, 0.2)",
                            //ホバー時のポイントの半径
                            pointHoverRadius: 6,
                            //ホバー時のポイント背景色
                            pointHoverBorderColor: "rgb(255, 99, 132)",
                            //ホバー時の先の太さ
                            pointHoverBorderWidth: 2,
                            //ベジェ曲線の張力（0＝直線）
                            lineTension: 0,
                            //線下を塗りつぶすかどうか
                            fill: false,
                            //軸のID（複数軸存在する場合）
                            yAxisID: "y2",
                        },
                    ],
                },
                options: {
                    legend: {
                        //凡例
                        display: true,
                    },
                    tooltips: {
                        //ツールチップ
                        enabled: true,
                    },
                    scales: {
                        //Y軸のオプション
                        yAxes: [
                            {
                                scaleLabel: {
                                    fontColor: "black",
                                },
                                gridLines: {
                                    color: "rgba(126, 126, 126, 0.4)",
                                    zeroLineColor: "black",
                                },
                                ticks: {
                                    fontColor: "black",
                                    beginAtZero: true,
                                    suggestedMax: 5,
                                    stepSize: 1,
                                },
                            },
                            {
                                id: "y2",
                                position: "right",
                                autoSkip: true,
                                gridLines: {
                                    display: false,
                                },
                                ticks: {
                                    fontColor: "black",
                                    beginAtZero: true,
                                    max: 42,
                                    stepSize: 2,
                                },
                            },
                        ],
                        //X軸のオプション
                        xAxes: [
                            {
                                scaleLabel: {
                                    fontColor: "black",
                                    display: true,
                                    labelString: "日付",
                                },
                                gridLines: {
                                    color: "rgba(126, 126, 126, 0.4)",
                                    zeroLineColor: "black",
                                },
                                ticks: {
                                    fontColor: "black",
                                },
                            },
                        ],
                    },
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
