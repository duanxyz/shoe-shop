<template>
    <app-layout>
        <div class="pt-24 pb-12">
            <div class="max-w-none mx-auto">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-10"
                >
                    <div class="flex text-gray-800 px-32 gap-10">
                        <div>
                            <h1 class="text-2xl font-bold py-2">
                                Beli Langsung
                            </h1>
                            <checkout-layout
                                :addresses="addresses"
                                :item="items"
                                :courier="courier"
                            >
                                <div class="py-3">
                                    <h2 class="text-lg font-bold py-2">
                                        Barang yang dibeli
                                    </h2>
                                    <div
                                        v-for="(item, key) in items"
                                        class="py-2"
                                    >
                                        <div class="flex items-center gap-10">
                                            <img
                                                :src="
                                                    baseUrl +
                                                    '/img/items/' +
                                                    item.photo_url
                                                "
                                                class="w-20 rounded-md"
                                            />
                                            <div>
                                                <b class="block">{{
                                                    item.name
                                                }}</b>
                                                <p
                                                    v-if="item.stock <= 5"
                                                    class="text-red-500 text-xs"
                                                >
                                                    Sisa {{ item.stock }}
                                                </p>
                                                <b
                                                    >Rp{{
                                                        item.price | curency
                                                    }}</b
                                                >
                                            </div>
                                            <div v-if="key === 0">
                                                <kurir-dropdown
                                                    @clicked="onClickChild"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </checkout-layout>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import CheckoutLayout from '@/Layouts/CheckoutLayout';
import KurirDropdown from '@/components/Dropdowns/KurirDropdwon';

export default {
    components: {
        AppLayout,
        CheckoutLayout,
        KurirDropdown,
    },
    props: ['items', 'addresses'],
    data() {
        return {
            courier: {
                code: null,
                etd: null,
                value: 0,
            },
        };
    },
    computed: {
        baseUrl() {
            return window.location.origin;
        },
    },
    methods: {
        onClickChild(value) {
            this.courier = value;
        },
    },
};
</script>

<style></style>
