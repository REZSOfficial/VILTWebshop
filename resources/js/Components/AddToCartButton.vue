<script setup>
const props = defineProps({
    added: Boolean,
});
</script>

<template>
    <button
        type="submit"
        class="p-2 my-auto text-sm duration-200 ease-in-out border hover:bg-blue-600"
    >
        Add to cart
    </button>
</template>
