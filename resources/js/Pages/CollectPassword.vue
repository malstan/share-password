<template>
    <WebLayout>
        <div
            class="bg-complementary-pattern rounded-2xl px-5 py-20 text-center border border-color4 xs:px-12"
        >
            <!-- collect password -->
            <div v-if="!password" class="max-w-96 mx-auto">
                <h1 class="text-4xl text-color4 font-bold xs:text-5xl">
                    Heslo pripravené
                </h1>

                <p class="text-color4 text-lg mt-6 xs:text-xl">
                    Link expiruje {{ expiration }}
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
import WebLayout from "../Layouts/WebLayout.vue";
import { ref } from "vue";

const props = defineProps({ expiration: String, id: String });

const password = ref("");

async function collectPassword() {
    await axios
        .get(`/heslo/zis/${props.id}`)
        .then((response) => {
            if (response.status == 200) password.value = response.data.password;
        })
        .catch((error) => {
            console.error(error);
        });
}

function copyPassword() {}
</script>
