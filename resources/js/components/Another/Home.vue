<template>
    <v-app>
        <div class="main">
            <h1 class="title">
                <span>E</span>
                <span>a</span>
                <span>s</span>
                <span>y</span>
                <span class="space"> </span>
                <span>H</span>
                <span>e</span>
                <span>a</span>
                <span>l</span>
                <span>t</span>
                <span>h</span>
                <span class="space"> </span>
                <span>M</span>
                <span>a</span>
                <span>n</span>
                <span>a</span>
                <span>g</span>
                <span>e</span>
                <span>m</span>
                <span>e</span>
                <span>n</span>
                <span>t</span>
            </h1>

            <div class="frame">
                <img class="img" src="/image/thermometer-1588741_1280.jpg" />
                <h1 class="maintitle">EHmanage</h1>
            </div>
        </div>

        <div class="menubutton">
            <v-row v-if="auth === false">
                <v-col
                    ><v-btn
                        depressed
                        color="primary"
                        block
                        @click="login = true"
                        >ログイン</v-btn
                    ></v-col
                >
                <v-col>
                    <v-btn
                        depressed
                        color="primary"
                        block
                        @click="register = true"
                        >会員登録</v-btn
                    ></v-col
                >
            </v-row>
            <v-btn
                v-if="auth === true"
                depressed
                color="primary"
                block
                href="/home"
                >ホームに戻る</v-btn
            >
        </div>

        <div class="menu">
            <h1 class="center">EHmanageとは?</h1>
            <div class="imgcenter">
                <v-img
                    class="img"
                    max-width="900"
                    max-height="400"
                    contain
                    src="/image/3.png"
                ></v-img>
            </div>
            <p class="center">
                EHmanageは、シンプルな体調記録を実現するサイトです。日々の体温、体調を記録できます。
            </p>
        </div>

        <div class="menu">
            <h1 class="center">カレンダーを搭載</h1>
            <div class="imgcenter">
                <v-img
                    class="img"
                    max-width="900"
                    max-height="400"
                    contain
                    src="/image/2.png"
                ></v-img>
            </div>
            <p class="center">予定を記録するカレンダーを搭載しています。</p>
        </div>

        <div class="menu">
            <h1 class="center">グラフで推移を確認</h1>
            <div class="imgcenter">
                <v-img
                    class="img"
                    max-width="900"
                    max-height="400"
                    contain
                    src="/image/4.png"
                ></v-img>
            </div>
            <p class="center">グラフで体調の推移を確認できます。</p>
        </div>

        <div class="footer">
            <p class="myname">©2022 EHmanage</p>
        </div>

        <v-dialog v-model="login" width="500">
            <v-card>
                <v-card-title>ログイン</v-card-title>
                <v-card-text>
                    <form action="/login" method="POST">
                        <input type="hidden" name="_token" :value="csrf" />
                        <v-text-field
                            name="email"
                            label="メールアドレス"
                            required
                        ></v-text-field>
                        <v-text-field
                            type="password"
                            name="password"
                            label="パスワード"
                            required
                        ></v-text-field>
                        <v-btn type="submit" block v-bind="attrs" v-on="on">
                            ログイン
                        </v-btn>
                    </form>
                </v-card-text>
            </v-card>
        </v-dialog>

        <v-dialog v-model="register" width="500">
            <v-card>
                <v-card-title>登録</v-card-title>
                <v-card-text>
                    <form action="/register" method="POST">
                        <input type="hidden" name="_token" :value="csrf" />
                        <v-text-field
                            name="name"
                            label="ニックネーム"
                            required
                        ></v-text-field>
                        <v-text-field
                            name="email"
                            label="メールアドレス"
                            required
                        ></v-text-field>
                        <v-text-field
                            type="password"
                            name="password"
                            label="パスワード"
                            required
                        ></v-text-field>
                        <v-text-field
                            type="password"
                            name="password_confirmation"
                            label="パスワードの再確認"
                            required
                        ></v-text-field>
                        <v-btn type="submit" block v-bind="attrs" v-on="on">
                            ログイン
                        </v-btn>
                    </form>
                </v-card-text>
            </v-card>
        </v-dialog>
    </v-app>
