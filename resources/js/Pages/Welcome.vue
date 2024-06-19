<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome" />
    <div class="min-h-screen main bg-gradient-to-br from-slate-800 to-blue-500">
        <header>
            <nav
                v-if="canLogin"
                class="flex justify-end flex-1 p-4 text-xl font-bold text-white drop-shadow gap-x-5"
            >
                <Link v-if="$page.props.auth.user" :href="route('dashboard')">
                    Dashboard
                </Link>

                <template v-else>
                    <Link :href="route('login')"> Log in </Link>

                    <Link v-if="canRegister" :href="route('register')">
                        Register
                    </Link>
                    <Link v-if="canRegister" :href="route('dashboard')">
                        Dashboard
                    </Link>
                </template>
            </nav>
        </header>

        <main>
            <div class="flex">
                <h1
                    class="text-3xl w-fit font-extrabold duration-150 sm:p-28 sm:text-8xl md:text-[10rem] text-blue-400 drop-shadow-xl"
                >
                    Webshop <br />

                    <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-violet-500"
                        >VILT</span
                    >
                </h1>
            </div>
        </main>
    </div>
</template>
