<template>
    <WebLayout>
        <div
            class="bg-complementary-pattern rounded-2xl px-12 py-20 text-center border border-gray-600"
        >
            <!-- collect password -->
            <div v-if="!password" class="mt-12 max-w-96 mx-auto">
                <h1 class="text-5xl text-gray-600 font-bold">
                    Heslo pripravené
                </h1>

                <p class="text-gray-600 text-xl mt-6">
                    Link expiruje {{ expiration }}
                </p>
                <p class="text-gray-600 text-lg mt-4">
                    Heslo je po získaní odstránené z našej databázy.
                </p>

                <button
                    class="block mx-auto mt-16 text-2xl bg-color1 py-4 px-8 rounded-xl text-gray-600 font-semibold hover:text-gray-300 hover:bg-color3 duration-300 ease-in-out"
                    @click="collectPassword()"
                >
                    Získaj heslo
                </button>
            </div>

            <!-- password -->
            <div v-else class="mt-12 max-w-96 mx-auto">
                <h1 class="text-5xl text-gray-600 font-bold">Heslo získané</h1>

                <p class="text-gray-600 text-lg mt-4">
                    Heslo je získané a odstránené z našej databázy.
                </p>

                <p
                    class="bg-glass text-gray-600 mt-8 rounded text-2xl px-6 py-2"
                >
                    {{ password }}
                </p>

                <button
                    class="block mx-auto mt-10 text-2xl bg-color1 py-4 px-8 rounded-xl text-gray-600 font-semibold hover:text-gray-300 hover:bg-color3 duration-300 ease-in-out"
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
