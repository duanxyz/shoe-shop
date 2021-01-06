<template>
    <section class="sm:px-6 lg:px-14">
        <div class="flex items-center">
            <h2 class="px-4 font-bold text-2xl pt-4 mb-4">Terlaris Untukmu</h2>
            <a
                href="#"
                class="text-blue-500 font-bold text-base hover:text-blue-600"
                >Lihat Semua</a
            >
        </div>
        <div
            id="listItems"
            class="grid grid-rows-1 grid-flow-col gap-3 overflow-x-hidden"
            @mouseover="isVisible = true"
            @mouseleave="isVisible = false"
        >
            <div
                class="w-48 cursor-pointer pb-3"
                v-for="bestSeller in bestSellers"
                :key="bestSeller.id"
            >
                <inertia-link
                    :href="route('details', bestSeller.id)"
                    :class="'flex flex-col min-w-0 break-words bg-white shadow hover:shadow-lg rounded-xl'"
                >
                    <img
                        :src="'img/items/' + bestSeller.photo.photo_url"
                        class="rounded-t-xl h-52"
                    />
                    <div class="px-4 py-5 flex-auto">
                        <h6 class="text-xs font-semibold">
                            {{ bestSeller.name | truncate(40, '...') }}
                        </h6>
                        <p class="font-bold">
                            Rp{{ bestSeller.price | curency }}
                        </p>
                        <!-- rating -->
                        <div class="flex">
                            <rating v-model="rating" />
                            <span class="ml-3"
                                >({{ bestSeller.sold | curency }})</span
                            >
                        </div>
                        <!-- end rating -->
                    </div>
                </inertia-link>
            </div>
        </div>
        <div v-show="isVisible">
            <button
                v-on:click="scrollLeft"
                v-if="curentScrollLeft"
                @mouseover="isVisible = true"
                @mouseleave="isVisible = false"
                class="bg-white w-6 cursor-pointer text-gray-400 rounded-full shadow outline-none focus:outline-none absolute top-2/4 left-20"
            >
                <font-awesome-icon icon="angle-left" />
            </button>
            <button
                v-on:click="scrollRight"
                v-if="
                    curentScrollLeft == null ||
                    curentScrollLeft != maxScrollLeft
                "
                @mouseover="isVisible = true"
                @mouseleave="isVisible = false"
                class="bg-white w-6 cursor-pointer text-gray-400 rounded-full shadow outline-none focus:outline-none absolute top-2/4 right-20"
            >
                <font-awesome-icon icon="angle-right" />
            </button>
        </div>
    </section>
</template>

<script>
import Rating from '@/components/Rating';

export default {
    name: 'BestSellingCard',
    components: {
        Rating,
    },
    props: ['bestSellers'],
    data() {
        return {
            curentScrollLeft: null,
            maxScrollLeft: null,
            isVisible: false,
            rating: 5,
        };
    },
    methods: {
        scrollLeft() {
            let content = document.querySelector('#listItems');
            this.maxScrollLeft = content.scrollWidth - content.clientWidth;
            content.scrollLeft -= 100;
            this.curentScrollLeft = content.scrollLeft;
        },
        scrollRight() {
            let content = document.querySelector('#listItems');
            this.maxScrollLeft = content.scrollWidth - content.clientWidth;
            content.scrollLeft += 100;
            this.curentScrollLeft = content.scrollLeft;
        },
    },
};
</script>

<style></style>
