<template>
    <v-container>
        <div class="mb-10">
            <v-btn block @click="addmodal = true">予定を追加する</v-btn>
        </div>
        <v-dialog v-model="addmodal" max-width="600px">
            <v-card>
                <v-container>
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
                                label="日付"
                                prepend-icon="mdi-calendar"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                            ></v-text-field>
                        </template>
                        <v-date-picker
                            v-model="date"
                            no-title
                            scrollable
                            locale="jp-ja"
                            :day-format="(date) => new Date(date).getDate()"
                        >
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
                        <div>
                            <v-row class="m700">
                                <v-col>
                                    <v-text-field type="number" v-model="start.minutes" min="0" max="24"></v-text-field>
                                </v-col>
                                <v-col cols="1">
                                    <div class="relative">
                                        <p class="allcenter m-0">:</p>
                                    </div>
                                </v-col>
                    <v-col>
                        <v-text-field
                        v-model="start.second"
                        type="number"
                       min="0" max="59">
                      </v-text-field>
                    </v-col>
                    <v-col cols="1">
                        <div class="relative">
                            <p class="allcenter m-0">～</p>
                        </div>
                    </v-col>
                    <v-col>
                        <v-text-field
                          type="number"
                          v-model="end.minutes"
                         min="0" max="24">
                        </v-text-field>
                      </v-col>
                      <v-col cols="1">
                        <div class="relative">
                            <p class="allcenter m-0">:</p>
                        </div>
                      </v-col>
                      <v-col>
                          <v-text-field
                          type="number"
                          v-model="end.second"
                         min="0" max="59">
                        </v-text-field>
                      </v-col>
                  </v-row>
            </div>
        </div>
                        <v-text-field
                            v-model="text"
                            label="内容"
                            required
                        ></v-text-field>
                        <v-btn block @click="add" v-bind:disabled="check"
                            >投稿する</v-btn
                        >
                    </v-card-text>
                </v-container>
            </v-card>
        </v-dialog>

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
                v-model="value"
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
const date = new Date();
var year = date.getFullYear();
var month = date.getMonth() + 1;
var day = date.getDate();

export default {
    props: {
        auth: {
            required: true,
        },
    },
    data: () => ({
        addmodal: "",
        value: "",
        date: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
            .toISOString()
            .substr(0, 10),
        start:
        {
            minutes:0,
            second:0
        },
        end:
        {
            minutes:0,
            second:0
        },
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
            formData.append("start", ( '00'+this.start.minutes).slice( -2 )+":"+( '00' + this.start.second ).slice( -2 ));
            formData.append("end",('00'+this.end.minutes).slice( -2 )+":"+( '00' + this.end.second ).slice( -2 ));
            formData.append("text", this.text);

            console.log(this.start.minutes+":"+( '00' + this.start.second ).slice( -2 ));
            console.log(this.end.minutes+":"+( '00' + this.end.second ).slice( -2 ));


            axios
                .post("/schedule/create", formData)
                .then((res) => {
                    this.get();
                    this.start.minutes = 0;
                    this.start.second = 0;
                    this.end.minutes = 0;
                    this.end.second = 0;
                    this.text = "";
                    this.addmodal = false;
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
    computed: {
        check: function () {
            if (this.date && this.start && this.end && this.text) {
                return false;
            } else {
                return true;
            }
        },
    },
};
</script>

<style lang="scss">
.relative
{
  position: relative;
  width:100%;
  height: 100%;
}
.allcenter
{
  position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>