<template>
    <section class="sm:px-6 lg:px-14 relative">
        <div class="flex items-center">
            <h2 class="px-4 font-bold text-2xl pt-4 mb-4">Terakhir dilihat</h2>
            <inertia-link
                :href="route('show-all', 'terakhir-dilihat')"
                class="text-blue-500 font-bold text-base hover:text-blue-600"
                >Lihat Semua</inertia-link
            >
        </div>
        <div
            id="listItemSeen"
            class="grid grid-rows-1 grid-flow-col gap-3 overflow-x-hidden"
            @mouseover="isVisibleSeen = true"
            @mouseleave="isVisibleSeen = false"
        >
            <div
                class="w-48 cursor-pointer pb-3"
                v-for="item in lastSeen"
                :key="item.id"
            >
                <div
                    class="flex flex-col min-w-0 break-words bg-white shadow hover:shadow-lg rounded-xl"
                >
                    <img
                        :src="'img/items/' + item.photo.photo_url"
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
                            <span class="ml-3"
                                >({{ item.price | curency }})</span
                            >
                        </div>
                        <!-- end rating -->
                    </div>
                </div>
            </div>
        </div>
        <div v-show="isVisibleSeen">
            <button
                v-on:click="seenLeft"
                v-if="seenScrollLeft"
                @mouseover="isVisibleSeen = true"
                @mouseleave="isVisibleSeen = false"
                class="bg-white w-6 cursor-pointer text-gray-400 rounded-full shadow outline-none focus:outline-none absolute top-1/2 left-10"
            >
                <font-awesome-icon icon="angle-left" />
            </button>
            <button
                v-on:click="seenRight"
                v-if="
                    seenScrollLeft == null ||
                    seenScrollLeft != maxSeenScrollLeft
                "
                @mouseover="isVisibleSeen = true"
                @mouseleave="isVisibleSeen = false"
                class="bg-white w-6 cursor-pointer text-gray-400 rounded-full shadow outline-none focus:outline-none absolute top-1/2 right-10"
            >
                <font-awesome-icon icon="angle-right" />
            </button>
        </div>
    </section>
</template>

<script>
import Rating from '@/components/Rating';
export default {
    name: 'LastSeenCard',
    components: {
        Rating,
    },
    props: ['lastSeen'],
    data() {
        return {
            seenScrollLeft: null,
            maxSeenScrollLeft: null,
            isVisibleSeen: false,
            rating: 5,
        };
    },
    methods: {
        seenLeft() {
            let content = document.querySelector('#listItemSeen');
            this.maxSeenScrollLeft = content.scrollWidth - content.clientWidth;
            content.scrollLeft -= 100;
            this.seenScrollLeft = content.scrollLeft;
        },
        seenRight() {
            let content = document.querySelector('#listItemSeen');
            this.maxSeenScrollLeft = content.scrollWidth - content.clientWidth;
            content.scrollLeft += 100;
            this.seenScrollLeft = content.scrollLeft;
        },
    },
};
</script>

<style></style>
