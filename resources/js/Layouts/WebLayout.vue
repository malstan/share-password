<template>
    <main>
        <header class="container mx-auto px-6 py-8 flex justify-between gap-4">
            <div></div>
            <div class="flex gap-6 *:text-lg">
                <Link href="/">Domov</Link>
                <Link href="/o-zdielani-hesiel">O zdieľaní hesiel</Link>
            </div>
        </header>
        <section class="container mx-auto px-3">
            <slot></slot>
        </section>
    </main>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
</script>