</template>

<script>
export default {
    props: {
        auth: {
            required: true,
        },
    },
    data: () => ({
        csrf: document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
        login: false,
        register: false,
    }),
};
</script>

<style lang="scss">
html {
    margin: 0;
    height: 100%;
}

body {
    margin: 0px;
    height: 100%;
}

* {
    margin: 0;
    padding: 0;
}

#app {
    height: 100%;
    width: 100%;
}

.main {
    height: 100%;
    width: 100%;
    background-color: black;
    position: relative;
    margin-bottom: 120px;

    .title {
        color: white;
        background-color: black;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        animation-name: fades;
        animation-fill-mode: backwards; /*2で解説*/
        animation-duration: 5s;
        animation-iteration-count: 1; /*4で解説*/
        animation-timing-function: ease; /*5で解説*/
        animation-delay: 0.5s; /*6で解説*/
        animation-fill-mode: forwards;
        animation-direction: normal; /*7で解説*/

        span {
            animation-fill-mode: backwards; /*2で解説*/
            animation-duration: 5s;
            animation-iteration-count: 1; /*4で解説*/
            animation-timing-function: ease; /*5で解説*/
            animation-delay: 0.5s; /*6で解説*/
            animation-fill-mode: forwards;
            animation-direction: normal; /*7で解説*/
        }
        span:nth-child(2),
        span:nth-child(3),
        span:nth-child(4),
        span:nth-child(5),
        span:nth-child(7),
        span:nth-child(8),
        span:nth-child(9),
        span:nth-child(10),
        span:nth-child(11),
        span:nth-child(12),
        span:nth-child(19),
        span:nth-child(20),
        span:nth-child(21),
        span:nth-child(22) {
            animation-name: two;
        }
    }
}

.frame {
    position: relative;
    opacity: 0;
    animation-name: one;
    animation-fill-mode: backwards; /*2で解説*/
    animation-duration: 5s;
    animation-iteration-count: 1; /*4で解説*/
    animation-timing-function: ease; /*5で解説*/
    animation-delay: 0.5s; /*6で解説*/
    animation-fill-mode: forwards;
    animation-direction: normal; /*7で解説*/
    background-color: white;
    height: 100%;
    width: 100%;

    .img {
        width: 100%;
        height: 100%;
        background-position: center;
        object-fit: cover;
    }
    .maintitle {
        position: absolute;
        top: 10px;
        left: 10px;
        font-size: 64px;
        color: white;
    }
}

.menu {
    padding: 30px 10px;
    border-radius: 10px;
    box-shadow: 0px 0px 8px gray;
    @media screen and (min-width: 1201px) {
        width: 90%;
        margin: 0 auto 50px auto;
    }
    @media screen and (max-width: 1200px) {
        width: 98%;
        margin: 0 auto 50px auto;
    }
}

@keyframes one {
    0%,
    60% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

@keyframes two {
    0% {
        opacity: 1;
    }

    25%,
    100% {
        opacity: 0;
    }
}

@keyframes fades {
    0%,
    60% {
        opacity: 1;
    }
    100% {
        opacity: 0;
    }
}

.space {
    padding: 10px;
}

.center {
    text-align: center;
}

.m-0 {
    margin: 0;
}

.imgcenter {
    text-align: center;

    .img {
        margin: 0 auto;
    }
}

.footer {
    margin-top: 20px;
    padding: 20px 0;
    background-color: black;

    .myname {
        color: white;
        text-align: center;
    }
}

.relative {
    position: relative;
    width: 100%;
    height: 100%;
}
.allcenter {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.m900 {
    max-width: 900px;
    margin: 0 auto;
}

.menubutton {
    padding: 10px;
    margin: 20px 0;
}
</style>
