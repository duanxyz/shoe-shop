<template>
    <app-layout>
        <div class="pt-24 pb-12">
            <div class="max-w-none mx-auto">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <best-selling-card />
                    <hr class="mb-6 border-gray-300" />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import BestSellingCard from "@/components/Cards/BestSellingCard";

export default {
    components: {
        AppLayout,
        BestSellingCard,
    },
};
</script>
