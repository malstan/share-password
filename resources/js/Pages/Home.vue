<template>
    <WebLayout>
        <div class="bg-dafault-pattern rounded-2xl px-12 py-20 text-center">
            <h1 class="text-5xl text-white font-bold">Zdieľaj heslo</h1>
            <h2 class="text-4xl text-white font-bold mt-8">
                rýchlo, jednoducho, bezpečne
            </h2>

            <!-- password input -->
            <div v-if="!link">
                <div class="mt-24 max-w-96 mx-auto flex flex-col items-end">
                    <input
                        class="bg-glass w-full text-white placeholder-white border rounded text-2xl px-6 py-2 outline-none focus:border-color3 duration-500 ease-in-out"
                        autocomplete="off"
                        v-model="password"
                        placeholder="heslo"
                        type="password"
                    />
                    <button
                        class="block mt-2 mr-1 text-white hover:text-color3 duration-300 ease-in-out"
                        @click="generateStrongPassword()"
                    >
                        Vygenerovať silné heslo
                    </button>
                </div>

                <button
                    class="block mx-auto mt-16 text-2xl bg-color3 py-4 px-8 rounded-xl text-white font-semibold hover:bg-color1 duration-300 ease-in-out"
                    @click="generatePasswordLink()"
                >
                    Zdieľať
                </button>
            </div>

            <!-- password share -->
            <div v-else>
                <div
                    class="mt-24 max-w-[30rem] mx-auto flex flex-col items-end"
                >
                    <p
                        class="w-full text-white text-2xl rounded bg-glass px-6 py-2"
                    >
                        {{ link }}
                    </p>
                    <button
                        class="block mt-2 mr-1 text-white hover:text-color3 duration-300 ease-in-out"
                        @click="reset()"
                    >
                        Ešte raz
                    </button>
                </div>

                <button
                    class="block mx-auto mt-16 text-2xl bg-color3 py-4 px-8 rounded-xl text-white font-semibold hover:bg-color1 duration-300 ease-in-out"
                    @click="copyPassword()"
                >
                    Kopírovať
                </button>
            </div>
        </div>
    </WebLayout>
</template>
<script setup>
import WebLayout from "../Layouts/WebLayout.vue";
import { ref } from "vue";

const password = ref("");
const link = ref("");

function generatePasswordLink() {
    link.value = "https://dajheslo.app/c/NKAKiR";
}

function generateStrongPassword() {
    password.value = "fsdgdrg1gd45f5df";
}

function copyPassword() {
    console.log("copy password");
}

function reset() {
    password.value = "";
    link.value = "";
}
</script>
