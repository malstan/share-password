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

                <p class="text-color4 text-lg mt-16 xs:text-xl">
                    Expirácia:
                    <strong>
                        {{
                            moment
                                .tz(expiration, "YYYY-MM-DD HH:mm:ss", "UTC")
                                .tz(moment.tz.guess())
                                .format("HH:mm:ss DD.MM.YYYY")
                        }}
                    </strong>
                </p>
                <p class="text-color4 text-lg mt-3 xs:text-xl">
                    Zostávajúci počet získaní: <strong>{{ openings }}</strong>
                </p>
                <div v-if="isPassphase">
                    <p class="text-color4 text-lg mt-6 xs:text-xl">
                        Získanie hesla si vyžaduje zadať frázu.
                    </p>
                    <input
                        type="text"
                        placeholder="Fráza"
                        v-model="passphase"
                        class="bg-glass w-full max-w-xs text-color4 placeholder-color4 border border-color4 rounded text-md px-5 py-2 mt-3 outline-none focus:border-color3 duration-500 ease-in-out"
                    />
                </div>

                <p class="text-color4 text-md mt-12 xs:text-xl">
                    Heslo je po získaní odstránené z našej databázy.
                </p>

                <button
                    class="block mx-auto mt-12 text-xl bg-color3 py-4 px-8 rounded-xl text-gray-300 font-semibold hover:text-color4 hover:bg-color1 duration-300 ease-in-out xs:text-2xl disabled:hover:bg-color3 disabled:hover:text-gray-300 disabled:cursor-default"
                    @click="collectPassword()"
                    :disabled="isPassphase && passphase == ''"
                >
                    Získaj heslo
                </button>
            </div>

            <!-- password -->
            <div v-else class="max-w-96 mx-auto">
                <h1 class="text-4xl text-color4 font-bold xs:text-5xl">
                    Heslo získané
                </h1>

                <p class="text-color4 text-md mt-16 xs:text-lg">
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

const props = defineProps({
    expiration: String,
    openings: Number,
    isPassphase: Boolean,
});

const passphase = ref("");
const password = ref("");

async function collectPassword() {
    const url = window.location.href;
    await axios
        .post("/api/password/collect", {
            hash: url.substring(url.lastIndexOf("/") + 1),
            passphase: props.isPassphase ? passphase.value : undefined,
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
