<template>
    <app-layout>
        <div class="pt-24 pb-12">
            <div class="max-w-none mx-auto">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-10"
                >
                    <div class="flex text-gray-800 px-32 gap-10">
                        <div>
                            <h1 class="text-2xl font-bold py-2">Keranjang</h1>
                            <div class="py-3">
                                <div
                                    :class="{
                                        'fixed top-20 shadow bg-white w-2/5 px-5 pt-4 border': isHandleCheckAll,
                                    }"
                                >
                                    <input
                                        type="checkbox"
                                        @click="handleCheckbox"
                                        v-model="isAll"
                                        class="appearance-none h-5 w-5 cursor-pointer border-gray-400 border-2 rounded-md checked:bg-blue-600 focus:ring-0"
                                    />
                                    <label for="checkAll">Pilih Semua</label>
                                    <div
                                        class="border-b-4 py-1 border-gray-100"
                                    ></div>
                                </div>

                                <div v-for="(item, key) in items" class="py-5">
                                    <div class="flex items-center gap-5">
                                        <input
                                            type="checkbox"
                                            class="check-item appearance-none h-5 w-5 cursor-pointer border-gray-400 border-2 rounded-md checked:bg-blue-600 focus:ring-0"
                                            :value="{
                                                id: item.id,
                                                quantity: item.pivot.quantity,
                                                price: item.price,
                                            }"
                                            v-model="isData"
                                        />
                                        <div>
                                            <div class="flex gap-5">
                                                <inertia-link
                                                    :href="
                                                        route(
                                                            'details',
                                                            item.id
                                                        )
                                                    "
                                                >
                                                    <img
                                                        :src="
                                                            '../img/items/' +
                                                            item.photo.photo_url
                                                        "
                                                        class="w-20"
                                                    />
                                                </inertia-link>
                                                <div>
                                                    <inertia-link
                                                        :href="
                                                            route(
                                                                'details',
                                                                item.id
                                                            )
                                                        "
                                                        class="block"
                                                        >{{
                                                            item.name
                                                        }}</inertia-link
                                                    >
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
                                            </div>

                                            <div class="flex justify-end">
                                                <div
                                                    class="w-96 flex justify-end"
                                                >
                                                    <font-awesome-icon
                                                        icon="trash"
                                                        class="text-gray-400 cursor-pointer"
                                                    />
                                                </div>
                                                <div class="flex pl-5">
                                                    <font-awesome-icon
                                                        v-on:click="
                                                            lessQuantity(
                                                                item.id,
                                                                key
                                                            )
                                                        "
                                                        icon="minus-circle"
                                                        class="cursor-pointer"
                                                        :class="
                                                            item.pivot
                                                                .quantity === 1
                                                                ? 'text-gray-400'
                                                                : 'text-green-500'
                                                        "
                                                    />
                                                    <input
                                                        type="text"
                                                        name="total"
                                                        v-model="
                                                            items[key].pivot
                                                                .quantity
                                                        "
                                                        class="border-0 border-b focus:ring-0 w-14 text-center"
                                                    />
                                                    <font-awesome-icon
                                                        v-on:click="
                                                            addQuantity(
                                                                item.id,
                                                                key
                                                            )
                                                        "
                                                        icon="plus-circle"
                                                        class="text-green-500 cursor-pointer"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="border-b-4 py-1 border-gray-100"
                                    ></div>
                                </div>
                            </div>
                        </div>

                        <div class="relative pt-7">
                            <div
                                class="rounded-md shadow-md p-6 fixed text-gray-600"
                            >
                                <h2 class="font-bold text-lg">
                                    Ringkasan Belanja
                                </h2>
                                <div class="flex py-5" :class="totalClass">
                                    <dt>
                                        Total Harga ({{ totalItem.quantity }}
                                        barang)
                                    </dt>
                                    <dd>Rp{{ totalItem.price | curency }}</dd>
                                </div>
                                <div
                                    class="border-b-2 py-1 border-gray-100"
                                ></div>
                                <div
                                    class="flex font-bold text-lg py-5"
                                    :class="priceClass"
                                >
                                    <dt>Total Harga</dt>
                                    <dd>
                                        {{
                                            totalItem.price
                                                ? totalItem.price
                                                : 0 | curency
                                        }}
                                    </dd>
                                </div>

                                <!-- <inertia-link
                                    :href="route('buy_directly', form)"{}> -->
                                <button
                                    id="checkout"
                                    class="text-white font-bold text-lg py-3 rounded-md hover:shadow-lg w-full"
                                    :class="isButton"
                                    :disabled="isDisabled"
                                    @click="checkout"
                                >
                                    Beli
                                </button>
                                <!-- </inertia-link> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';

