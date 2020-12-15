<template>
    <div class="w-48 cursor-pointer pb-3">
        <div
            class="flex flex-col min-w-0 break-words bg-white shadow hover:shadow-lg rounded-xl"
        >
            <img src="img/items/item1.jpeg" class="rounded-t-xl h-52" />
            <div class="px-4 py-5 flex-auto">
                <h6 class="text-xs font-semibold">
                    Sepatu Capung - Kodachi 8119 Star Cefron
                </h6>
                <p class="font-bold">Rp10.964.175</p>
                <!-- rating -->
                <div class="flex">
                    <rating v-model="rating" />
                    <span class="ml-3">(234)</span>
                </div>
                <!-- end rating -->
            </div>
        </div>
    </div>
</template>

<script>
import Rating from "@/components/Rating";
export default {
    components: {
        Rating,
    },
    data() {
        return {
            rating: 5,
        };
    },
};
</script>

<style></style>
