<template>
    <dialog-modal :show="show" :max-width="maxWidth" @close="close">
        <template #title>
            <div class="flex items-center gap-3">
                <font-awesome-icon icon="times" @click="close" />
                <h1 class="font-bold text-lg">Pembayaran</h1>
            </div>
        </template>
        <template #content>
            <div>
                <div class="grid grid-cols-3 py-3">
                    <h1 class="font-bold col-span-2">Metode pembayaran</h1>
                    <span class="justify-self-end text-blue-500"
                        >Lihat Semua</span
                    >
                </div>
                <div class="text-center py-2">
                    <span class="text-red-400 p-2 bg-red-100 rounded-md"
                        >Saat ini kami hanya memiliki metode pembayaran
                        COD</span
                    >
                </div>
                <div class="shadow rounded-md">
                    <div class="grid grid-cols-3 items-center p-4">
                        <h1 class="font-bold col-span-2">
                            COD (Bayar di Tempat)
                        </h1>
                        <img
                            class="w-7 justify-self-end"
                            :src="baseUrl + '/img/' + 'new-cod.png'"
                            alt="cod"
                        />
                    </div>
                    <div class="border-b-2 py-1 border-gray-100"></div>
                    <div class="p-5">
                        <ul
                            class="text-sm list-disc p-5 bg-gray-100 text-blue-500"
                        >
                            <li class="py-1">
                                <p class="text-gray-500">
                                    Bayar belanjaanmu melalui kurir saat pesanan
                                    tiba.
                                </p>
                            </li>
                            <li class="py-1">
                                <p class="text-gray-500">
                                    Jumlah pembayaran sudah termasuk tambahan
                                    Biaya layanan Cash On Delivery sebesar 2%
                                    dari produk harga
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="shadow rounded-md p-5 mt-2">
                    <div class="grid grid-cols-3 items-center">
                        <div class="col-span-2">
                            <h1 class="text-sm">Total Tagihan</h1>
                            <b class="text-yellow-500 text-sm"
                                >Rp{{ bill | curency }}</b
                            >
                        </div>
                        <div class="justify-self-end">
                            <span class="font-bold text-blue-500">DETAIL</span>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <template #footer>
            <div>
                <form @submit.prevent="pay">
                    <button
                        type="submit"
                        class="w-full text-center text-white bg-yellow-500 py-2 rounded-md font-bold"
                    >
                        Bayar
                    </button>
                </form>
            </div>
        </template>
    </dialog-modal>
</template>

<script>
import DialogModal from '@/Jetstream/DialogModal';
export default {
    components: {
        DialogModal,
    },
    props: {
        show: {
            default: false,
        },
        maxWidth: {
            default: 'lg',
        },
        closeable: {
            default: true,
        },
        bill: Number,
        item: Object,
    },
    computed: {
        baseUrl() {
            return window.location.origin;
        },
    },
    methods: {
        close() {
            this.$emit('close');
        },
        pay() {
            const form = {
                item_id: this.item.id,
                payment: 'COD',
                grand_total: this.bill,
            };
            this.$inertia.post(this.route('order.store', form));
        },
    },
};
</script>

<style></style>
