<template>
    <WebLayout>
        <div
            class="bg-complementary-pattern rounded-2xl px-12 py-20 text-center"
        >
            <div v-if="!password" class="mt-12 max-w-96 mx-auto">
                <h1 class="text-5xl text-white font-bold">Heslo pripravené</h1>

                <p class="text-white text-xl mt-6">
                    Link expiruje {{ expiration }}
                </p>
                <p class="text-white text-lg mt-4">
                    Heslo je po získaní odstránené z našej databázy.
                </p>

                <button
                    class="block mx-auto mt-16 text-2xl bg-color3c py-4 px-8 rounded-xl text-white font-semibold hover:bg-color1c duration-300 ease-in-out"
                    @click="collectPassword()"
                >
                    Získaj heslo
                </button>
            </div>
            <div v-else class="mt-12 max-w-96 mx-auto">
                <h1 class="text-5xl text-white font-bold">Heslo získané</h1>

                <p class="text-white text-lg mt-4">
                    Heslo je získané a odstránené z našej databázy.
                </p>

                <p class="bg-glass text-white mt-8 rounded text-2xl px-6 py-2">
                    {{ password }}
                </p>

                <button
                    class="block mx-auto mt-10 text-2xl bg-color3c py-4 px-8 rounded-xl text-white font-semibold hover:bg-color1c duration-300 ease-in-out"
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
    console.log();
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
