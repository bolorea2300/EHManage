<template>
    <v-app>
        <v-container>
            <h1 class="pagetitle">使い方</h1>

            <div class="menu">
                <h1 class="center">スケジュール管理</h1>
                <div class="imgcenter">
                    <v-img
                        class="img"
                        max-width="900"
                        max-height="400"
                        contain
                        src="/image/5.png"
                    ></v-img>
                </div>
                <p class="center">
                    まずは、画面上の「予定を追加する」をクリックしてください。
                </p>
                <div class="imgcenter">
                    <v-img
                        class="img"
                        max-width="900"
                        max-height="400"
                        contain
                        src="/image/6.png"
                    ></v-img>
                </div>
                <p class="center">予定と時間を入力してください。</p>

                <div class="imgcenter">
                    <v-img
                        class="img"
                        max-width="900"
                        max-height="400"
                        contain
                        src="/image/7.png"
                    ></v-img>
                </div>
                <p class="center">
                    カレンダーの予定をクリックすると、その予定を確認・削除できます。
                </p>
            </div>

            <div class="menu">
                <h1 class="center">体調管理</h1>
                <div class="imgcenter">
                    <v-img
                        class="img"
                        max-width="900"
                        max-height="400"
                        contain
                        src="/image/8.png"
                    ></v-img>
                </div>
                <p class="center">
                    まずは、画面上の「追加」をクリックしてください。
                </p>
                <div class="imgcenter">
                    <v-img
                        class="img"
                        max-width="900"
                        max-height="400"
                        contain
                        src="/image/6.png"
                    ></v-img>
                </div>
                <p class="center">日付と体調と体温を入力してください。</p>
            </div>
        </v-container>
    </v-app>
</template>

<script>
export default {
    props: {
        auth: {
            required: true,
        },
    },
    data: () => ({}),
};
</script>

<style lang="scss">
.pagetitle {
    text-align: center;
    font-size: 64px !important;
    margin-bottom: 10px;
}
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
    margin-bottom: 20px;
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
