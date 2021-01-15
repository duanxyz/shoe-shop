<template>
    <dialog-modal :show="show" :max-width="maxWidth" @close="close">
        <template #title>
            <div>
                <h1 class="font-bold text-lg">Pilih Alamat Pengiriman</h1>
            </div>
        </template>
        <template #content>
            <div>
                <search class="w-full" />
                <div class="max-h-96 overflow-y-scroll">
                    <button
                        class="w-full text-center py-5 my-3 font-bold text-gray-400 border-dashed border border-gray-400"
                    >
                        Tambah Alamat Baru
                    </button>

                    <div
                        v-for="address in addresses"
                        :key="address.id"
                        class="w-full p-3 text-sm text-gray-500 border border-blue-400 rounded-md mb-2 grid grid-cols-3 items-center"
                    >
                        <div class="col-span-2">
                            <p class="text-black">
                                <b>{{ address.receiver }}</b>
                            </p>
                            <p>{{ address.no_phone }}</p>
                            <p>{{ address.address }}</p>
                            <p>{{ address.city }},{{ address.zip_code }}</p>

                            <button class="text-blue-400 font-bold pt-2">
                                Ubah Alamat
                            </button>
                        </div>
                        <div class="justify-self-end">
                            <button
                                class="p-3 bg-blue-500 text-white font-bold rounded-md ring-0"
                            >
                                Pilih Alamat
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </dialog-modal>
</template>

<script>
import DialogModal from '@/Jetstream/DialogModal';
import Search from '@/components/Search';
export default {
    components: {
        DialogModal,
        Search,
    },
    props: {
        show: {
            default: false,
        },
        maxWidth: {
            default: '2xl',
        },
        closeable: {
            default: true,
        },
        addresses: Array,
    },
    methods: {
        close() {
            this.$emit('close');
        },
    },
};
</script>

<style></style>
