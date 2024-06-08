<script setup>
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

const props = defineProps({
    added: Boolean,
});
</script>

<template>
    <button
        class="p-2 my-auto text-sm duration-200 ease-in-out border hover:bg-blue-600"
    >
        {{ added ? "Added" : "Add to cart" }}
    </button>
</template>
