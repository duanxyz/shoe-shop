<template>
    <app-layout>
        <div class="pt-24 pb-12">
            <div class="max-w-none mx-auto">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-10"
                >
                    <best-selling-card :bestSellers="bestSellers"/>
                    <hr class="border-gray-300" />
                    <last-seen-card />
                    <hr class="border-gray-300" />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import BestSellingCard from '@/components/Cards/BestSellingCard';
import LastSeenCard from '@/components/Cards/LastSeenCard';

export default {
    components: {
        AppLayout,
        BestSellingCard,
        LastSeenCard,
    },
    props:['bestSellers'],
};
</script>
