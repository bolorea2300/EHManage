<template>
    <v-container>
        <v-select
            v-model="date"
            :items="items"
            label="年を選択してください"
        ></v-select>

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
const now = new Date();
import Chart from "chart.js";

export default {
    props: {
        auth: {
            required: true,
        },
    },
    data: () => ({
        date: now.getFullYear(),
        menu: false,
        data: [],
    }),

    methods: {
        display: function () {
            let formData = new FormData();

            formData.append("date", this.date);

            axios
                .post("/year", formData)
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
    computed: {
        items: function () {
            return [
                this.date - 5,
                this.date - 4,
                this.date - 3,
                this.date - 2,
                this.date - 1,
                this.date,
                this.date + 1,
                this.date + 2,
                this.date + 3,
                this.date + 4,
                this.date + 5,
            ];
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
