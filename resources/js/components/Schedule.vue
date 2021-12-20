<template>
    <v-container>
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
                <v-btn text color="primary" @click="$refs.menu.save(date)">
                    OK
                </v-btn>
            </v-date-picker>
        </v-menu>
        <v-row justify="space-around" align="center">
            <v-col style="width: 350px; flex: 0 1 auto">
                <h2>Start:</h2>
                <v-time-picker v-model="start" :max="end"></v-time-picker>
            </v-col>
            <v-col style="width: 350px; flex: 0 1 auto">
                <h2>End:</h2>
                <v-time-picker v-model="end" :min="start"></v-time-picker>
            </v-col>
        </v-row>
        <v-text-field v-model="text" label="内容" required></v-text-field>
        <v-btn block @click="add">投稿する</v-btn>
        <v-sheet
            tile
            height="6vh"
            color="grey lighten-3"
            class="d-flex align-center"
        >
            <v-btn icon @click="$refs.calendar.prev()">
                <v-icon>mdi-chevron-left</v-icon>
            </v-btn>
            <v-btn icon @click="$refs.calendar.next()">
                <v-icon>mdi-chevron-right</v-icon>
            </v-btn>
        </v-sheet>
        <v-sheet height="94vh">
            <v-calendar
                ref="calendar"
                locale="ja-jp"
                :events="events"
                @click:event="showEvent"
            ></v-calendar>
        </v-sheet>
        <p></p>
        <v-dialog v-model="dialog" width="500">
            <v-card>
                <v-card-title v-text="selectedEvent.name"></v-card-title>
                <v-card-text>
                    <p>開始時刻:{{ selectedEvent.start }}</p>
                    <p>終了時刻:{{ selectedEvent.end }}</p>
                </v-card-text>
                <v-btn block @click="thisdelete(selectedEvent.id)">
                    削除する
                </v-btn>
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
        date: new Date().toISOString().substr(0, 7),
        start: null,
        end: null,
        text: "",
        menu: false,
        menu2: false,
        events: [],
        selectedEvent: {},
        dialog: false,
    }),
    created() {
        this.get();
    },
    methods: {
        add: function () {
            let formData = new FormData();

            formData.append("date", this.date);
            formData.append("start", this.start);
            formData.append("end", this.end);
            formData.append("text", this.text);

            axios
                .post("/schedule/create", formData)
                .then((res) => {
                    this.get();
                })
                .catch((error) => {
                    alert(
                        "エラーが発生しました。\n時間をおいてやり直してください。"
                    );
                });
        },
        thisdelete: function (id) {
            let formData = new FormData();

            formData.append("id", id);

            axios
                .post("/schedule/delete", formData)
                .then((res) => {
                    this.dialog = false;
                    this.get();
                })
                .catch((error) => {
                    alert(
                        "エラーが発生しました。\n時間をおいてやり直してください。"
                    );
                });
        },
        get: function () {
            axios
                .get("/schedule/get")
                .then((res) => {
                    this.events = res.data;
                })
                .catch((error) => {
                    alert(
                        "エラーが発生しました。\n時間をおいてやり直してください。"
                    );
                });
        },
        showEvent: function (a, b) {
            this.dialog = true;
            this.selectedEvent = a.event;
        },
    },
    watch: {},
};
</script>
