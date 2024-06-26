<template>
    <WebLayout>
        <div
            class="bg-complementary-pattern rounded-2xl px-5 py-20 text-center border border-color4 xs:px-12"
        >
            <div class="mx-auto">
                <h1 class="text-4xl text-color4 font-bold xs:text-5xl">
                    Heslo sa už nedá získať
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
                <p class="text-color4 text-md mt-12 xs:text-xl">
                    Heslo bolo odstránené z našej databázy a nie je ho možné
                    získať.
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
import moment from "moment-timezone";
import { Link } from "@inertiajs/vue3";

const props = defineProps({ expiration: String, openings: Number });
</script>
