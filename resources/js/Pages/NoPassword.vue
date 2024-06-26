<template>
    <WebLayout>
        <div
            class="bg-complementary-pattern rounded-2xl px-5 py-20 text-center border border-color4 xs:px-12"
        >
            <div class="mx-auto">
                <h1 class="text-4xl text-color4 font-bold xs:text-5xl">
                    Heslo sa nenašlo
                </h1>

                <p class="text-color4 text-lg mt-16 xs:text-xl">
                    Záznam hesla bol vymazaný alebo máte nesprávny link.
                </p>

                <Link
                    class="block mt-6 mr-1 text-lg text-color4 hover:text-color3 duration-300 ease-in-out underline"
                    href="/"
                >
                    Zdieľať heslo
                </Link>
            </div>
        </div>
    </WebLayout>
</template>
<script setup>
import WebLayout from "../Layouts/WebLayout.vue";
import { Link } from "@inertiajs/vue3";
</script>
