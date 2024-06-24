<template>
    <WebLayout>
        <div
            class="bg-complementary-pattern rounded-2xl px-5 py-20 text-center border border-color4 xs:px-12"
        >
            <!-- collect password -->
            <div v-if="!password" class="mx-auto">
                <h1 class="text-4xl text-color4 font-bold xs:text-5xl">
                    Heslo pripravené
                </h1>

                <p class="text-color4 text-lg mt-6 xs:text-xl">
                    Link expiruje
                    <strong>
                        {{
                            moment
                                .tz(expiration, "YYYY-MM-DD HH:mm:ss", "UTC")
                                .tz(moment.tz.guess())
                                .format("HH:mm:ss DD.MM.YYYY")
                        }}
                    </strong>
                    .
                </p>
                <p class="text-color4 text-lg mt-6 xs:text-xl">
                    Počet získaní hesla <strong>{{ openings }}</strong
                    >.
                </p>
                <p class="text-color4 text-md mt-4 xs:text-xl">
                    Heslo je po získaní odstránené z našej databázy.
                </p>

                <button
                    class="block mx-auto mt-16 text-xl bg-color3 py-4 px-8 rounded-xl text-gray-300 font-semibold hover:text-color4 hover:bg-color1 duration-300 ease-in-out xs:text-2xl"
                    @click="collectPassword()"
                >
                    Získaj heslo
                </button>
            </div>

            <!-- password -->
            <div v-else class="max-w-96 mx-auto">
                <h1 class="text-4xl text-color4 font-bold xs:text-5xl">
                    Heslo získané
                </h1>

                <p class="text-color4 text-md mt-4 xs:text-lg">
                    Heslo je získané a odstránené z našej databázy.
                </p>

                <p class="bg-glass text-color4 mt-8 rounded text-2xl px-6 py-2">
                    {{ password }}
                </p>

                <button
                    class="block mx-auto mt-10 text-xl bg-color3 py-4 px-8 rounded-xl text-gray-300 font-semibold hover:text-color4 hover:bg-color1 duration-300 ease-in-out xs:text-2xl"
                    @click="copyPassword()"
                >
                    Kopírovať
                </button>
            </div>
        </div>
    </WebLayout>
</template>
<script setup>
import { ref } from "vue";
import WebLayout from "../Layouts/WebLayout.vue";
import moment from "moment-timezone";

const props = defineProps({ expiration: String, openings: Number });

const password = ref("");

async function collectPassword() {
    const url = window.location.href;
    await axios
        .post("/api/password/collect", {
            hash: url.substring(url.lastIndexOf("/") + 1),
        })
        .then((response) => {
            if (response.status == 200) password.value = response.data.password;
        })
        .catch((error) => {
            console.error(error);
        });
}

function copyPassword() {}
</script>
