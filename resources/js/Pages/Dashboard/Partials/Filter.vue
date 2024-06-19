<script setup>
import { useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
const props = defineProps({
    brands: Object,
});

const filterForm = useForm({
    selectedBrandId: props.selectedBrandName || null,
    sort: "",
});

const handleFilter = () => {
    if (filterForm.selectedBrandId || filterForm.sort) {
        filterForm.get(route("dashboard"), {
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <div
        class="sticky py-2 flex justify-center border-b-2 bg-slate-800 border-slate-500 text-white sm:top-[76px] top-[86px] sm:p-4"
    >
        <form
            class="flex flex-row flex-wrap gap-3"
            @submit.prevent="handleFilter"
        >
            <div>
                <label class="my-auto font-bold me-1" for="brand"
                    >Brand:
                </label>
                <select
                    id="brands"
                    v-model="filterForm.selectedBrandId"
                    class="text-white border-2 border-white rounded-lg bg-slate-600 focus:border-white focus:ring-white focus:ring-1"
                >
                    <option
                        class="text-lg text-white bg-slate-800"
                        v-for="brand in brands"
                        :key="brand.id"
                        :value="brand.id"
                    >
                        {{ brand.name }}
                    </option>
                </select>
            </div>
            <div>
                <label class="my-auto font-bold me-2" for="brand"
                    >Sort by:</label
                >
                <select
                    id="sort"
                    v-model="filterForm.sort"
                    class="text-white border-2 border-white rounded-lg bg-slate-600 focus:border-white focus:ring-white focus:ring-1"
                >
                    <option
                        class="text-lg text-white bg-slate-800"
                        value="asc"
                        v-bind="{ selected: filterForm.sort == 'asc' }"
                    >
                        Price Ascending
                    </option>
                    <option
                        class="text-lg text-white bg-slate-800"
                        value="desc"
                        v-bind="{ selected: filterForm.sort == 'desc' }"
                    >
                        Price Descending
                    </option>
                </select>
            </div>
            <div>
                <button
                    type="submit"
                    class="p-2 px-4 text-white border-2 rounded-lg border-white-400 bg-slate-800"
                >
                    Filter
                </button>
            </div>
        </form>
    </div>
</template>
