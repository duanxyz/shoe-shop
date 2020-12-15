<template>
    <section class="sm:px-6 lg:px-14">
        <div class="flex items-center">
            <h2 class="px-4 font-bold text-2xl pt-4 mb-4">Terakhir dilihat</h2>
            <a
                href="#"
                class="text-blue-500 font-bold text-base hover:text-blue-600"
                >Lihat Semua</a
            >
        </div>
        <div
            id="listItemSeen"
            class="grid grid-rows-1 grid-flow-col gap-3 overflow-x-hidden"
            @mouseover="isVisibleSeen = true"
            @mouseleave="isVisibleSeen = false"
        >
            <card-item-mini />
        </div>
        <div v-show="isVisibleSeen">
            <button
                v-on:click="scrollLeft"
                v-if="curentScrollLeft"
                @mouseover="isVisibleSeen = true"
                @mouseleave="isVisibleSeen = false"
                class="bg-white w-6 cursor-pointer text-gray-400 rounded-full shadow outline-none focus:outline-none absolute top-2/4 left-10"
            >
                <font-awesome-icon icon="angle-left" />
            </button>
            <button
                v-on:click="scrollRight"
                v-if="
                    curentScrollLeft == null ||
                    curentScrollLeft != maxScrollLeft
                "
                @mouseover="isVisibleSeen = true"
                @mouseleave="isVisibleSeen = false"
                class="bg-white w-6 cursor-pointer text-gray-400 rounded-full shadow outline-none focus:outline-none absolute top-2/4 right-10"
            >
                <font-awesome-icon icon="angle-right" />
            </button>
        </div>
    </section>
</template>

<script>
import CardItemMini from "./CardItemMini";
export default {
    name: "LastSeenCard",
    components: {
        CardItemMini,
    },
    data() {
        return {
            curentScrollLeft: null,
            maxScrollLeft: null,
            isVisibleSeen: false,
        };
    },
    methods: {
        scrollLeft() {
            let content = document.querySelector("#listItemSeen");
            this.maxScrollLeft = content.scrollWidth - content.clientWidth;
            content.scrollLeft -= 100;
            this.curentScrollLeft = content.scrollLeft;
        },
        scrollRight() {
            let content = document.querySelector("#listItemSeen");
            this.maxScrollLeft = content.scrollWidth - content.clientWidth;
            content.scrollLeft += 100;
            this.curentScrollLeft = content.scrollLeft;
        },
    },
};
</script>

<style></style>
