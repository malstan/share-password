<template>
    <WebLayout>
        <div
            class="bg-complementary-pattern rounded-2xl px-5 py-20 text-center border border-color4 xs:px-12"
        >
            <!-- collect password -->
            <div class="mx-auto">
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
                    <span
                        v-if="passphaseError"
                        class="block text-red-700 text-md mt-2"
                    >
                        Fráza na odomknutie hesla nie je správna.
                    </span>
                </div>

                <p class="text-color4 text-md mt-12 xs:text-xl">
                    Heslo je po získaní odstránené z našej databázy.
                </p>

                <Link
                    class="block mx-auto mt-12 text-xl bg-color3 py-4 px-8 rounded-xl text-gray-300 font-semibold hover:text-color4 hover:bg-color1 duration-300 ease-in-out xs:text-2xl disabled:hover:bg-color3 disabled:hover:text-gray-300 disabled:cursor-default"
                    as="button"
                    :disabled="isPassphase && passphase == ''"
                    method="post"
                    href="/heslo"
                    :data="{
                        hash: hash,
                        passphase: isPassphase ? passphase : undefined,
                    }"
                >
                    Získaj heslo
                </Link>
            </div>
        </div>
    </WebLayout>
</template>
<script setup>
import { ref } from "vue";
import WebLayout from "../Layouts/WebLayout.vue";
import moment from "moment-timezone";
import { Link } from "@inertiajs/vue3";

defineProps({
    expiration: String,
    openings: Number,
    isPassphase: Boolean,
    passphaseError: Boolean,
});

const passphase = ref("");

const url = window.location.href;
const hash = url.substring(url.lastIndexOf("/") + 1);

function copyPassword() {}
</script>
