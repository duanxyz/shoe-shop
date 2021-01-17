<template>
    <div class="grid grid-cols-5 grid-flow-row overflow-x-hidden">
        <div
            class="w-48 cursor-pointer pb-3"
            v-for="item in items"
            :key="item.id"
        >
            <inertia-link
                :href="route('details', item.id)"
                :class="'flex flex-col min-w-0 break-words bg-white shadow-lg hover:shadow-xl rounded-xl'"
            >
                <img
                    :src="baseUrl + '/img/items/' + item.photo.photo_url"
                    class="rounded-t-xl h-52"
                />
                <div class="px-4 py-5 flex-auto">
                    <h6 class="text-xs font-semibold">
                        {{ item.name | truncate(40, '...') }}
                    </h6>
                    <p class="font-bold">Rp{{ item.price | curency }}</p>
                    <!-- rating -->
                    <div class="flex">
                        <rating v-model="rating" />
                        <span class="ml-3">({{ item.sold | curency }})</span>
                    </div>
                    <!-- end rating -->
                </div>
            </inertia-link>
        </div>
    </div>
</template>

<script>
import Rating from '@/components/Rating';
export default {
    components: {
        Rating,
    },
    props: ['items'],
    data() {
        return {
            rating: 5,
        };
    },
    computed: {
        baseUrl() {
            return window.location.origin;
        },
    },
};
</script>

<style></style>
