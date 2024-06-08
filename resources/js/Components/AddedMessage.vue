<script setup>
defineProps({
    on: Boolean,
});
</script>

<template>
    <div>
        <transition
            leave-active-class="transition duration-1000 ease-in"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div
                v-show="on"
                class="fixed p-1 px-4 text-sm text-white -translate-x-1/2 bg-green-700 border rounded shadow top-6 min-w-12 left-1/2"
            >
                <slot />
            </div>
        </transition>
    </div>
</template>