export default {
    components: {
        AppLayout,
    },
    props: ['cart'],
    data() {
        return {
            items: this.cart.items,
            totalItem: {
                price: 0,
                quantity: 0,
            },
            quantity: 0,
            isHandleCheckAll: null,
            isData: [],
            isAll: false,
            form: [],
        };
    },
    watch: {
        isData: function () {
            this.reduceTotal();
        },
        quantity: function () {
            this.reduceTotal();
        },
    },
    computed: {
        totalClass() {
            return {
                'gap-10': this.isData.length,
                'gap-36': !this.isData.length,
            };
        },
        priceClass() {
            return {
                'gap-56': !this.totalItem.price,
                'gap-32': this.totalItem.price,
            };
        },
        isDisabled() {
            return !this.isData.length ? true : false;
        },
        isButton() {
            return !this.isData.length
                ? 'bg-gray-400 cursor-not-allowed'
                : 'bg-blue-600';
        },
    },
    methods: {
        addQuantity(id, key) {
            if (this.isData.length) {
                let index = this.isData.findIndex((data) => data.id === id);
                this.isData[index].quantity += 1;
                this.items[key].pivot.quantity += 1;
                this.quantity += 1;
            } else {
                this.items[key].pivot.quantity += 1;
            }
        },
        lessQuantity(id, key) {
            if (this.isData.length) {
                let index = this.isData.findIndex((data) => data.id === id);
                if (this.isData[index].quantity > 1) {
                    this.isData[index].quantity -= 1;
                    this.items[key].pivot.quantity -= 1;
                    this.quantity -= 1;
                }
            } else {
                if (this.items[key].pivot.quantity > 1) {
                    this.items[key].pivot.quantity -= 1;
                }
            }
        },
        handleCheckAll(e) {
            if (115 < e.target.scrollingElement.scrollTop) {
                this.isHandleCheckAll = true;
            } else {
                this.isHandleCheckAll = false;
            }
        },
        handleCheckbox() {
            this.isData = [];

            if (!this.isAll) {
                this.cart.items.forEach((item) => {
                    this.isData.push({
                        id: item.id,
                        price: item.price,
                        quantity: item.pivot.quantity,
                    });
                });
            }
        },
        reduceTotal() {
            this.form = [];
            let quantity = [];
            let price = [];

            if (this.isData.length) {
                this.isData.forEach((n) => {
                    quantity.push(n.quantity);
                    price.push(n.price * n.quantity);
                });
                this.totalItem = {
                    price: price.reduce((a, n) => a + n),
                    quantity: quantity.reduce((a, n) => a + n),
                };
            } else {
                this.totalItem = { price: 0, quantity: 0 };
            }

            this.isData.forEach((n) => {
                this.form.push({ id: n.id, quantity: n.quantity });
            });
        },
        checkout() {
            this.$inertia.post(this.route('checkout'), {
                item: this.form,
                lots: true,
            });
        },
    },
    created() {
        window.addEventListener('scroll', this.handleCheckAll);
    },
    mounted() {
        // window.addEventListener('change', this.reduceTotal);
    },
    destroyed() {
        window.removeEventListener('scroll', this.handleCheckAll);
        // window.removeEventListener('change', this.reduceTotal);
    },
};
</script>

<style></style>
