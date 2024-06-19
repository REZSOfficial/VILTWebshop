<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Checkout from "./Partials/Checkout.vue";
import { faTrash } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

export default {
    setup() {
        const form = useForm({});

        const show = ref(true);

        const addToCart = (product_id) => {
            form.post(route("addToCart", product_id), {
                preserveScroll: true,
            });
        };

        const removeFromCart = (product_id) => {
            form.post(route("removeFromCart", product_id), {
                preserveScroll: true,
            });
        };

        const deleteCartItem = (cart_item_id) => {
            form.delete(route("deleteCartItem", cart_item_id), {
                preserveScroll: true,
            });
        };

        const showCheckout = () => {
            show.value = !show.value;
        };

        return {
            addToCart,
            removeFromCart,
            deleteCartItem,
            showCheckout,
            form,
            show,
        };
    },
    components: {
        AppLayout,
        FontAwesomeIcon,
        Checkout,
    },
    computed: {
        faTrash() {
            return faTrash;
        },
    },
    props: {
        cart: Object,
    },
};
</script>

<template>
    <AppLayout :title="'Cart'" class="text-white">
        <div
            class="flex flex-row px-2 py-2 text-2xl border-b-2 sm:p-8 md:text-6xl"
        >
            <div
                class="border-4 w-[0.5em] h-[0.5em] my-auto me-2 rounded-md"
            ></div>
            <h1>Shopping Cart</h1>
        </div>
        <div class="min-h-screen pt-12 mb-16 sm:p-12">
            <div class="flex flex-col border border-t-0">
                <div
                    class="flex flex-col px-4 pt-6 mb-6 border-t md:flex-row"
                    v-for="cart_item in cart.cart_items"
                    :key="cart_item.id"
                >
                    <img
                        class="w-32 rounded-md shadow-lg me-4"
                        :src="cart_item.product.image"
                        alt="Cart Item Image"
                    />
                    <div class="flex flex-col justify-between text-l">
                        <p>{{ cart_item.product.name.toUpperCase() }}</p>
                        <div class="flex flex-col md:flex-row">
                            <p class="my-auto">Quantity:</p>
                            <div class="flex md:ms-4">
                                <span
                                    @click="
                                        removeFromCart(cart_item.product.id)
                                    "
                                    class="px-3 py-1 duration-150 ease-in-out border hover:bg-red-600 hover:cursor-pointer"
                                    >-</span
                                ><span class="px-3 py-1 border">{{
                                    cart_item.quantity
                                }}</span
                                ><span
                                    @click="addToCart(cart_item.product.id)"
                                    class="px-3 py-1 duration-150 ease-in-out border hover:bg-green-600 hover:cursor-pointer"
                                    >+</span
                                >
                            </div>
                            <div class="my-auto text-xl">
                                <!-- TRASH ICON -->
                                <FontAwesomeIcon
                                    @click="
                                        this.removeFromCart.delete(
                                            route(
                                                'deleteCartItem',
                                                cart_item.id
                                            ),
                                            { preserveScroll: true }
                                        )
                                    "
                                    class="text-red-600 md:mt-2 md:ms-4 hover:cursor-pointer"
                                    :icon="faTrash"
                                ></FontAwesomeIcon>
                            </div>
                        </div>
                        <p>
                            Price:
                            <span class="text-green-600"
                                >{{ cart_item.product.price }}$</span
                            >
                            &times; {{ cart_item.quantity }} =
                            <span class="text-green-600">
                                {{
                                    (
                                        cart_item.product.price *
                                        cart_item.quantity
                                    ).toFixed(2)
                                }}$</span
                            >
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="fixed bottom-0 flex flex-col justify-between w-full py-2 text-sm bg-green-600 border-t-2 sm:flex-row sm:p-5 h-fit sm:text-xl md:text-2xl lg:text-3xl"
        >
            <div class="flex my-auto">
                <div
                    class="border-4 w-[0.5em] h-[0.5em] my-auto rounded-md"
                ></div>
                <p class="ms-2">Items in cart: {{ cart.cart_items.length }}</p>
            </div>
            <div class="my-auto">
                <p>
                    Total price:
                    {{
                        cart.cart_items.reduce(
                            (accumulator, item) =>
                                accumulator +
                                item.product.price * item.quantity,
                            0
                        )
                    }}$
                </p>
            </div>

            <div>
                <button
                    @click.prevent="showCheckout"
                    class="px-2 duration-200 ease-in-out border-4 border-white rounded hover:bg-white hover:text-green-600"
                >
                    Checkout
                </button>
            </div>
        </div>
        <Checkout :cart="cart" :show="show" @close="showCheckout"></Checkout>
    </AppLayout>
</template>
