<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

const props = defineProps({
    href: String,
    active: Boolean,
    icon: Object,
});

const classes = computed(() => {
    return props.active
        ? "text-white rounded rounded-full bg-blue-600  p-3 px-4 me-3 text-sm my-auto"
        : "text-white rounded rounded-full hover:bg-blue-600 p-3 px-4 me-3 duration-200 ease-in-out text-sm";
});
</script>

<template>
    <Link :href="href" :class="classes">
        <FontAwesomeIcon
            class="hidden px-1 py-2 text-white rounded-full max-sm:block circle"
            :icon="icon"
        />
        <div class="max-sm:hidden">
            <FontAwesomeIcon class="px-1 text-white" :icon="icon" />
            <slot />
        </div>
    </Link>
</template>
