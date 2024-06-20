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

            <!-- password input -->
            <div v-if="!link">
                <div
                    class="mt-14 max-w-96 mx-auto flex flex-col items-end xs:mt-20"
                >
                    <button
                        class="mb-2 cursor-pointer"
                        @click="settingsOpen = true"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            class="stroke-color4 size-6 hover:stroke-color3 duration-300 ease-in-out"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                            />
                        </svg>
                    </button>

                    <div class="relative w-full">
                        <input
                            class="bg-glass w-full text-color4 placeholder-color4 border border-color4 rounded text-lg pl-6 pr-10 py-2 outline-none focus:border-color3 duration-500 ease-in-out xs:text-xl"
                            autocomplete="off"
                            v-model="password"
                            placeholder="heslo"
                            :type="showPassword ? 'text' : 'password'"
                        />
                        <span
                            class="cursor-pointer absolute right-3 top-3"
                            @click="showPassword = !showPassword"
                        >
                            <svg
                                v-if="!showPassword"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                class="size-6 stroke-color4 hover:stroke-color3"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                />
                            </svg>
                            <svg
                                v-else
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                class="size-6 stroke-color4 hover:stroke-color3"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"
                                />
                            </svg>
                        </span>
                    </div>
                    <button
                        class="block mt-2 mr-1 text-color4 hover:text-color3 duration-300 ease-in-out"
                        @click="generateStrongPassword()"
                    >
                        Vygenerovať silné heslo
                    </button>
                </div>

                <button
                    class="block cursor-pointer mx-auto mt-16 text-xl bg-color3 py-4 px-8 rounded-xl text-gray-300 font-semibold hover:bg-color1 hover:text-color4 duration-300 ease-in-out xs:text-2xl"
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
                        class="w-full text-color4 text-2xl rounded bg-glass px-6 py-2"
                    >
                        {{ link }}
                    </p>
                    <button
                        class="block mt-2 mr-1 text-color4 hover:text-color3 duration-300 ease-in-out"
                        @click="reset()"
                    >
                        Ešte raz
                    </button>
                </div>

                <button
                    class="block mx-auto mt-16 text-xl bg-color3 py-4 px-8 rounded-xl text-gray-300 font-semibold hover:bg-color1 hover:text-color4 duration-300 ease-in-out xs:text-2xl"
                    @click="copyPassword()"
                >
                    Kopírovať
                </button>
            </div>

            <!-- popup settings -->
            <div
                v-if="settingsOpen"
                class="bg-glass w-5/6 max-w-xl max-h-96 absolute inset-0 m-auto backdrop-blur-lg rounded-2xl border border-color4 py-12 px-4"
            >
                <button
                    @click="settingsOpen = !settingsOpen"
                    class="absolute top-4 right-4"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        class="stroke-color4 size-8 hover:stroke-color3 duration-300 ease-in-out"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                        />
                    </svg>
                </button>

                <p class="text-color4 text-lg mb-3">
                    Link expiruje o
                    {{ timeLabels[parseInt(expiration)] }}.
                </p>
                <input
                    type="range"
                    min="0"
                    max="13"
                    class="w-full max-w-sm accent-color3 duration-500 ease-in-out"
                    v-model="expiration"
                />

                <p class="text-color4 text-lg mt-5 mb-3">
                    Počet otvorení:
                    {{ openings }}
                </p>
                <input
                    type="range"
                    min="1"
                    max="5"
                    class="w-full max-w-sm accent-color3 duration-500 ease-in-out"
                    v-model="openings"
                />

                <p class="text-color4 text-lg mt-5 mb-3">
                    Fráza na odomknutie hesla:
                </p>
                <input
                    type="text"
                    placeholder="Nepovinné"
                    v-model="passphase"
                    class="bg-glass w-full max-w-xs text-color4 placeholder-color4 border border-color4 rounded text-md px-5 py-2 outline-none focus:border-color3 duration-500 ease-in-out"
                />
            </div>
        </div>
    </WebLayout>
</template>
<script setup>
import WebLayout from "../Layouts/WebLayout.vue";
import { ref } from "vue";

const password = ref("");
const expiration = ref("4");
const openings = ref("1");
const passphase = ref("");

const link = ref("");

const settingsOpen = ref(false);
const showPassword = ref(false);
const timeLabels = [
    "30 minút",
    "1 hodina",
    "3 hodiny",
    "8 hodín",
    "1 deň",
    "2 dni",
    "3 dni",
    "4 dni",
    "5 dní",
    "6 dní",
    "7 dní",
    "8 dní",
    "9 dní",
    "10 dní",
];

/**
 * Function send request with settings and password.
 * It gets link to collect password.
 */
async function generatePasswordLink() {
    const data = {
        password: password.value,
        expiration: expiration.value,
        openings: openings.value,
        passphase: passphase.value || undefined,
    };

    await axios
        .post("/password", data)
        .then((response) => {
            console.log(response);
            link.value = "sdfdf";
        })
        .catch((error) => {
            console.log(error);
        });
}

/**
 * Function generates strong password.
 * length 14, numbers, symbols, upper case, lower case
 */
function generateStrongPassword() {
    password.value = "fsdgdrg1gd45f5df";
}

/**
 * Function saves password to clipboard.
 */
function copyPassword() {
    console.log("copy password");
}

/**
 * Function clears all variable to default values.
 */
function reset() {
    password.value = "";
    expiration.value = "4";
    openings.value = "1";
    passphase.value = "";

    link.value = "";

    settingsOpen.value = false;
}
</script>
