<template>
    <div class="py-2 pb-32">
        <div class="grid grid-cols-3 gap-20">
            <div class="col-span-2">
                <h3 class="font-bold text-lg">Alamat Pengiriman</h3>
                <div class="border-b-2 py-1 border-gray-100"></div>
                <div>
                    <div class="text-sm text-gray-500">
                        <b class="text-black">{{ addresses[0].receiver }}</b>
                        <p>{{ addresses[0].no_phone }}</p>
                        <p>
                            {{ addresses[0].address }}, {{ addresses[0].city }},
                            {{ addresses[0].zip_code }}
                        </p>
                    </div>
                </div>
                <div class="border-b-2 py-1 border-gray-100"></div>
                <div class="py-3">
                    <button
                        class="p-2 text-gray-500 border-gray-500 border font-bold rounded-md"
                        @click="show = true"
                    >
                        Pilih Alamat Lain
                    </button>
                </div>
                <div class="border-b-4 py-1 border-gray-100"></div>
                <slot></slot>
            </div>
            <div>
                <div class="relative pt-7">
                    <div class="rounded-md shadow-md p-6 fixed text-gray-600">
                        <h2 class="font-bold text-lg">Ringkasan Belanja</h2>
                        <div class="flex py-5 gap-36">
                            <dt>
                                Total Harga ({{ totalItem.quantity }}
                                barang)
                            </dt>
                            <dd>Rp{{ totalItem.price | curency }}</dd>
                        </div>
                        <div class="flex py-2 gap-36">
                            <dt class="mr-6">Total Ongkos Kirim</dt>
                            <dd>Rp{{ courier.value | curency }}</dd>
                        </div>
                        <div class="border-b-2 py-1 border-gray-100"></div>
                        <div
                            class="flex font-bold text-lg py-2"
                            :class="priceClass"
                        >
                            <dt>Total Harga</dt>
                            <dd>
                                Rp{{
                                    (totalItem.price + courier.value) | curency
                                }}
                            </dd>
                        </div>

                        <!-- <inertia-link
                            :href="route('details', cart.items[0].id)"
                        > -->
                        <button
                            id="checkout"
                            class="text-white font-bold text-lg py-3 rounded-md hover:shadow-lg w-full"
                            :class="isButton"
                            :disabled="isDisabled"
                            @click="payment = true"
                        >
                            Pilih Pembayaran
                        </button>
                        <!-- </inertia-link> -->
                    </div>
                </div>
            </div>
        </div>
        <list-addresses
            :show="show"
            :addresses="addresses"
            @close="show = false"
            :closeable="show"
            @click.stop="show = false"
        />
        <payment-modal
            :show="payment"
            :item="item"
            :bill="totalItem.price + courier.value"
            @close="payment = false"
            :closeable="payment"
            @click.stop="payment = false"
        />
    </div>
</template>

<script>
import ListAddresses from '@/components/ListAddresses';
import PaymentModal from '@/components/PaymentModal';

export default {
    components: {
        ListAddresses,
        PaymentModal,
    },
    props: ['addresses', 'item', 'courier'],
    data() {
        return {
            show: false,
            totalItem: {
                price: 0,
                quantity: 0,
            },
            payment: false,
        };
    },
    computed: {
        priceClass() {
            return {
                'gap-56': !this.totalItem.price,
                'gap-32': this.totalItem.price,
            };
        },
        isDisabled() {
            return !this.courier.value ? true : false;
        },
        isButton() {
            return !this.courier.value
                ? 'bg-gray-400 cursor-not-allowed'
                : 'bg-blue-600';
        },
        quantity() {
            return this.item.reduce((a, n) => {
                return a.quantity + n.quantity;
            });
        },
    },
    methods: {
        openModal() {
            console.log(this.courier);
            this.show = !this.show;
        },
        reduceTotal() {
            let quantity = [];
            let price = [];

            this.item.forEach((n) => {
                quantity.push(n.quantity);
                price.push(n.price * n.quantity);
            });
            this.totalItem = {
                price: price.reduce((a, n) => a + n),
                quantity: quantity.reduce((a, n) => a + n),
            };
        },
    },
    created() {
        this.reduceTotal();
    },
};
</script>

<style></style>
