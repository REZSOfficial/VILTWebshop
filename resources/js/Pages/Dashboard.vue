<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import AddToCartButton from "@/Components/AddToCartButton.vue";
import AddedMessage from "@/Components/AddedMessage.vue";
import { useForm } from "@inertiajs/vue3";

export default {
    setup() {
        const addToCart = useForm({
            product: "",
        });

        return { addToCart };
    },
    props: {
        products: Object,
        userData: Object,
    },
    components: {
        AppLayout,
        AddToCartButton,
        AddedMessage,
    },
};
</script>

<template>
    <AppLayout
        title="Dashboard"
        :cartItems="userData.cart ? userData.cart.cart_items : []"
    >
        <div>
            <AddedMessage :on="addToCart.recentlySuccessful" class="me-3">
                Item added to cart.
            </AddedMessage>
        </div>
        <div class="flex justify-center py-12">
            <div
                class="grid grid-cols-2 gap-8 p-6 overflow-hidden shadow-xl sm:rounded-lg md:grid-cols-3 lg:grid-cols-4 bg-slate-600"
            >
                <div
                    v-for="product in products"
                    :key="product.id"
                    class="flex flex-col items-center"
                >
                    <div
                        class="p-6 text-white duration-200 ease-in-out border-2 rounded-md bg-slate-900 hover:border-blue-600 hover:rounded-xl"
                        :class="
                            userData.cart.cart_items.some(
                                (item) => item.product_id === product.id
                            )
                                ? 'border-blue-600 rounded-xl'
                                : ''
                        "
                    >
                        <img
                            class="rounded-md"
                            :src="product.image"
                            alt="Product Image"
                        />
                        <div class="justify-between mt-5">
                            <p class="text-blue-200">{{ product.name }}</p>
                            <div class="flex justify-between mt-2">
                                <p class="my-auto text-green-600">
                                    {{ product.price }}$
                                </p>

                                <AddToCartButton
                                    @click="
                                        this.addToCart.post(
                                            route('addToCart', product.id),
                                            {
                                                preserveScroll: true,
                                            }
                                        )
                                    "
                                    :added="false"
                                    :id="product.id"
                                ></AddToCartButton>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
