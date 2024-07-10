<template>
    <WebLayout>
        <div
            class="bg-dafault-pattern rounded-2xl px-5 py-20 text-center relative border border-color4"
        >
            <h1 class="text-4xl text-color4 font-bold xs:text-5xl">
                Zdieľaj heslo
            </h1>
            <h2 class="text-2xl text-color4 font-bold mt-8 xs:text-4xl">
                rýchlo, jednoducho, bezpečne
            </h2>

            <!-- password share -->
            <div>
                <div
                    class="mt-24 max-w-[30rem] mx-auto flex flex-col items-end"
                >
                    <p
                        class="w-full text-color4 text-2xl rounded bg-glass px-6 py-2"
                        :class="coppied"
                    >
                        {{ link }}
                    </p>
                    <Link
                        class="block mt-2 mr-1 text-color4 hover:text-color3 duration-300 ease-in-out underline"
                        href="/"
                    >
                        Ešte raz
                    </Link>
                </div>

                <button
                    class="block mx-auto mt-16 text-xl bg-color3 py-4 px-8 rounded-xl text-gray-300 font-semibold hover:bg-color1 hover:text-color4 duration-300 ease-in-out xs:text-2xl"
                    @click="copyLink()"
                >
                    Kopírovať
                </button>
            </div>
        </div>
    </WebLayout>
</template>
<script setup>
import WebLayout from "../Layouts/WebLayout.vue";
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({ link: String });
const coppied = ref("");

/**
 * Function saves link to clipboard.
 */
function copyLink() {
    navigator.clipboard.writeText(props.link);

    coppied.value = "animate-ping";
    setTimeout(() => {
        coppied.value = "";
    }, 750);
}
</script>
