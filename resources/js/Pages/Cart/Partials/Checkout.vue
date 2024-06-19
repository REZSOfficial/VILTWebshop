<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { faClose } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    cart: {
        type: Object,
        default: () => {
            return {
                total: 0,
                items: [],
            };
        },
    },
});
</script>

<template>
    <Transition
        enter-active-class="duration-200 ease-out "
        enter-from-class="transform -right-10"
        enter-to-class="transform opacity-100"
        leave-active-class="duration-150 ease-in"
        leave-from-class="transform opacity-100"
        leave-to-class="transform opacity-0 -right-10"
    >
        <div
            v-if="show"
            class="fixed right-0 top-0 w-1/3 h-screen z-[100] bg-slate-800 border-l-4"
        >
            <div
                class="flex flex-row justify-between p-3 text-2xl font-bold text-white bg-green-600"
            >
                <h1>Checkout</h1>
                <FontAwesomeIcon
                    class="p-1 px-2 my-auto duration-100 rounded-full hover:text-green-600 hover:cursor-pointer hover:bg-slate-800"
                    :icon="faClose"
                    @click="$emit('close')"
                ></FontAwesomeIcon>
            </div>
            <form class="flex flex-col p-2 gap-y-5">
                <div class="flex flex-col">
                    <label for="address">Address</label>
                    <input
                        class="rounded bg-slate-700"
                        type="text"
                        name="address"
                    />
                </div>
                <div class="flex flex-col">
                    <label for="city">City</label>
                    <input
                        class="rounded bg-slate-700"
                        type="text"
                        name="city"
                    />
                </div>
                <div class="flex flex-col">
                    <label for="zip">Zip</label>
                    <input
                        class="rounded bg-slate-700"
                        type="text"
                        name="zip"
                    />
                </div>
                <div class="flex flex-col">
                    <label for="country">Country</label>
                    <input
                        class="rounded bg-slate-700"
                        type="text"
                        name="country"
                    />
                </div>
                <PrimaryButton
                    class="justify-center border border-white"
                    type="submit"
                    >Order</PrimaryButton
                >
            </form>
        </div>
    </Transition>
</template>
