<template>
    <WebLayout>
        <div
            class="bg-complementary-pattern rounded-2xl px-5 py-20 text-center border border-color4 xs:px-12"
        >
            <div class="max-w-96 mx-auto">
                <h1 class="text-4xl text-color4 font-bold xs:text-5xl">
                    Heslo získané
                </h1>

                <p class="text-color4 text-md mt-16 xs:text-lg">
                    Heslo je získané a odstránené z našej databázy.
                </p>

                <p
                    class="bg-glass text-color4 mt-8 rounded text-2xl px-6 py-2"
                    :class="coppied"
                >
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

const props = defineProps({ password: String });
const coppied = ref("");

function copyPassword() {
    navigator.clipboard.writeText(props.password);

    coppied.value = "animate-ping";
    setTimeout(() => {
        coppied.value = "";
    }, 750);
}
</script>
