<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import AddToCartButton from "@/Components/AddToCartButton.vue";
import AddedMessage from "@/Components/AddedMessage.vue";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import { reactive } from "vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

export default {
    setup() {
        const quantities = ref({});

        const addToCart = useForm({
            quantity: 1,
        });

        const state = reactive({
            success: false,
        });

        const initializeQuantities = (products) => {
            products.data.forEach((product) => {
                quantities.value[product.id] = 1;
            });
        };

        const handleAddToCart = (product_id, quantity) => {
            addToCart.quantity = quantity;
            addToCart.post(route("addToCart", product_id), {
                preserveScroll: true,
                onSuccess: () => {
                    state.success = true;
                    setTimeout(() => {
                        state.success = false;
                    }, 1000);
                },
            });
        };

        return {
            quantities,
            initializeQuantities,
            addToCart,
            handleAddToCart,
            state,
        };
    },
    methods: {
        getProducts(url) {
            this.$inertia.get(url);
        },
    },
    props: {
        products: Object,
        userData: Object,
    },
    components: {
        AppLayout,
        AddToCartButton,
        AddedMessage,
        SecondaryButton,
    },
    mounted() {
        this.initializeQuantities(this.products);
    },
};
</script>

<template>
    <AppLayout
        title="Dashboard"
        :cartItems="userData.cart ? userData.cart.cart_items : null"
    >
        <div>
            <AddedMessage :on="state.success" class="me-3">
                Item added to cart.
            </AddedMessage>
        </div>
        <div class="flex justify-center py-12">
            <div
                class="grid grid-cols-2 gap-8 p-6 overflow-hidden shadow-xl sm:rounded-lg md:grid-cols-3 lg:grid-cols-4 bg-slate-600"
            >
                <!-- Product -->
                <div
                    v-for="product in products.data"
                    :key="product.id"
                    class="flex flex-col items-center"
                >
                    <div
                        class="p-6 text-white duration-200 ease-in-out border-2 bg-slate-900 hover:border-blue-600 hover:rounded-xl"
                        :class="
                            userData.cart
                                ? userData.cart.cart_items.some(
                                      (item) => item.product_id === product.id
                                  )
                                    ? 'border-blue-600 rounded-xl'
                                    : ''
                                : ''
                        "
                    >
                        <img
                            class="rounded-md"
                            :src="product.image"
                            alt="Product Image"
                        />
                        <div class="mt-5">
                            <div class="">
                                <p class="text-blue-100">
                                    {{ product.name.toUpperCase() }}
                                </p>

                                <p class="text-blue-400">
                                    {{ product.brand.name }}
                                </p>
                            </div>
                            <p
                                class="px-2 py-1 my-1 font-bold bg-green-600 rounded w-fit"
                            >
                                {{ product.price }}$
                            </p>
                            <!-- Quantity -->

                            <form
                                class="flex flex-col justify-between mt-2 xl:flex-row"
                                @submit.prevent="
                                    handleAddToCart(
                                        product.id,
                                        quantities[product.id]
                                    )
                                "
                                :id="product.id"
                            >
                                <div class="flex my-auto mb-2 xl:mb-0">
                                    <span
                                        @click="
                                            quantities[product.id] = Math.max(
                                                1,
                                                quantities[product.id] - 1
                                            )
                                        "
                                        class="p-2 px-3 my-auto text-sm duration-150 ease-in-out border hover:bg-red-600 hover:cursor-pointer"
                                        >-</span
                                    ><input
                                        v-bind="this.addToCart.quantity"
                                        type="number"
                                        name="quantity"
                                        :value="quantities[product.id]"
                                        class="p-2 px-3 my-auto text-center text-sm bg-transparent border border-white w-[2.5rem]"
                                    />
                                    <span
                                        @click="quantities[product.id]++"
                                        class="p-2 px-3 my-auto text-sm duration-150 ease-in-out border hover:bg-green-600 hover:cursor-pointer"
                                        >+</span
                                    >
                                </div>
                                <!-- Add to cart button -->
                                <AddToCartButton></AddToCartButton>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <SecondaryButton
                        @click="getProducts(products.prev_page_url)"
                        :disabled="!products.prev_page_url"
                        class="px-4 py-2 mr-2 bg-gray-300 rounded"
                    >
                        Previous
                    </SecondaryButton>
                    <SecondaryButton
                        @click="getProducts(products.next_page_url)"
                        :disabled="!products.next_page_url"
                        class="px-4 py-2 bg-gray-300 rounded"
                    >
                        Next
                    </SecondaryButton>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
