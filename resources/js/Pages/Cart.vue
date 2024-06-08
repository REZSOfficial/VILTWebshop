<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";

export default {
    setup() {
        const addToCart = useForm({
            product: "",
        });
        const removeFromCart = useForm({
            product: "",
        });

        return { addToCart, removeFromCart };
    },
    components: {
        AppLayout,
    },
    props: {
        cart: Object,
    },
};
</script>

<template>
    <AppLayout :title="'Cart'" class="text-white">
        <div class="flex flex-row p-8 text-6xl border-b-2">
            <div
                class="border-4 w-[0.5em] h-[0.5em] my-auto me-2 rounded-md"
            ></div>
            Shopping Cart
        </div>
        <div class="p-12 mb-16">
            <div class="flex flex-col border border-t-0 min-w-fit">
                <div
                    class="flex flex-col px-4 pt-6 mb-6 border-t md:flex-row"
                    v-for="cart_item in cart.cart_items"
                    :key="cart_item.id"
                >
                    <img
                        class="w-32 rounded-md shadow-lg me-4"
                        :src="cart_item.product.image"
                        alt=""
                    />
                    <div class="flex flex-col justify-between text-l">
                        <p>{{ cart_item.product.name.toUpperCase() }}</p>
                        <div class="flex">
                            <p class="my-auto">Quantity:</p>
                            <div class="flex ms-4">
                                <span
                                    @click.prevent="
                                        this.removeFromCart.post(
                                            route(
                                                'removeFromCart',
                                                cart_item.product.id
                                            ),
                                            {
                                                preserveScroll: true,
                                            }
                                        )
                                    "
                                    class="px-3 py-1 duration-150 ease-in-out border hover:bg-red-600 hover:cursor-pointer"
                                    >-</span
                                ><span class="px-3 py-1 border">{{
                                    cart_item.quantity
                                }}</span
                                ><span
                                    @click.prevent="
                                        this.addToCart.post(
                                            route(
                                                'addToCart',
                                                cart_item.product.id
                                            ),
                                            {
                                                preserveScroll: true,
                                            }
                                        )
                                    "
                                    class="px-3 py-1 duration-150 ease-in-out border hover:bg-green-600 hover:cursor-pointer"
                                    >+</span
                                >
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
                                    cart_item.product.price *
                                    cart_item.quantity
                                }}$</span
                            >
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="fixed bottom-0 flex flex-row justify-between w-full p-5 text-4xl bg-green-600 border-t-2 h-fit"
        >
            <div class="flex my-auto">
                <div
                    class="border-4 w-[0.5em] h-[0.5em] my-auto me-2 rounded-md"
                ></div>
                <div>Items in cart: {{ cart.cart_items.length }}</div>
            </div>
            <div class="my-auto">
                Total price:
                {{
                    cart.cart_items.reduce(
                        (accumulator, item) =>
                            accumulator + item.product.price * item.quantity,
                        0
                    )
                }}$
            </div>

            <div>
                <button
                    class="px-2 duration-200 ease-in-out border-4 border-white rounded hover:bg-white hover:text-green-600"
                >
                    Checkout
                </button>
            </div>
        </div>
    </AppLayout>
</template>
