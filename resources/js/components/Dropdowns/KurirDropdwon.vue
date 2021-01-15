<template>
    <div>
        <dropdown align="right" width="96" margin="40">
            <template #trigger>
                <div class="">
                    <h1 class="font-bold mb-2">Pilih Durasi</h1>
                    <button
                        @click="getCost"
                        class="cursor-pointer rounded-lg font-bold text-white w-56 py-2 bg-blue-500 text-center focus:outline-none focus:cursor-not-allowed"
                        :class="courier ? 'text-sm' : 'text-base'"
                    >
                        <div v-if="loading" class="btn-spinner mr-4" />
                        {{ loading ? '' : textButton }}
                    </button>
                    <div v-if="courier" class="text-sm text-gray-500 mt-3">
                        <h2 class="font-bold text-black">Kurir Pilihan</h2>
                        <p>
                            {{ courier.code }} (Rp{{ courier.value | curency }})
                        </p>
                        <p>Estimasi tiba {{ estimasi(courier.etd) }}</p>
                    </div>
                </div>
            </template>

            <template #content>
                <div
                    class="bg-white text-xs w-56 text-gray-500 h-28 px-1 overflow-y-scroll border border-gray-400 rounded-md"
                >
                    <div v-for="courier in couriers">
                        <div
                            v-for="costs in courier.costs"
                            class="grid grid-cols-3 py-1 items-center hover:bg-blue-100 cursor-pointer"
                            @click="selectCourier(courier.code, costs)"
                        >
                            <div class="col-span-2">
                                <h1 class="font-bold text-black">
                                    {{ courier.code | capitalize }}
                                    {{ costs.service | capitalize }}
                                </h1>
                                <p>
                                    Estimasi tiba
                                    {{ estimasi(costs.cost[0].etd) }}
                                </p>
                            </div>
                            <div class="justify-self-end">
                                <p>Rp{{ costs.cost[0].value | curency }}</p>
                            </div>
                            <div
                                class="border-b-2 px-1 pt-1 border-gray-100 col-span-3"
                            ></div>
                        </div>
                    </div>
                </div>
            </template>
        </dropdown>
    </div>
</template>

<script>
import Dropdown from '@/components/Dropdown';
import LoadingButton from '@/components/LoadingButton';

export default {
    components: {
        Dropdown,
        LoadingButton,
    },
    data() {
        return {
            data: [],
            api_key: '7f3a3cc6cb4d15a32a4fb76c97365f40',
            couriers: null,
            textButton: 'Pengiriman',
            loading: false,
            courier: null,
        };
    },
    methods: {
        getCost() {
            this.loading = true;
            axios
                .post(this.route('ongkos-kirim'))
                .then((response) => {
                    let couriers = response.data;
                    this.couriers = couriers;
                    this.loading = false;
                })
                .catch((error) => console.log(error));
        },
        estimasi(etd) {
            if (etd.includes('HARI')) {
                return etd.split(' ').slice(0, 1).join('') + ' hari';
            } else {
                return etd + ' hari';
            }
        },
        selectCourier(code, costs) {
            const filters = this.$options.filters;
            this.textButton = `${filters.capitalize(code)} ${filters.capitalize(
                costs.service
            )}`;
            this.courier = {
                code: code,
                etd: costs.cost[0].etd,
                value: costs.cost[0].value,
            };
            this.$emit('clicked', this.courier);
        },
    },
};
</script>

<style></style>
