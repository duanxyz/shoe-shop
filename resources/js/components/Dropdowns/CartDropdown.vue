<template>
    <div>
        <jet-dropdown align="right" width="96" margin="40">
            <template #trigger>
                <button
                    class="cursor-pointer rounded-lg hover:bg-gray-200 py-1 px-2 focus:outline-none"
                >
                    <font-awesome-icon
                        icon="shopping-cart"
                        class="text-gray-400"
                    />
                </button>
            </template>

            <template #content>
                <!-- Basket Management -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    <span class="font-bold text-base"
                        >Keranjang ({{ $page.props.carts.items.length }})</span
                    >
                    <a
                        href="#"
                        class="text-blue-500 font-medium text-sm hover:text-blue-600"
                        >Lihat Sekarang</a
                    >
                </div>
                <div class="border-t border-gray-100"></div>
                <div
                    class="max-h-52 rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-auto bg-white px-5"
                >
                    <div
                        v-for="cart in $page.props.carts.items"
                        :key="cart.id"
                        class="relative grid gap-3 sm:p-2"
                    >
                        <a
                            href="#"
                            class="-m-3 p-3 flex items-start rounded-lg hover:bg-gray-50"
                        >
                            <!-- Heroicon name: chart-bar -->
                            <img
                                :src="'../img/items/' + cart.photo.photo_url"
                                class="flex-shrink-0 h-14 w-14 text-indigo-600"
                            />
                            <div class="ml-4">
                                <p
                                    class="text-base font-bold text-gray-700 hover:text-blue-500"
                                >
                                    {{ cart.name | truncate(15, '...') }}
                                </p>
                                <p class="mt-1 text-xs text-gray-500">
                                    {{ cart.pivot.quantity }} barang
                                    {{ cart.weight }} gram
                                </p>
                            </div>
                            <div class="self-center absolute right-0">
                                <span
                                    class="text-yellow-500 text-sm font-semibold"
                                    >Rp{{ cart.price | curency }}</span
                                >
                            </div>
                        </a>
                    </div>
                </div>
            </template>
        </jet-dropdown>
    </div>
</template>

<script>
import JetDropdown from '@/Jetstream/Dropdown';

export default {
    name: 'BasketDropdown',
    components: {
        JetDropdown,
    },
    data() {
        return {
            isVisible: false,
        };
    },
};
</script>

<style></style>
